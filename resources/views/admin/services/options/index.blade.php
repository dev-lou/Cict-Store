<x-admin-layout>
    <div class="page-header">
        <div>
            <h1 class="page-title">{{ $service->title }} - Options</h1>
            <p class="page-subtitle">Manage pricing options for this service</p>
        </div>
        <div class="header-actions">
            <a href="{{ route('admin.services.index') }}" class="btn-secondary">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
                </svg>
                Back to Services
            </a>
            <a href="{{ route('admin.services.options.create', $service) }}" class="btn-primary">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                </svg>
                Add Option
            </a>
        </div>
    </div>

    <div class="card">
        @if($options->count() > 0)
            <div class="table-responsive">
                <table class="data-table">
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Dimensions</th>
                            <th>Primary Price</th>
                            <th>Secondary Price</th>
                            <th>Badge</th>
                            <th>Size Class</th>
                            <th>Status</th>
                            <th class="text-right">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($options as $option)
                            <tr>
                                <td>
                                    <div class="font-medium" style="color: var(--text-primary);">{{ $option->name }}</div>
                                </td>
                                <td>
                                    <span class="text-sm" style="color: var(--text-secondary);">
                                        {{ $option->dimensions ?? '—' }}
                                    </span>
                                </td>
                                <td>
                                    @if($option->price_bw)
                                        <span class="font-semibold">₱{{ number_format($option->price_bw, 2) }}</span>
                                        @if($option->price_bw_label)
                                            <span class="text-xs text-gray-500 dark:text-gray-400">{{ $option->price_bw_label }}</span>
                                        @endif
                                    @else
                                        <span class="text-gray-400">—</span>
                                    @endif
                                </td>
                                <td>
                                    @if($option->price_color)
                                        <span class="font-semibold">₱{{ number_format($option->price_color, 2) }}</span>
                                        @if($option->price_color_label)
                                            <span class="text-xs text-gray-500 dark:text-gray-400">{{ $option->price_color_label }}</span>
                                        @endif
                                    @else
                                        <span class="text-gray-400">—</span>
                                    @endif
                                </td>
                                <td>
                                    @if($option->badge)
                                        <span class="badge badge-info">{{ $option->badge }}</span>
                                    @else
                                        <span class="text-gray-400">—</span>
                                    @endif
                                </td>
                                <td>
                                    <span class="text-sm capitalize">{{ $option->size_class ?? 'standard' }}</span>
                                </td>
                                <td>
                                    @if($option->is_active)
                                        <span class="badge badge-success">Active</span>
                                    @else
                                        <span class="badge badge-secondary">Inactive</span>
                                    @endif
                                </td>
                                <td class="text-right">
                                    <div class="inline-flex gap-2">
                                        <a href="{{ route('admin.services.options.edit', $option) }}" class="btn-ghost btn-sm">
                                            Edit
                                        </a>
                                        <form id="delete-option-{{ $option->id }}" action="{{ route('admin.services.options.destroy', $option) }}" method="POST" class="inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="button" onclick="confirmDeleteOption({{ $option->id }}, '{{ $option->name }}')" class="btn-ghost btn-sm text-red-600 hover:bg-red-50 dark:hover:bg-red-900/20">
                                                Delete
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @else
            <div class="empty-state">
                <svg class="empty-state-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4"/>
                </svg>
                <h3 class="empty-state-title">No options yet</h3>
                <p class="empty-state-text">Get started by creating your first pricing option for this service.</p>
                <a href="{{ route('admin.services.options.create', $service) }}" class="btn-primary mt-4">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                    </svg>
                    Add First Option
                </a>
            </div>
        @endif
    </div>

    <style>
        :root {
            --bg-main: #0f172a;
            --bg-card: #1e293b;
            --bg-hover: #334155;
            --border: #334155;
            --border-hover: #475569;
            --primary: #3b82f6;
            --primary-hover: #2563eb;
            --success: #10b981;
            --danger: #ef4444;
            --text-primary: #f1f5f9;
            --text-secondary: #94a3b8;
        }

        .page-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 2rem;
            gap: 1rem;
            flex-wrap: wrap;
            background: var(--bg-card);
            padding: 1.5rem;
            border-radius: 12px;
            border: 1px solid var(--border);
        }

        .page-title {
            font-size: 1.875rem;
            font-weight: 700;
            color: var(--text-primary);
            margin: 0;
        }

        .page-subtitle {
            font-size: 0.875rem;
            color: var(--text-secondary);
            margin: 0.25rem 0 0 0;
        }

        .header-actions {
            display: flex;
            gap: 0.75rem;
        }

        .btn-primary, .btn-secondary, .btn-ghost {
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            padding: 0.625rem 1.25rem;
            border-radius: 0.5rem;
            font-weight: 600;
            font-size: 0.875rem;
            transition: all 0.2s;
            text-decoration: none;
            border: none;
            cursor: pointer;
        }

        .btn-primary {
            background: var(--primary);
            color: white;
        }

        .btn-primary:hover {
            background: var(--primary-hover);
            transform: translateY(-1px);
        }

        .btn-secondary {
            background: var(--bg-card);
            color: var(--text-primary);
            border: 1px solid var(--border);
        }

        .btn-secondary:hover {
            background: var(--bg-hover);
            border-color: var(--border-hover);
        }

        .btn-ghost {
            background: transparent;
            color: var(--primary);
            padding: 0.5rem 1rem;
        }

        .btn-ghost:hover {
            background: var(--bg-hover);
        }

        .btn-sm {
            padding: 0.375rem 0.75rem;
            font-size: 0.8125rem;
        }

        .card {
            background: var(--bg-card);
            border-radius: 0.75rem;
            border: 1px solid var(--border);
            overflow: hidden;
        }

        .table-responsive {
            overflow-x: auto;
        }

        .data-table {
            width: 100%;
            border-collapse: collapse;
        }

        .data-table thead {
            background: var(--bg-main);
            border-bottom: 1px solid var(--border);
        }

        .data-table th {
            padding: 0.75rem 1rem;
            text-align: left;
            font-size: 0.75rem;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.05em;
            color: var(--text-secondary);
        }

        .data-table td {
            padding: 1rem;
            border-bottom: 1px solid var(--border);
            color: var(--text-primary);
        }

        .data-table tbody tr:last-child td {
            border-bottom: none;
        }

        .data-table tbody tr:hover {
            background: var(--bg-hover);
        }

        .badge {
            display: inline-block;
            padding: 0.25rem 0.625rem;
            border-radius: 9999px;
            font-size: 0.75rem;
            font-weight: 600;
        }

        .badge-success {
            background: rgba(16, 185, 129, 0.1);
            color: var(--success);
            border: 1px solid rgba(16, 185, 129, 0.2);
        }

        .badge-secondary {
            background: var(--bg-hover);
            color: var(--text-secondary);
        }

        .badge-info {
            background: rgba(59, 130, 246, 0.1);
            color: var(--primary);
            border: 1px solid rgba(59, 130, 246, 0.2);
        }

        .empty-state {
            padding: 4rem 2rem;
            text-align: center;
        }

        .empty-state-icon {
            width: 4rem;
            height: 4rem;
            margin: 0 auto 1rem;
            color: var(--text-secondary);
            opacity: 0.5;
        }

        .empty-state-title {
            font-size: 1.25rem;
            font-weight: 600;
            color: var(--text-primary);
            margin: 0 0 0.5rem 0;
        }

        .empty-state-text {
            color: var(--text-secondary);
            margin: 0;
        }

        .alert {
            padding: 1rem 1.5rem;
            border-radius: 0.5rem;
            margin-bottom: 1.5rem;
        }

        .alert-success {
            background: rgba(16, 185, 129, 0.1);
            color: var(--success);
            border: 1px solid rgba(16, 185, 129, 0.2);
        }

        .text-right {
            text-align: right;
        }

        .inline-flex {
            display: inline-flex;
        }

        .gap-2 {
            gap: 0.5rem;
        }

        .text-sm {
            font-size: 0.875rem;
        }

        .capitalize {
            text-transform: capitalize;
        }

        .font-medium {
            font-weight: 500;
        }

        .font-semibold {
            font-weight: 600;
        }

        .text-xs {
            font-size: 0.75rem;
        }

        .text-gray-400 {
            color: var(--text-secondary);
        }

        .text-gray-500 {
            color: var(--text-secondary);
        }

        .text-gray-600 {
            color: var(--text-secondary);
        }

        .text-red-600 {
            color: var(--danger);
        }

        .hover\:bg-red-50:hover {
            background: rgba(239, 68, 68, 0.1);
        }
    </style>

    <script>
        function confirmDeleteOption(id, name) {
            Swal.fire({
                title: 'Delete Option?',
                text: `Are you sure you want to delete "${name}"? This action cannot be undone.`,
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#ef4444',
                cancelButtonColor: '#6b7280',
                confirmButtonText: 'Yes, delete it',
                cancelButtonText: 'Cancel'
            }).then((result) => {
                if (result.isConfirmed) {
                    document.getElementById('delete-option-' + id).submit();
                }
            });
        }

        @if(session('success'))
            Swal.fire({
                icon: 'success',
                title: 'Success!',
                text: '{{ session('success') }}',
                timer: 3000,
                showConfirmButton: false
            });
        @endif

        @if(session('error'))
            Swal.fire({
                icon: 'error',
                title: 'Error!',
                text: '{{ session('error') }}',
                confirmButtonColor: '#ef4444'
            });
        @endif
    </script>
</x-admin-layout>
