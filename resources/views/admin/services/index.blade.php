<x-admin-layout>
    @section('page-title', 'Services Manager')

    <!-- Breadcrumb -->
    <x-admin.breadcrumb :items="[
        ['label' => 'Catalog'],
        ['label' => 'Services']
    ]" />

    @php
        $categories = $services
            ->map(function ($svc) {
                return [
                    'name' => $svc->category ?: 'General',
                ];
            })
            ->unique('name')
            ->values();

        if ($categories->where('name', 'General')->isEmpty()) {
            $categories->push(['name' => 'General', 'description' => null]);
        }
    @endphp

    <style>
        /* Modern Admin Palette */
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
            --warning: #f59e0b;
            --text-primary: #f1f5f9;
            --text-secondary: #94a3b8;
            --text-muted: #64748b;
        }

        .page-shell {
            background: var(--bg-main);
            min-height: calc(100vh - 4rem);
        }

        /* Header Section */
        .page-header {
            background: var(--bg-card);
            border-radius: 12px;
            padding: 24px;
            margin-bottom: 24px;
            border: 1px solid var(--border);
        }

        .page-title {
            color: var(--text-primary);
            font-size: 24px;
            font-weight: 700;
            margin-bottom: 4px;
        }

        .page-subtitle {
            color: var(--text-secondary);
            font-size: 14px;
        }

        /* Stats Section */
        .stats-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 16px;
            margin-bottom: 24px;
        }

        .stat-card {
            background: var(--bg-card);
            border: 1px solid var(--border);
            border-radius: 12px;
            padding: 20px;
            transition: all 0.2s ease;
        }

        .stat-card:hover {
            border-color: var(--border-hover);
            transform: translateY(-2px);
        }

        .stat-label {
            color: var(--text-secondary);
            font-size: 13px;
            font-weight: 500;
            margin-bottom: 8px;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .stat-value {
            color: var(--text-primary);
            font-size: 28px;
            font-weight: 700;
        }

        /* Services Grid */
        .services-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(340px, 1fr));
            gap: 20px;
            margin-bottom: 40px;
        }

        .service-card {
            background: var(--bg-card);
            border: 1px solid var(--border);
            border-radius: 12px;
            overflow: hidden;
            transition: all 0.2s ease;
            position: relative;
        }

        .service-card:hover {
            border-color: var(--border-hover);
            transform: translateY(-2px);
        }

        .service-card.inactive {
            opacity: 0.5;
        }

        .service-head {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 20px;
            border-bottom: 1px solid var(--border);
        }

        .service-icon {
            width: 48px;
            height: 48px;
            border-radius: 10px;
            background: linear-gradient(135deg, var(--primary) 0%, var(--primary-hover) 100%);
            display: grid;
            place-items: center;
            font-size: 24px;
            color: var(--text-primary);
            flex-shrink: 0;
        }

        .service-body {
            padding: 20px;
            color: var(--text-secondary);
            font-size: 14px;
            line-height: 1.5;
        }

        .service-title {
            color: var(--text-primary);
            font-weight: 600;
            font-size: 16px;
            margin-bottom: 4px;
        }

        .service-category {
            display: inline-block;
            padding: 4px 10px;
            border-radius: 6px;
            background: rgba(59, 130, 246, 0.1);
            border: 1px solid rgba(59, 130, 246, 0.2);
            color: var(--primary);
            font-weight: 600;
            font-size: 11px;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            margin-bottom: 12px;
        }

        .service-description {
            color: var(--text-secondary);
            margin-bottom: 12px;
            line-height: 1.5;
        }

        .meta-row {
            display: flex;
            flex-wrap: wrap;
            gap: 8px;
        }

        .price-chip {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            padding: 6px 12px;
            border-radius: 6px;
            background: rgba(16, 185, 129, 0.1);
            border: 1px solid rgba(16, 185, 129, 0.2);
            color: var(--success);
            font-weight: 600;
            font-size: 13px;
        }

        .meta-badge {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            padding: 6px 12px;
            border-radius: 6px;
            background: rgba(148, 163, 184, 0.1);
            border: 1px solid rgba(148, 163, 184, 0.2);
            color: var(--text-secondary);
            font-weight: 500;
            font-size: 12px;
        }

        .actions {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 8px;
            padding: 16px;
            border-top: 1px solid var(--border);
            background: rgba(15, 23, 42, 0.5);
        }

        .btn-action {
            padding: 10px 14px;
            border-radius: 8px;
            border: 1px solid var(--border);
            color: var(--text-primary);
            background: transparent;
            font-weight: 600;
            font-size: 13px;
            transition: all 0.2s ease;
            cursor: pointer;
        }

        .btn-action:hover {
            border-color: var(--primary);
            background: rgba(59, 130, 246, 0.1);
            color: var(--primary);
        }

        .btn-action.danger:hover {
            border-color: var(--danger);
            background: rgba(239, 68, 68, 0.1);
            color: var(--danger);
        }

        .toggle {
            width: 48px;
            height: 24px;
            border-radius: 12px;
            background: var(--border);
            position: relative;
            cursor: pointer;
            transition: all 0.2s ease;
            flex-shrink: 0;
        }
        .toggle::after {
            content: '';
            position: absolute;
            width: 18px;
            height: 18px;
            top: 3px;
            left: 3px;
            border-radius: 50%;
            background: var(--text-primary);
            transition: all 0.2s ease;
        }
        .toggle.active {
            background: var(--success);
        }
        .toggle.active::after {
            left: 27px;
        }

        /* Officers Section */
        .officer-card {
            background: var(--bg-card);
            border: 1px solid var(--border);
            border-radius: 12px;
            padding: 16px;
            display: flex;
            align-items: center;
            gap: 14px;
            transition: all 0.2s ease;
        }
        .officer-card:hover {
            border-color: var(--border-hover);
            transform: translateY(-2px);
        }
        .avatar {
            width: 48px;
            height: 48px;
            border-radius: 10px;
            background: linear-gradient(135deg, var(--primary) 0%, var(--primary-hover) 100%);
            color: var(--text-primary);
            font-weight: 700;
            display: grid;
            place-items: center;
            font-size: 16px;
            flex-shrink: 0;
        }

        /* Modals */
        .modal-overlay {
            position: fixed;
            inset: 0;
            background: rgba(0, 0, 0, 0.75);
            display: none;
            align-items: center;
            justify-content: center;
            padding: 20px;
            z-index: 50;
            backdrop-filter: blur(4px);
        }
        .modal-overlay.active {
            display: flex;
        }
        .modal-card {
            background: var(--bg-card);
            border: 1px solid var(--border);
            border-radius: 16px;
            width: 100%;
            max-width: 620px;
            max-height: 90vh;
            overflow: auto;
            box-shadow: 0 20px 50px rgba(0, 0, 0, 0.5);
        }
        .modal-header {
            padding: 20px 24px;
            border-bottom: 1px solid var(--border);
            display: flex;
            justify-content: space-between;
            align-items: center;
            color: var(--text-primary);
            font-weight: 600;
            font-size: 18px;
        }
        .modal-body {
            padding: 24px;
            color: var(--text-primary);
        }
        .modal-footer {
            padding: 16px 24px;
            border-top: 1px solid var(--border);
            display: flex;
            gap: 10px;
            justify-content: flex-end;
            background: rgba(15, 23, 42, 0.5);
        }
        .input {
            width: 100%;
            background: var(--bg-main);
            border: 1px solid var(--border);
            border-radius: 8px;
            padding: 12px 14px;
            color: var(--text-primary);
            font-size: 14px;
            transition: all 0.2s ease;
        }
        select.input,
        select.input:focus,
        select.input:hover {
            color: var(--text-primary) !important;
            background-color: var(--bg-main) !important;
        }
        select.input option,
        select.input option:checked,
        select.input option:active,
        select.input option:hover {
            color: var(--text-primary) !important;
            background-color: var(--bg-card) !important;
        }
        .input:focus {
            outline: none;
            border-color: var(--primary);
            box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.1);
        }
        .label {
            font-weight: 600;
            color: var(--text-primary);
            margin-bottom: 8px;
            display: block;
            font-size: 13px;
        }
        .btn-primary {
            background: var(--primary);
            color: white;
            border: 0;
            border-radius: 8px;
            padding: 12px 20px;
            font-weight: 600;
            font-size: 14px;
            cursor: pointer;
            transition: all 0.2s ease;
        }
        .btn-primary:hover {
            background: var(--primary-hover);
        }
        .btn-secondary {
            background: transparent;
            color: var(--text-secondary);
            border: 1px solid var(--border);
            border-radius: 8px;
            padding: 12px 20px;
            font-weight: 600;
            font-size: 14px;
            cursor: pointer;
            transition: all 0.2s ease;
        }
        .btn-secondary:hover {
            border-color: var(--border-hover);
            color: var(--text-primary);
        }

        .icon-grid {
            display: grid;
            grid-template-columns: repeat(8, 1fr);
            gap: 8px;
        }
        .icon-pick {
            border: 1px solid var(--border);
            border-radius: 8px;
            padding: 12px;
            text-align: center;
            cursor: pointer;
            transition: all 0.2s ease;
            font-size: 20px;
        }
        .icon-pick:hover {
            border-color: var(--primary);
            background: rgba(59, 130, 246, 0.05);
        }
        .icon-pick.selected {
            border-color: var(--primary);
            background: rgba(59, 130, 246, 0.1);
        }

        .helper-text {
            color: var(--text-muted);
            font-size: 12px;
            margin-top: 6px;
        }

        .toast {
            position: fixed;
            bottom: 24px;
            right: 24px;
            padding: 14px 20px;
            border-radius: 12px;
            color: white;
            font-weight: 600;
            z-index: 60;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.3);
        }

        .section-title {
            color: var(--text-primary);
            font-weight: 700;
            font-size: 18px;
            margin-bottom: 16px;
        }
    </style>

    <div class="page-shell p-6">
        <div class="page-header">
            <div class="flex justify-between items-start">
                <div>
                    <h1 class="page-title">Services Management</h1>
                    <p class="page-subtitle">Manage services and their options</p>
                </div>
                <div class="flex gap-2">
                    <a href="{{ route('admin.services.create') }}" class="btn-primary" style="text-decoration: none; display: inline-flex; align-items: center;">Add Service</a>
                </div>
            </div>
        </div>

        <div class="stats-grid">
            <div class="stat-card">
                <div class="stat-label">Total Services</div>
                <div class="stat-value">{{ $stats['total_services'] }}</div>
            </div>
            <div class="stat-card">
                <div class="stat-label">Active Services</div>
                <div class="stat-value">{{ $stats['active_services'] }}</div>
            </div>
        </div>

        <h2 class="section-title">Services</h2>
        <div class="services-grid" id="servicesGrid">
            @forelse($services as $service)
                <div class="service-card {{ $service->is_active ? '' : 'inactive' }}" data-id="{{ $service->id }}">
                    <div class="service-head">
                        <div class="flex items-center gap-3 flex-1 min-w-0">
                            <div class="service-icon">{{ $service->icon ?? '🖨️' }}</div>
                            <div class="flex-1 min-w-0">
                                <div class="service-title">{{ $service->title }}</div>
                                <div class="service-category">{{ strtoupper($service->category) }}</div>
                            </div>
                        </div>
                        <div class="toggle {{ $service->is_active ? 'active' : '' }}" onclick="toggleService({{ $service->id }})"></div>
                    </div>
                    <div class="service-body">
                        <p class="service-description">{{ \Illuminate\Support\Str::limit($service->description, 140) }}</p>
                        <div class="meta-row">
                            @php $displayPrice = $service->price_primary ?? $service->price_secondary; @endphp
                            @if($displayPrice)
                                <span class="price-chip">₱{{ number_format($displayPrice, 2) }}</span>
                            @endif
                            @if($service->price_label)
                                <span class="meta-badge">{{ $service->price_label }}</span>
                            @endif
                            @if($service->options->count())
                                <span class="meta-badge">{{ $service->options->count() }} options</span>
                            @endif
                        </div>
                    </div>
                    <div class="actions">
                        <a href="{{ route('admin.services.edit', $service) }}" class="btn-action" style="text-decoration: none;">Edit</a>
                        <a href="{{ route('admin.services.options.index', $service) }}" class="btn-action" style="text-decoration: none;">Options</a>
                        <button class="btn-action danger" onclick="deleteService({{ $service->id }})">Delete</button>
                    </div>
                </div>
            @empty
                <div style="color: var(--text-secondary); padding: 20px;">No services found.</div>
            @endforelse
        </div>
    </div>

    <script>
        const servicesData = @json($services);

        function showToast(msg, type = 'info') {
            const el = document.createElement('div');
            el.className = 'toast';
            el.textContent = msg;
            if (type === 'success') el.style.background = 'var(--success)';
            else if (type === 'error') el.style.background = 'var(--danger)';
            else el.style.background = 'var(--primary)';
            document.body.appendChild(el);
            setTimeout(() => { el.style.opacity = '0'; el.style.transform = 'translateY(10px)'; }, 2500);
            setTimeout(() => el.remove(), 3200);
        }

        async function deleteService(id) {
            const service = servicesData.find(s => s.id === id);
            const serviceName = service ? service.title : 'this service';
            
            const result = await Swal.fire({
                title: 'Delete Service?',
                text: `Are you sure you want to delete "${serviceName}"? This will also delete all related options.`,
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#ef4444',
                cancelButtonColor: '#6b7280',
                confirmButtonText: 'Yes, delete it',
                cancelButtonText: 'Cancel'
            });

            if (!result.isConfirmed) return;

            try {
                const res = await fetch(`/admin/services-management/${id}`, {
                    method: 'DELETE',
                    headers: { 'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content, 'Accept': 'application/json' }
                });
                const data = await res.json();
                if (data.success) { 
                    await Swal.fire({
                        icon: 'success',
                        title: 'Deleted!',
                        text: data.message,
                        timer: 2000,
                        showConfirmButton: false
                    });
                    location.reload();
                } else {
                    Swal.fire({
                        icon: 'error',
                        title: 'Error!',
                        text: 'Delete failed',
                        confirmButtonColor: '#ef4444'
                    });
                }
            } catch {
                Swal.fire({
                    icon: 'error',
                    title: 'Error!',
                    text: 'Delete failed',
                    confirmButtonColor: '#ef4444'
                });
            }
        }

        async function toggleService(id) {
            try {
                const res = await fetch(`/admin/services-management/${id}/toggle`, {
                    method: 'PATCH',
                    headers: { 'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content, 'Accept': 'application/json' }
                });
                const data = await res.json();
                if (data.success) { 
                    await Swal.fire({
                        icon: 'success',
                        title: 'Success!',
                        text: data.message,
                        timer: 2000,
                        showConfirmButton: false
                    });
                    location.reload();
                }
            } catch { 
                Swal.fire({
                    icon: 'error',
                    title: 'Error!',
                    text: 'Toggle failed',
                    confirmButtonColor: '#ef4444'
                });
            }
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
