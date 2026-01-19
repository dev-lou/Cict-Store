<x-admin-layout>
    @section('page-title', 'Service Officers')

    <!-- Breadcrumb -->
    <x-admin.breadcrumb :items="[
        ['label' => 'Catalog'],
        ['label' => 'Service Officers']
    ]" />

    <style>
        :root {
            --bg-main: #0f172a;
            --bg-card: #1e293b;
            --bg-hover: #334155;
            --border: #334155;
            --primary: #3b82f6;
            --success: #10b981;
            --danger: #ef4444;
            --text-primary: #f1f5f9;
            --text-secondary: #94a3b8;
        }

        .officer-card {
            background: var(--bg-card);
            border: 1px solid var(--border);
            border-radius: 12px;
            padding: 20px;
            display: flex;
            align-items: center;
            gap: 16px;
            transition: all 0.2s;
        }

        .officer-card:hover {
            border-color: var(--primary);
            transform: translateY(-2px);
        }

        .avatar {
            width: 56px;
            height: 56px;
            border-radius: 50%;
            background: linear-gradient(135deg, var(--primary), #2563eb);
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-weight: 700;
            font-size: 18px;
        }

        .btn-primary {
            background: var(--primary);
            color: white;
            padding: 10px 20px;
            border-radius: 8px;
            border: none;
            cursor: pointer;
            font-weight: 600;
            transition: all 0.2s;
        }

        .btn-primary:hover {
            background: #2563eb;
        }

        .btn-action {
            padding: 6px 12px;
            border-radius: 6px;
            border: 1px solid var(--border);
            background: transparent;
            color: var(--text-secondary);
            cursor: pointer;
            font-size: 13px;
            transition: all 0.2s;
        }

        .btn-action:hover {
            background: var(--bg-hover);
            color: var(--text-primary);
        }

        .btn-action.danger:hover {
            background: var(--danger);
            color: white;
            border-color: var(--danger);
        }

        .badge {
            padding: 4px 8px;
            border-radius: 4px;
            font-size: 11px;
            font-weight: 600;
        }

        .badge.active {
            background: rgba(16, 185, 129, 0.2);
            color: var(--success);
        }

        .badge.inactive {
            background: rgba(100, 116, 139, 0.2);
            color: var(--text-secondary);
        }
    </style>

    <div class="p-6" style="background: var(--bg-main); min-height: calc(100vh - 4rem);">
        <div class="mb-6 flex justify-between items-start">
            <div>
                <h1 class="text-3xl font-bold" style="color: var(--text-primary);">Service Officers</h1>
                <p class="text-sm mt-1" style="color: var(--text-secondary);">Manage contact officers for student services</p>
            </div>
            <a href="{{ route('admin.service-officers.create') }}" class="btn-primary" style="text-decoration: none; display: inline-flex; align-items: center;">
                Add Officer
            </a>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
            @forelse($officers as $officer)
                <div class="officer-card">
                    <div class="avatar">{{ $officer->initials }}</div>
                    <div class="flex-1 min-w-0">
                        <div class="flex items-center gap-2 mb-1">
                            <div style="color: var(--text-primary); font-weight: 600; font-size: 15px;">{{ $officer->name }}</div>
                            <span class="badge {{ $officer->is_active ? 'active' : 'inactive' }}">
                                {{ $officer->is_active ? 'Active' : 'Inactive' }}
                            </span>
                        </div>
                        <div style="color: var(--text-secondary); font-size: 13px; margin-bottom: 4px;">
                            {{ $officer->title ?? 'OFFICER' }}
                        </div>
                        @if($officer->messenger_url)
                            <a href="{{ $officer->messenger_url }}" target="_blank" style="color: var(--primary); font-size: 12px; text-decoration: none;">
                                Messenger →
                            </a>
                        @endif
                    </div>
                    <div class="flex flex-col gap-2">
                        <a href="{{ route('admin.service-officers.edit', $officer) }}" class="btn-action" style="text-decoration: none; text-align: center;">
                            Edit
                        </a>
                        <form id="delete-officer-{{ $officer->id }}" action="{{ route('admin.service-officers.destroy', $officer) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="button" onclick="confirmDeleteOfficer({{ $officer->id }}, '{{ $officer->name }}')" class="btn-action danger" style="width: 100%;">Delete</button>
                        </form>
                    </div>
                </div>
            @empty
                <div class="col-span-full" style="color: var(--text-secondary); padding: 40px; text-align: center;">
                    <p class="text-lg mb-2">No officers yet</p>
                    <p class="text-sm">Add your first service officer to get started</p>
                </div>
            @endforelse
        </div>
    </div>

    <script>
        function confirmDeleteOfficer(id, name) {
            Swal.fire({
                title: 'Delete Officer?',
                text: `Are you sure you want to delete "${name}"? This action cannot be undone.`,
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#ef4444',
                cancelButtonColor: '#6b7280',
                confirmButtonText: 'Yes, delete it',
                cancelButtonText: 'Cancel'
            }).then((result) => {
                if (result.isConfirmed) {
                    document.getElementById('delete-officer-' + id).submit();
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
