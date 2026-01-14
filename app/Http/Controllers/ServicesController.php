<?php

namespace App\Http\Controllers;

use App\Models\Service;
use App\Models\ServiceOfficer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Throwable;

class ServicesController extends Controller
{
    /**
     * Show the customer-facing services page with dynamic data.
     */
    public function index(Request $request)
    {
        // Cache services with options for 10 minutes
        $services = Cache::remember('services.index.all', now()->addMinutes(10), function () {
            try {
                return Service::with([
                    'options' => function ($query) {
                        $query->active()->ordered();
                    }
                ])
                    ->where('is_active', true)
                    ->orderBy('sort_order')
                    ->get();
            } catch (Throwable $e) {
                logger()->warning('Unable to fetch services: ' . $e->getMessage());
                return collect([]);
            }
        });

        $options = $services->flatMap->options;

        // Cache officers for 10 minutes
        $officers = Cache::remember('services.officers', now()->addMinutes(10), function () {
            try {
                return ServiceOfficer::where('is_active', true)
                    ->orderBy('sort_order')
                    ->get();
            } catch (Throwable $e) {
                logger()->warning('Unable to fetch officers: ' . $e->getMessage());
                return collect([]);
            }
        });

        $groupedServices = $services->groupBy(function ($service) {
            return $service->category ?: 'General';
        });

        $categoryDescriptions = $groupedServices->map(function ($group) {
            return optional($group->first())->category_description;
        });

        return view('services.index', [
            'services' => $services,
            'options' => $options,
            'officers' => $officers,
            'groupedServices' => $groupedServices,
            'categoryDescriptions' => $categoryDescriptions,
        ]);
    }

    /**
     * Show a single service with its variants/options.
     */
    public function show(Service $service)
    {
        abort_unless($service->is_active, 404);

        $service->load([
            'options' => function ($query) {
                $query->active()->ordered();
            }
        ]);

        return view('services.show', [
            'service' => $service,
            'options' => $service->options,
        ]);
    }
}
