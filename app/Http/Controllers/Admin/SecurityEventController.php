<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\FailedLoginAttempt;
use Illuminate\Http\Request;

class SecurityEventController extends Controller
{
    /**
     * Show recent security events related to login failures.
     */
    public function index(Request $request)
    {
        $query = FailedLoginAttempt::query()
            ->select(['id', 'ip_address', 'email', 'user_agent', 'attempted_at', 'blocked_until', 'created_at'])
            ->orderByDesc('attempted_at');

        if ($request->filled('ip')) {
            $query->where('ip_address', 'like', '%' . trim((string) $request->input('ip')) . '%');
        }

        if ($request->filled('email')) {
            $query->where('email', 'like', '%' . strtolower(trim((string) $request->input('email'))) . '%');
        }

        if ($request->filled('status')) {
            if ($request->input('status') === 'blocked') {
                $query->whereNotNull('blocked_until')->where('blocked_until', '>', now());
            }

            if ($request->input('status') === 'failed') {
                $query->where(function ($inner) {
                    $inner->whereNull('blocked_until')->orWhere('blocked_until', '<=', now());
                });
            }
        }

        $events = $query->paginate(20)->withQueryString();

        return view('admin.security-events.index', [
            'events' => $events,
        ]);
    }
}
