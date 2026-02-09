<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Service;
use App\Models\ServiceOption;
use App\Models\ServiceOfficer;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Cache;

class ServiceManagementController extends Controller
{
    /**
     * Display services management page.
     */
    public function index()
    {
        // Cache services list for 5 minutes
        $services = Cache::remember('admin.services.list', 300, function () {
            return Service::with('options')->ordered()->get();
        });

        $officers = Cache::remember('admin.service_officers.list', 300, function () {
            return ServiceOfficer::ordered()->get();
        });
        
        $stats = Cache::remember('admin.services.stats', 300, function () {
            return [
                'total_services' => Service::count(),
                'active_services' => Service::whereRaw('"is_active" IS TRUE')->count(),
                'total_officers' => ServiceOfficer::count(),
                'active_officers' => ServiceOfficer::whereRaw('"is_active" IS TRUE')->count(),
            ];
        });

        return view('admin.services.index', compact('services', 'officers', 'stats'));
    }

    /**
     * Show create service form.
     */
    public function create()
    {
        // Cache categories for 10 minutes
        $categories = Cache::remember('admin.services.categories', 600, function () {
            return Service::select('category')
                ->whereNotNull('category')
                ->distinct()
                ->orderBy('category')
                ->pluck('category');
        });
        
        return view('admin.services.create', compact('categories'));
    }

    /**
     * Show edit service form.
     */
    public function edit(Service $service)
    {
        $categories = Service::select('category')
            ->whereNotNull('category')
            ->distinct()
            ->orderBy('category')
            ->pluck('category');
        
        return view('admin.services.edit', compact('service', 'categories'));
    }

    /**
     * Store a new service.
     */
    public function store(Request $request)
    {
        try {
            $validated = $request->validate([
                'title' => 'required|string|max:255',
                'description' => 'required|string',
                'icon' => 'nullable|string|max:50',
                'price_primary' => 'nullable|numeric|min:0',
                'price_secondary' => 'nullable|numeric|min:0',
                'price_label' => 'nullable|string|max:100',
                'category' => 'nullable|string|max:100',
                'is_active' => 'boolean',
            ]);

            $validated['slug'] = Str::slug($validated['title']);
            $validated['sort_order'] = (Service::max('sort_order') ?? 0) + 1;
            $validated['icon'] = $validated['icon'] ?? '🖨️';
            $validated['is_active'] = $request->boolean('is_active', true);
            if (empty($validated['category'])) {
                $validated['category'] = 'General';
            }

            $service = Service::create($validated);

            // Clear admin caches
            Cache::forget('admin.services.list');
            Cache::forget('admin.services.stats');
            Cache::forget('admin.services.categories');
            
            // Clear public-facing caches
            Cache::forget('homepage.featured_services');
            Cache::forget('homepage.service_categories');
            Cache::forget('services.index.all');
            Cache::forget('services.officers');

            return redirect()->route('admin.services.index')
                ->with('success', 'Service created successfully!');
                
        } catch (\Illuminate\Validation\ValidationException $e) {
            return back()->withErrors($e->errors())->withInput();
        } catch (\Exception $e) {
            \Log::error('Service creation failed: ' . $e->getMessage(), [
                'exception' => $e,
                'request' => $request->all()
            ]);
            
            return back()->with('error', 'Failed to save service: ' . $e->getMessage())->withInput();
        }
    }

    /**
     * Update an existing service.
     */
    public function update(Request $request, Service $service)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'icon' => 'nullable|string|max:50',
            'price_primary' => 'nullable|numeric|min:0',
            'price_secondary' => 'nullable|numeric|min:0',
            'price_label' => 'nullable|string|max:100',
            'category' => 'nullable|string|max:100',
            'is_active' => 'boolean',
        ]);

        $validated['is_active'] = $request->boolean('is_active', true);
        if (empty($validated['category'])) {
            $validated['category'] = 'General';
        }

        $service->update($validated);

        // Clear admin caches
        Cache::forget('admin.services.list');
        Cache::forget('admin.services.stats');
        Cache::forget('admin.services.categories');
        
        // Clear public-facing caches
        Cache::forget('homepage.featured_services');
        Cache::forget('homepage.service_categories');
        Cache::forget('services.index.all');
        Cache::forget('services.officers');

        return redirect()->route('admin.services.index')
            ->with('success', 'Service updated successfully!');
    }

    /**
     * Delete a service.
     */
    public function destroy(Service $service)
    {
        $service->delete();

        // Clear admin caches
        Cache::forget('admin.services.list');
        Cache::forget('admin.services.stats');
        Cache::forget('admin.services.categories');
        
        // Clear public-facing caches
        Cache::forget('homepage.featured_services');
        Cache::forget('homepage.service_categories');
        Cache::forget('services.index.all');
        Cache::forget('services.officers');

        return response()->json([
            'success' => true,
            'message' => 'Service deleted successfully!',
        ]);
    }

    /**
     * Toggle service active status.
     */
    public function toggleStatus(Service $service)
    {
        $service->update(['is_active' => !$service->is_active]);

        // Clear admin caches
        Cache::forget('admin.services.list');
        Cache::forget('admin.services.stats');
        Cache::forget('admin.services.categories');
        
        // Clear public-facing caches
        Cache::forget('homepage.featured_services');
        Cache::forget('homepage.service_categories');
        Cache::forget('services.index.all');
        Cache::forget('services.officers');

        return response()->json([
            'success' => true,
            'is_active' => $service->is_active,
            'message' => $service->is_active ? 'Service activated!' : 'Service deactivated!',
        ]);
    }

    /**
     * Show all options for a service.
     */
    public function indexOptions(Service $service)
    {
        $options = $service->options()->orderBy('created_at')->get();
        return view('admin.services.options.index', compact('service', 'options'));
    }

    /**
     * Show create option form.
     */
    public function createOption(Service $service)
    {
        return view('admin.services.options.create', compact('service'));
    }

    /**
     * Store a service option.
     */
    public function storeOption(Request $request, Service $service)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'dimensions' => 'nullable|string|max:100',
            'price_primary' => 'nullable|numeric|min:0',
            'price_secondary' => 'nullable|numeric|min:0',
            'price_primary_label' => 'nullable|string|max:100',
            'price_secondary_label' => 'nullable|string|max:100',
            'size_class' => 'required|in:short,standard,long',
            'badge' => 'nullable|string|max:100',
            'is_active' => 'boolean',
        ]);

        $validated['sort_order'] = $service->options()->max('sort_order') + 1;
        $validated['is_active'] = $request->boolean('is_active', true);

        $option = $service->options()->create($validated);

        return redirect()->route('admin.services.options.index', $service)
            ->with('success', 'Option created successfully!');
    }

    /**
     * Show edit option form.
     */
    public function editOption(ServiceOption $option)
    {
        return view('admin.services.options.edit', compact('option'));
    }

    /**
     * Update a service option.
     */
    public function updateOption(Request $request, ServiceOption $option)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'dimensions' => 'nullable|string|max:100',
            'price_primary' => 'nullable|numeric|min:0',
            'price_secondary' => 'nullable|numeric|min:0',
            'price_primary_label' => 'nullable|string|max:100',
            'price_secondary_label' => 'nullable|string|max:100',
            'size_class' => 'required|in:short,standard,long',
            'badge' => 'nullable|string|max:100',
            'is_active' => 'boolean',
        ]);

        $validated['is_active'] = $request->boolean('is_active', true);

        $option->update($validated);

        return redirect()->route('admin.services.options.index', $option->service)
            ->with('success', 'Option updated successfully!');
    }

    /**
     * Delete a service option.
     */
    public function destroyOption(ServiceOption $option)
    {
        $service = $option->service;
        $option->delete();

        return redirect()->route('admin.services.options.index', $service)
            ->with('success', 'Option deleted successfully!');
    }

    /**
     * Show officers index page.
     */
    public function officersIndex()
    {
        $officers = ServiceOfficer::ordered()->get();
        
        $stats = [
            'total_officers' => ServiceOfficer::count(),
            'active_officers' => ServiceOfficer::whereRaw('"is_active" IS TRUE')->count(),
        ];

        return view('admin.service-officers.index', compact('officers', 'stats'));
    }

    /**
     * Show create officer form.
     */
    public function officersCreate()
    {
        return view('admin.service-officers.create');
    }

    /**
     * Show edit officer form.
     */
    public function officersEdit(ServiceOfficer $officer)
    {
        return view('admin.service-officers.edit', compact('officer'));
    }

    /**
     * Store a new officer.
     */
    public function storeOfficer(Request $request)
    {
        try {
            $validated = $request->validate([
                'name' => 'required|string|max:255',
                'title' => 'nullable|string|max:255',
                'messenger_url' => 'nullable|url|max:500',
                'is_active' => 'boolean',
            ]);

            $validated['title'] = $validated['title'] ?? 'PRINTING OFFICER';
            $validated['sort_order'] = (ServiceOfficer::max('sort_order') ?? 0) + 1;
            $validated['is_active'] = $request->boolean('is_active', true);

            $officer = ServiceOfficer::create($validated);

            // Clear caches
            Cache::forget('admin.service_officers.list');
            Cache::forget('admin.services.stats');

            return redirect()->route('admin.service-officers.index')
                ->with('success', 'Officer added successfully!');
                
        } catch (\Exception $e) {
            \Log::error('Officer creation failed: ' . $e->getMessage());
            return back()->with('error', 'Failed to add officer: ' . $e->getMessage())->withInput();
        }
    }

    /**
     * Update an officer.
     */
    public function updateOfficer(Request $request, ServiceOfficer $officer)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'title' => 'nullable|string|max:255',
            'messenger_url' => 'nullable|url|max:500',
            'is_active' => 'boolean',
        ]);

        $validated['is_active'] = $request->boolean('is_active', true);
        
        $officer->update($validated);

        // Clear caches
        Cache::forget('admin.service_officers.list');
        Cache::forget('admin.services.stats');

        return redirect()->route('admin.service-officers.index')
            ->with('success', 'Officer updated successfully!');
    }

    /**
     * Delete an officer.
     */
    public function destroyOfficer(ServiceOfficer $officer)
    {
        $officer->delete();

        // Clear caches
        Cache::forget('admin.service_officers.list');
        Cache::forget('admin.services.stats');

        return redirect()->route('admin.service-officers.index')
            ->with('success', 'Officer removed successfully!');
    }
}
