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
                    'description' => $svc->category_description,
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
                    <p class="page-subtitle">Manage services, options, and officers</p>
                </div>
                <div class="flex gap-2">
                    <button class="btn-primary" onclick="openServiceModal()">Add Service</button>
                    <button class="btn-secondary" onclick="openOfficerModal()">Add Officer</button>
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
            <div class="stat-card">
                <div class="stat-label">Total Officers</div>
                <div class="stat-value">{{ $stats['total_officers'] }}</div>
            </div>
            <div class="stat-card">
                <div class="stat-label">Active Officers</div>
                <div class="stat-value">{{ $stats['active_officers'] }}</div>
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
                            @php $displayPrice = $service->price_bw ?? $service->price_color; @endphp
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
                        <button class="btn-action" onclick="editService({{ $service->id }})">Edit</button>
                        <button class="btn-action" onclick="manageOptions({{ $service->id }})">Options</button>
                        <button class="btn-action danger" onclick="deleteService({{ $service->id }})">Delete</button>
                    </div>
                </div>
            @empty
                <div style="color: var(--text-secondary); padding: 20px;">No services found.</div>
            @endforelse
        </div>

        <div class="mt-10 mb-4 flex items-center justify-between">
            <h2 class="section-title">Officers</h2>
            <button class="btn-secondary" onclick="openOfficerModal()">Add Officer</button>
        </div>
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-3">
            @forelse($officers as $officer)
                <div class="officer-card" data-id="{{ $officer->id }}">
                    <div class="avatar">{{ $officer->initials }}</div>
                    <div class="flex-1 min-w-0">
                        <div style="color: var(--text-primary); font-weight: 600; font-size: 15px;">{{ $officer->name }}</div>
                        <div style="color: var(--text-secondary); font-size: 12px;">{{ $officer->title ?? 'OFFICER' }}</div>
                        @if($officer->messenger_url)
                            <a href="{{ $officer->messenger_url }}" target="_blank" style="color: var(--primary); font-size: 12px; text-decoration: none;">Messenger</a>
                        @endif
                    </div>
                    <div class="flex gap-2">
                        <button class="btn-action" onclick="editOfficer({{ $officer->id }})">Edit</button>
                        <button class="btn-action danger" onclick="deleteOfficer({{ $officer->id }})">Delete</button>
                    </div>
                </div>
            @empty
                <div style="color: var(--text-secondary); padding: 20px;">No officers yet.</div>
            @endforelse
        </div>
    </div>

    <!-- Service Modal -->
    <div class="modal-overlay" id="serviceModal">
        <div class="modal-card">
            <div class="modal-header">
                <div id="serviceModalTitle">Add Service</div>
                <button class="btn-action" onclick="closeServiceModal()" style="border: none; padding: 8px;">✕</button>
            </div>
            <form id="serviceForm" onsubmit="submitService(event)">
                @csrf
                <input type="hidden" id="serviceId">
                <div class="modal-body">
                    <label class="label">Icon</label>
                    <input type="hidden" id="serviceIcon" value="🖨️">
                    <div class="icon-grid mb-4">
                        @foreach(['🖨️','🎨','📄','📦','🧾','✂️','🖼️','📐','💡','⚙️','🧵','🛠️','🎁','📊','🧮','🪄'] as $emoji)
                            <div class="icon-pick" data-icon="{{ $emoji }}" onclick="pickIcon('{{ $emoji }}')">{{ $emoji }}</div>
                        @endforeach
                    </div>
                    <div class="helper-text">Choose an emoji icon for the service</div>

                    <label class="label mt-4">Title</label>
                    <input class="input mb-1" id="serviceTitle" placeholder="Ex: Color Printing, Laptop Repair" required>
                    <div class="helper-text">Keep it short and descriptive</div>

                    <label class="label mt-4">Description</label>
                    <textarea class="input mb-1" id="serviceDescription" rows="3" placeholder="Ex: Vibrant full-color prints for presentations and projects." required></textarea>
                    <div class="helper-text">One or two sentences describing the service</div>

                    <div class="mt-4">
                        <label class="label">Price (₱)</label>
                        <input class="input" type="number" step="0.01" id="servicePriceBw" placeholder="Optional">
                    </div>
                    <div class="helper-text">Leave empty for free or on-request services</div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-3 mt-4">
                        <div>
                            <label class="label">Price Label</label>
                            <input class="input" id="servicePriceLabel" placeholder="per page, per set">
                            <div class="helper-text">Optional price note</div>
                        </div>
                        <div>
                            <label class="label">Category</label>
                            <select class="input" id="serviceCategorySelect" onchange="handleCategoryChange()">
                                @foreach($categories as $cat)
                                    <option value="{{ $cat['name'] }}">{{ $cat['name'] }}</option>
                                @endforeach
                                <option value="__new__">Create new category</option>
                            </select>
                            <div class="helper-text">Choose or create category</div>
                        </div>
                    </div>

                    <div id="categoryNameGroup" class="mt-4" style="display:none;">
                        <label class="label">New Category Name</label>
                        <input class="input" id="serviceCategory" placeholder="Ex: Document Processing, IT Support" />
                    </div>

                    <div id="categoryDescriptionGroup" class="mt-4">
                        <label class="label">Category Description</label>
                        <textarea class="input" id="serviceCategoryDescription" rows="2" placeholder="Short description for this category"></textarea>
                        <div class="helper-text">Optional description for the category</div>
                    </div>

                    <div class="flex items-center gap-4 mt-4">
                        <label class="flex items-center gap-2 text-sm" style="color: var(--text-secondary);">
                            <input type="checkbox" id="serviceActive" checked> Active
                        </label>
                        <div class="helper-text">Turn off to hide from customers</div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn-secondary" onclick="closeServiceModal()">Cancel</button>
                    <button type="submit" class="btn-primary" id="serviceSubmitBtn">Save</button>
                </div>
            </form>
        </div>
    </div>

    <!-- Options Modal -->
    <div class="modal-overlay" id="optionsModal">
        <div class="modal-card" style="max-width: 720px;">
            <div class="modal-header">
                <div>Manage Options</div>
                <button class="btn-action" onclick="closeOptionsModal()" style="border: none; padding: 8px;">✕</button>
            </div>
            <div class="modal-body">
                <input type="hidden" id="currentServiceId">
                <div id="optionsList" class="space-y-2 mb-4"></div>

                <form style="border-top: 1px solid var(--border); padding-top: 16px;" onsubmit="submitOption(event)">
                    @csrf
                    <input type="hidden" id="optId">
                    <h4 style="color: var(--text-primary); font-weight: 600; margin-bottom: 16px;" id="optFormTitle">Add Option</h4>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-3">
                        <div>
                            <label class="label">Name</label>
                            <input class="input" id="optName" required>
                        </div>
                        <div>
                            <label class="label">Details (optional)</label>
                            <input class="input" id="optDimensions" placeholder="e.g. Size, duration">
                        </div>
                    </div>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-3 mt-3">
                        <div>
                            <label class="label">Price</label>
                            <input class="input" type="number" step="0.01" id="optPriceBw" placeholder="Optional">
                        </div>
                        <div>
                            <label class="label">Secondary price</label>
                            <input class="input" type="number" step="0.01" id="optPriceColor" placeholder="Optional">
                        </div>
                    </div>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-3 mt-3">
                        <div>
                            <label class="label">Price label</label>
                            <input class="input" id="optPriceBwLabel" placeholder="e.g. B/W, Standard">
                        </div>
                        <div>
                            <label class="label">Secondary label</label>
                            <input class="input" id="optPriceColorLabel" placeholder="e.g. Colored, Premium">
                        </div>
                    </div>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-3 mt-3">
                        <div>
                            <label class="label">Badge</label>
                            <input class="input" id="optBadge" placeholder="Featured, Most Popular">
                        </div>
                        <div>
                            <label class="label">Card size</label>
                            <select class="input" id="optSizeClass">
                                <option value="short">Compact</option>
                                <option value="standard" selected>Standard</option>
                                <option value="long">Tall</option>
                            </select>
                        </div>
                    </div>
                    <div class="mt-3 flex items-center gap-3">
                        <label class="flex items-center gap-2 text-sm" style="color: var(--text-secondary);">
                            <input type="checkbox" id="optActive" checked> Active
                        </label>
                        <div class="helper-text">Pause option without deleting</div>
                    </div>
                    <div class="flex gap-2 mt-4">
                        <button type="submit" class="btn-primary" id="optSubmitBtn">Save Option</button>
                        <button type="button" class="btn-secondary" onclick="resetOptionForm()">Clear</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Officer Modal -->
    <div class="modal-overlay" id="officerModal">
        <div class="modal-card">
            <div class="modal-header">
                <div id="officerModalTitle">Add Officer</div>
                <button class="btn-action" onclick="closeOfficerModal()" style="border: none; padding: 8px;">✕</button>
            </div>
            <form id="officerForm" onsubmit="submitOfficer(event)">
                @csrf
                <input type="hidden" id="officerId">
                <div class="modal-body">
                    <label class="label">Name</label>
                    <input class="input mb-4" id="officerName" required>

                    <label class="label">Title</label>
                    <input class="input mb-4" id="officerTitle" placeholder="OFFICER">

                    <label class="label">Messenger URL</label>
                    <input class="input mb-4" id="officerMessenger" placeholder="https://www.messenger.com/...">

                    <label class="flex items-center gap-2 text-sm" style="color: var(--text-secondary);">
                        <input type="checkbox" id="officerActive" checked> Active
                    </label>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn-secondary" onclick="closeOfficerModal()">Cancel</button>
                    <button type="submit" class="btn-primary" id="officerSubmitBtn">Save</button>
                </div>
            </form>
        </div>
    </div>

    <script>
        const servicesData = @json($services);
        const categoryMeta = @json($categories->keyBy('name'));
        const officersData = @json($officers);

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

        // ---------- Service Modal ----------
        function openServiceModal() {
            document.getElementById('serviceModal').classList.add('active');
            document.getElementById('serviceModalTitle').textContent = 'Add Service';
            document.getElementById('serviceSubmitBtn').textContent = 'Create';
            document.getElementById('serviceForm').reset();
            document.getElementById('serviceId').value = '';
            document.getElementById('serviceIcon').value = '🖨️';
            document.querySelectorAll('.icon-pick').forEach(el => el.classList.remove('selected'));
            const categorySelect = document.getElementById('serviceCategorySelect');
            categorySelect.value = categorySelect.options[0]?.value || 'General';
            document.getElementById('serviceCategory').value = '';
            document.getElementById('serviceCategoryDescription').value = categoryMeta[categorySelect.value]?.description || '';
            handleCategoryChange();
        }
        function closeServiceModal() { document.getElementById('serviceModal').classList.remove('active'); }

        function pickIcon(icon) {
            document.getElementById('serviceIcon').value = icon;
            document.querySelectorAll('.icon-pick').forEach(el => el.classList.toggle('selected', el.dataset.icon === icon));
        }

        function editService(id) {
            const svc = servicesData.find(s => s.id === id);
            if (!svc) return;
            openServiceModal();
            document.getElementById('serviceModalTitle').textContent = 'Edit Service';
            document.getElementById('serviceSubmitBtn').textContent = 'Update';
            document.getElementById('serviceId').value = svc.id;
            document.getElementById('serviceTitle').value = svc.title;
            document.getElementById('serviceDescription').value = svc.description;
            document.getElementById('servicePriceBw').value = svc.price_bw || '';
            document.getElementById('servicePriceLabel').value = svc.price_label || '';
            document.getElementById('serviceActive').checked = !!svc.is_active;
            pickIcon(svc.icon || '🖨️');

            const categorySelect = document.getElementById('serviceCategorySelect');
            const currentCategory = svc.category || 'General';
            if ([...categorySelect.options].some(o => o.value === currentCategory)) {
                categorySelect.value = currentCategory;
            } else {
                const opt = document.createElement('option');
                opt.value = currentCategory;
                opt.textContent = currentCategory;
                categorySelect.prepend(opt);
                categorySelect.value = currentCategory;
            }
            document.getElementById('serviceCategory').value = '';
            document.getElementById('serviceCategoryDescription').value = svc.category_description || categoryMeta[currentCategory]?.description || '';
            handleCategoryChange(true);
        }

        function handleCategoryChange(isEdit = false) {
            const select = document.getElementById('serviceCategorySelect');
            const nameGroup = document.getElementById('categoryNameGroup');
            const nameInput = document.getElementById('serviceCategory');
            const descInput = document.getElementById('serviceCategoryDescription');
            const value = select.value;
            const isNew = value === '__new__';
            nameGroup.style.display = isNew ? 'block' : 'none';

            if (!isNew) {
                nameInput.value = '';
                descInput.value = categoryMeta[value]?.description || '';
            } else if (!isEdit) {
                nameInput.value = '';
                descInput.value = '';
            }
        }

        async function submitService(e) {
            e.preventDefault();
            const id = document.getElementById('serviceId').value;
            const isEdit = !!id;
            const selectedCategory = document.getElementById('serviceCategorySelect').value;
            const categoryNameInput = document.getElementById('serviceCategory').value.trim();
            const resolvedCategory = selectedCategory === '__new__' ? categoryNameInput : selectedCategory;
            if (!resolvedCategory) { showToast('Category name is required', 'error'); return; }
            const payload = {
                title: document.getElementById('serviceTitle').value,
                description: document.getElementById('serviceDescription').value,
                icon: document.getElementById('serviceIcon').value,
                price_bw: document.getElementById('servicePriceBw').value || null,
                price_label: document.getElementById('servicePriceLabel').value,
                category: resolvedCategory,
                category_description: document.getElementById('serviceCategoryDescription').value,
                is_active: document.getElementById('serviceActive').checked,
            };
            const url = isEdit ? `/admin/services-management/${id}` : '/admin/services-management';
            const method = isEdit ? 'PATCH' : 'POST';
            try {
                const res = await fetch(url, {
                    method,
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                        'Accept': 'application/json'
                    },
                    body: JSON.stringify(payload)
                });
                const data = await res.json();
                if (data.success) {
                    showToast(data.message, 'success');
                    closeServiceModal();
                    setTimeout(() => location.reload(), 700);
                } else {
                    showToast('Failed to save service', 'error');
                }
            } catch (err) {
                showToast('Error saving service', 'error');
            }
        }

        async function deleteService(id) {
            if (!confirm('Delete this service?')) return;
            try {
                const res = await fetch(`/admin/services-management/${id}`, {
                    method: 'DELETE',
                    headers: { 'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content, 'Accept': 'application/json' }
                });
                const data = await res.json();
                if (data.success) { showToast(data.message, 'success'); setTimeout(() => location.reload(), 400); }
                else showToast('Delete failed', 'error');
            } catch { showToast('Delete failed', 'error'); }
        }

        async function toggleService(id) {
            try {
                const res = await fetch(`/admin/services-management/${id}/toggle`, {
                    method: 'PATCH',
                    headers: { 'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content, 'Accept': 'application/json' }
                });
                const data = await res.json();
                if (data.success) { showToast(data.message, 'success'); setTimeout(() => location.reload(), 300); }
            } catch { showToast('Toggle failed', 'error'); }
        }

        // ---------- Options ----------
        function manageOptions(serviceId) {
            const svc = servicesData.find(s => s.id === serviceId);
            if (!svc) return;
            document.getElementById('currentServiceId').value = serviceId;
            window.currentOptions = svc.options || [];
            resetOptionForm();
            renderOptions(window.currentOptions);
            document.getElementById('optionsModal').classList.add('active');
        }
        function closeOptionsModal() { document.getElementById('optionsModal').classList.remove('active'); }

        function renderOptions(options) {
            const list = document.getElementById('optionsList');
            if (!options.length) {
                list.innerHTML = '<div style="color: var(--text);">No options yet.</div>';
                return;
            }
            list.innerHTML = options.map(opt => `
                <div style="border:1px solid var(--border); border-radius:10px; padding:10px; display:flex; align-items:center; justify-content:space-between; gap:10px;">
                    <div>
                        <div style="color: var(--white); font-weight:800;">${opt.name}</div>
                        <div style="color: var(--text); font-size:12px;">${opt.dimensions || ''}</div>
                        <div style="color: var(--text); font-size:12px;">${opt.price_bw_label || 'Price'}: ${opt.price_bw ? '₱'+parseFloat(opt.price_bw).toFixed(2) : '—'} | ${opt.price_color_label || 'Secondary'}: ${opt.price_color ? '₱'+parseFloat(opt.price_color).toFixed(2) : '—'}</div>
                        ${opt.badge ? `<div style="color: var(--cyan); font-size:12px; font-weight:700; margin-top:4px;">${opt.badge}</div>` : ''}
                    </div>
                    <div class="flex gap-2">
                        <button class="btn-ghost" onclick="editOption(${opt.id})">✏️</button>
                        <button class="btn-ghost" style="border-color: rgba(255,107,107,0.5); color:#ffb3b3;" onclick="deleteOption(${opt.id})">🗑</button>
                    </div>
                </div>
            `).join('');
        }

        function resetOptionForm() {
            document.getElementById('optId').value = '';
            document.getElementById('optName').value = '';
            document.getElementById('optDimensions').value = '';
            document.getElementById('optPriceBw').value = '';
            document.getElementById('optPriceColor').value = '';
            document.getElementById('optPriceBwLabel').value = '';
            document.getElementById('optPriceColorLabel').value = '';
            document.getElementById('optBadge').value = '';
            document.getElementById('optSizeClass').value = 'standard';
            document.getElementById('optActive').checked = true;
            document.getElementById('optFormTitle').textContent = 'Add Option';
            document.getElementById('optSubmitBtn').textContent = 'Save Option';
        }

        function editOption(id) {
            if (!window.currentOptions) return;
            const opt = window.currentOptions.find(o => o.id === id);
            if (!opt) return;
            document.getElementById('optId').value = opt.id;
            document.getElementById('optName').value = opt.name || '';
            document.getElementById('optDimensions').value = opt.dimensions || '';
            document.getElementById('optPriceBw').value = opt.price_bw || '';
            document.getElementById('optPriceColor').value = opt.price_color || '';
            document.getElementById('optPriceBwLabel').value = opt.price_bw_label || '';
            document.getElementById('optPriceColorLabel').value = opt.price_color_label || '';
            document.getElementById('optBadge').value = opt.badge || '';
            document.getElementById('optSizeClass').value = opt.size_class || 'standard';
            document.getElementById('optActive').checked = !!opt.is_active;
            document.getElementById('optFormTitle').textContent = 'Edit Option';
            document.getElementById('optSubmitBtn').textContent = 'Update Option';
        }

        async function submitOption(e) {
            e.preventDefault();
            const serviceId = document.getElementById('currentServiceId').value;
            const optId = document.getElementById('optId').value;
            const payload = {
                name: document.getElementById('optName').value,
                dimensions: document.getElementById('optDimensions').value,
                price_bw: document.getElementById('optPriceBw').value || null,
                price_color: document.getElementById('optPriceColor').value || null,
                price_bw_label: document.getElementById('optPriceBwLabel').value,
                price_color_label: document.getElementById('optPriceColorLabel').value,
                badge: document.getElementById('optBadge').value,
                size_class: document.getElementById('optSizeClass').value,
                is_active: document.getElementById('optActive').checked,
            };
            if (!payload.name) { showToast('Name required', 'error'); return; }

            const isEdit = !!optId;
            const url = isEdit ? `/admin/services-management/options/${optId}` : `/admin/services-management/${serviceId}/options`;
            const method = isEdit ? 'PATCH' : 'POST';
            try {
                const res = await fetch(url, {
                    method,
                    headers: { 'Content-Type': 'application/json', 'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content, 'Accept': 'application/json' },
                    body: JSON.stringify(payload)
                });
                const data = await res.json();
                if (data.success) {
                    showToast(data.message, 'success');
                    setTimeout(() => location.reload(), 500);
                } else {
                    showToast('Save option failed', 'error');
                }
            } catch { showToast('Save option failed', 'error'); }
        }

        async function deleteOption(id) {
            if (!confirm('Delete this option?')) return;
            try {
                const res = await fetch(`/admin/services-management/options/${id}`, {
                    method: 'DELETE',
                    headers: { 'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content, 'Accept': 'application/json' }
                });
                const data = await res.json();
                if (data.success) { showToast(data.message, 'success'); setTimeout(() => location.reload(), 400); }
                else showToast('Delete failed', 'error');
            } catch { showToast('Delete failed', 'error'); }
        }

        // ---------- Officers ----------
        function openOfficerModal() {
            document.getElementById('officerModal').classList.add('active');
            document.getElementById('officerForm').reset();
            document.getElementById('officerId').value = '';
            document.getElementById('officerModalTitle').textContent = 'Add Officer';
            document.getElementById('officerSubmitBtn').textContent = 'Save';
        }
        function closeOfficerModal() { document.getElementById('officerModal').classList.remove('active'); }

        function editOfficer(id) {
            const officer = officersData.find(o => o.id === id);
            if (!officer) return;
            openOfficerModal();
            document.getElementById('officerModalTitle').textContent = 'Edit Officer';
            document.getElementById('officerSubmitBtn').textContent = 'Update';
            document.getElementById('officerId').value = officer.id;
            document.getElementById('officerName').value = officer.name;
            document.getElementById('officerTitle').value = officer.title || '';
            document.getElementById('officerMessenger').value = officer.messenger_url || '';
            document.getElementById('officerActive').checked = !!officer.is_active;
        }

        async function submitOfficer(e) {
            e.preventDefault();
            const id = document.getElementById('officerId').value;
            const isEdit = !!id;
            const payload = {
                name: document.getElementById('officerName').value,
                title: document.getElementById('officerTitle').value,
                messenger_url: document.getElementById('officerMessenger').value,
                is_active: document.getElementById('officerActive').checked,
            };
            const url = isEdit ? `/admin/services-management/officers/${id}` : '/admin/services-management/officers';
            const method = isEdit ? 'PATCH' : 'POST';
            try {
                const res = await fetch(url, {
                    method,
                    headers: { 'Content-Type': 'application/json', 'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content, 'Accept': 'application/json' },
                    body: JSON.stringify(payload)
                });
                const data = await res.json();
                if (data.success) { showToast(data.message, 'success'); closeOfficerModal(); setTimeout(() => location.reload(), 500); }
                else showToast('Save failed', 'error');
            } catch { showToast('Save failed', 'error'); }
        }

        async function deleteOfficer(id) {
            if (!confirm('Delete this officer?')) return;
            try {
                const res = await fetch(`/admin/services-management/officers/${id}`, {
                    method: 'DELETE',
                    headers: { 'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content, 'Accept': 'application/json' }
                });
                const data = await res.json();
                if (data.success) { showToast(data.message, 'success'); setTimeout(() => location.reload(), 400); }
                else showToast('Delete failed', 'error');
            } catch { showToast('Delete failed', 'error'); }
        }

        // Close modals on overlay click
        document.querySelectorAll('.modal-overlay').forEach(overlay => {
            overlay.addEventListener('click', (e) => { if (e.target === overlay) overlay.classList.remove('active'); });
        });
    </script>
</x-admin-layout>
