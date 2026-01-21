<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\AuditLog;
use Illuminate\Http\Request;

class AuditLogController extends Controller
{
    /**
     * Display a listing of all audit logs.
     */
    public function index(Request $request)
    {
        $query = AuditLog::with('user:id,name')
            ->select('id', 'user_id', 'action', 'model_type', 'model_id', 'old_values', 'new_values', 'created_at')
            ->orderBy('created_at', 'desc');

        // Filter by action if provided
        if ($request->filled('action')) {
            $query->where('action', $request->action);
        }

        // Filter by model if provided
        if ($request->filled('model')) {
            $query->where('model_type', $request->model);
        }

        // Search by user name if provided
        if ($request->filled('search')) {
            $query->whereHas('user', function ($q) {
                $q->where('name', 'like', '%' . request('search') . '%');
            });
        }

        $logs = $query->paginate(15);
        
        // Cache distinct models for 10 minutes
        $models = \Cache::remember('audit_log_models', 600, function() {
            return AuditLog::distinct('model_type')->pluck('model_type');
        });

        return view('admin.audit-logs.index', [
            'logs' => $logs,
            'models' => $models,
        ]);
    }

    /**
     * Display a specific audit log entry.
     */
    public function show(AuditLog $auditLog)
    {
        return view('admin.audit-logs.show', [
            'log' => $auditLog->load('user:id,name,email'),
        ]);
    }
}

