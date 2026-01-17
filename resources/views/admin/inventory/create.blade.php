<x-admin-layout>
    @section('page-title', 'Create Product')

    <!-- Flash Messages -->
    @if(session('success'))
        <x-admin.alert type="success" :message="session('success')" :dismissible="true" />
    @endif

    @if(session('warning'))
        <x-admin.alert type="warning" :message="session('warning')" :dismissible="true" />
    @endif

    @if(session('error'))
        <x-admin.alert type="error" :message="session('error')" :dismissible="true" />
    @endif

    <!-- Breadcrumb -->
    <x-admin.breadcrumb :items="[
        ['label' => 'Catalog'],
        ['label' => 'Inventory', 'url' => route('admin.inventory.index')],
        ['label' => 'Add Product']
    ]" />

    <!-- Page Header -->
    <x-admin.page-header title="Create New Product" subtitle="Add a new product to your inventory">
        <x-slot:actions>
            <x-admin.button href="{{ route('admin.inventory.index') }}" variant="secondary">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                </svg>
                Back to Inventory
            </x-admin.button>
        </x-slot:actions>
    </x-admin.page-header>

    <style>
        body {
            font-size: 16px;
            line-height: 1.6;
        }

        .page-header {
            margin-bottom: 32px;
            position: relative;
        }

        .page-header::after {
            content: '';
            position: absolute;
            bottom: -10px;
            left: 0;
            width: 80px;
            height: 3px;
            background: #3b82f6;
            border-radius: 2px;
        }

        .form-group {
            margin-bottom: 24px;
        }

        .form-label {
            display: block;
            color: #cbd5e1;
            font-weight: 600;
            margin-bottom: 8px;
            font-size: 0.85rem;
            letter-spacing: 0.3px;
        }

        .form-input {
            width: 100%;
            padding: 12px 16px;
            background: rgba(15, 23, 42, 0.6);
            border: 1px solid rgba(59, 130, 246, 0.3);
            color: #e2e8f0;
            border-radius: 6px;
            font-weight: 500;
            font-size: 0.95rem;
            line-height: 1.6;
            transition: all 0.25s cubic-bezier(0.4, 0, 0.2, 1);
        }

        .form-input::placeholder {
            color: #64748b;
            font-weight: 400;
        }

        .form-input:hover {
            border-color: rgba(59, 130, 246, 0.5);
            background: rgba(15, 23, 42, 0.8);
        }

        .form-input:focus {
            outline: none;
            border-color: #3b82f6;
            background: rgba(15, 23, 42, 0.95);
            box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.15);
        }

        .section-header {
            color: #f1f5f9;
            font-weight: 600;
            font-size: 1.1rem;
            margin-bottom: 24px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            letter-spacing: 0.3px;
            padding-bottom: 12px;
            border-bottom: 1px solid rgba(59, 130, 246, 0.3);
            position: relative;
        }

        .section-header::after {
            content: '';
            position: absolute;
            bottom: -1px;
            left: 0;
            width: 60px;
            height: 2px;
            background: #3b82f6;
            height: 2px;
            background: #3b82f6;
        }

        .btn-primary {
            padding: 10px 20px;
            background: #3b82f6;
            color: #ffffff;
            border: none;
            border-radius: 6px;
            font-weight: 600;
            cursor: pointer;
            font-size: 0.9rem;
            transition: all 0.2s ease;
        }

        .btn-primary:hover {
            background: #2563eb;
        }

        .btn-primary:active {
            background: #1d4ed8;
        }

        .btn-cancel {
            background: rgba(30, 41, 59, 0.6);
            color: #94a3b8;
            border: 1px solid rgba(71, 85, 105, 0.4);
            padding: 10px 20px;
            border-radius: 6px;
            font-weight: 600;
            cursor: pointer;
            font-size: 0.9rem;
            transition: all 0.2s ease;
        }

        .btn-cancel:hover {
            background: rgba(51, 65, 85, 0.8);
            color: #e2e8f0;
            border-color: rgba(100, 116, 139, 0.6);
        }

        .btn-cancel:active {
            transform: scale(0.98);
        }

        .section-container {
            background: rgba(30, 41, 59, 0.4);
            backdrop-filter: blur(10px);
            border: 1px solid rgba(71, 85, 105, 0.3);
            border-radius: 8px;
            padding: 24px;
            margin-bottom: 24px;
            transition: all 0.3s ease;
        }

        .section-container:hover {
            border-color: rgba(59, 130, 246, 0.4);
            background: rgba(30, 41, 59, 0.5);
        }

        .input-group {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 16px;
        }

        textarea.form-input {
            font-family: inherit;
        }

        select.form-input {
            cursor: pointer;
            appearance: none;
            background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='12' height='12' viewBox='0 0 12 12'%3E%3Cpath fill='%233b82f6' d='M6 9L1 4h10z'/%3E%3C/svg%3E");
            background-repeat: no-repeat;
            background-position: right 12px center;
            padding-right: 40px;
        }

        select.form-input:hover {
            background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='12' height='12' viewBox='0 0 12 12'%3E%3Cpath fill='%2360a5fa' d='M6 9L1 4h10z'/%3E%3C/svg%3E");
        }

        .info-box {
            background: rgba(59, 130, 246, 0.08);
            border-left: 3px solid #3b82f6;
            border-radius: 4px;
            padding: 12px 16px;
            margin-top: 12px;
            font-size: 0.85rem;
            color: #94a3b8;
            display: flex;
            align-items: flex-start;
            gap: 10px;
        }

        .info-box::before {
            content: '💡';
            font-size: 1.1rem;
            flex-shrink: 0;
        }

        .variant-row {
            transition: background-color 0.25s cubic-bezier(0.4, 0, 0.2, 1);
        }

        .variant-row:hover {
            background-color: rgba(59, 130, 246, 0.08);
        }

        .variant-input {
            background: rgba(15, 23, 42, 0.6) !important;
            border: 1px solid rgba(59, 130, 246, 0.3) !important;
        }

        .variant-input:focus {
            background: rgba(15, 23, 42, 0.95) !important;
            border-color: #3b82f6 !important;
        }

        .modal-overlay {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: rgba(0, 0, 0, 0.7);
            z-index: 9999;
            justify-content: center;
            align-items: center;
            animation: fadeIn 0.3s ease;
            padding: 20px;
        }

        .modal-overlay.active {
            display: flex;
            /* make sure we center even in odd stacking contexts */
            align-items: center;
            justify-content: center;
            place-items: center;
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
            }

            to {
                opacity: 1;
            }
        }

        .modal-content {
            background: #1e293b;
            border: 1px solid #334155;
            border-radius: 12px;
            padding: 28px;
            max-width: 700px;
            width: 100%;
            /* make modal safe for all viewports and keep it centered when smaller
                    - use calc so padding / breathing space is respected */
            max-height: calc(100vh - 64px);
            margin: auto;
            overflow-y: auto;
            animation: slideUp 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.5);
        }

        @keyframes slideUp {
            from {
                transform: translateY(20px);
                opacity: 0;
            }

            to {
                transform: translateY(0);
                opacity: 1;
            }
        }

        .modal-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 28px;
            padding-bottom: 16px;
            border-bottom: 1px solid rgba(59, 130, 246, 0.3);
        }

        .modal-header h2 {
            color: #f1f5f9;
            font-weight: 600;
            margin: 0;
            font-size: 1.2rem;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .modal-close-btn {
            background: rgba(30, 41, 59, 0.8);
            color: #94a3b8;
            border: 1px solid rgba(71, 85, 105, 0.4);
            padding: 8px 14px;
            border-radius: 6px;
            font-weight: 600;
            cursor: pointer;
            font-size: 0.85rem;
            transition: all 0.2s ease;
            white-space: nowrap;
        }

        .modal-close-btn:hover {
            background: rgba(51, 65, 85, 0.9);
            color: #e2e8f0;
            border-color: rgba(100, 116, 139, 0.6);
        }

        .btn-danger {
            background: #ef4444;
            color: white;
            border: none;
            padding: 8px 14px;
            border-radius: 6px;
            cursor: pointer;
            font-weight: 600;
            font-size: 0.85rem;
            transition: all 0.2s ease;
        }

        .btn-danger:hover {
            background: #dc2626;
        }

        .btn-danger:active {
            background: #b91c1c;
        }

        /* Responsive Design */
        @media (max-width: 1024px) {
            .section-container {
                padding: 20px;
            }

            .input-group {
                grid-template-columns: 1fr;
            }

            .page-header {
                margin-bottom: 20px;
            }

            .section-header {
                flex-direction: column;
                align-items: flex-start;
                gap: 12px;
            }
        }

        @media (max-width: 768px) {
            .main-container {
                grid-template-columns: 1fr !important;
            }

            .section-container {
                padding: 16px;
                margin-bottom: 20px;
            }

            .section-header {
                font-size: 1.1rem;
                margin-bottom: 16px;
            }

            .form-label {
                font-size: 0.9rem;
            }

            .form-input {
                font-size: 0.95rem;
                padding: 10px 12px;
            }

            h1 {
                font-size: 2rem !important;
            }

            .btn-primary,
            .btn-cancel {
                padding: 10px 16px;
                font-size: 0.95rem;
            }
        }
    </style>

    <!-- Main Container -->
    <div style="display: grid; grid-template-columns: 1fr 360px; gap: 28px; margin-bottom: 40px;"
        class="main-container">
        <!-- Left Panel: Form -->
        <div style="min-width: 0;">
            <form id="productForm" action="{{ route('admin.inventory.store') }}" method="POST"
                enctype="multipart/form-data">
                @csrf

                <!-- Product Details Section -->
                <div class="section-container">
                    <div class="section-header">
                        <span>Product Information</span>
                    </div>

                    <div class="form-group">
                        <label class="form-label">Product Name *</label>
                        <input type="text" name="name" value="{{ old('name') }}" required class="form-input"
                            placeholder="Enter product name" />
                        @error('name')<span
                            style="color: #ff9500; font-size: 0.95rem; font-weight: 600; margin-top: 6px; display: block;">❌
                        {{ $message }}</span>@enderror
                    </div>

                    <div class="form-group">
                        <label class="form-label">Product Slug</label>
                        <input type="text" name="slug" value="{{ old('slug') }}" class="form-input"
                            placeholder="auto-generated from product name" style="background: #0f1419; opacity: 0.8;" />
                        <p style="color: #94a3b8; font-size: 0.85rem; margin-top: 10px;">Auto-generated from product
                            name. Edit manually if needed.</p>
                        @error('slug')<span
                            style="color: #ff9500; font-size: 0.95rem; font-weight: 600; margin-top: 6px; display: block;">❌
                        {{ $message }}</span>@enderror
                    </div>

                    <div class="form-group">
                        <label class="form-label">Description</label>
                        <textarea name="description" rows="5" class="form-input" style="resize: none; font-size: 1rem;"
                            placeholder="Add product description...">{{ old('description') }}</textarea>
                        @error('description')<span
                            style="color: #ff9500; font-size: 0.95rem; font-weight: 600; margin-top: 6px; display: block;">❌
                        {{ $message }}</span>@enderror
                    </div>

                    <div class="input-group">
                        <div class="form-group" style="margin-bottom: 0;">
                            <label class="form-label">Base Price (₱) *</label>
                            <input type="number" name="base_price" value="{{ old('base_price') }}" step="0.01" required
                                class="form-input" placeholder="0.00" />
                            @error('base_price')<span
                                style="color: #ff9500; font-size: 0.95rem; font-weight: 600; margin-top: 6px; display: block;">❌
                            {{ $message }}</span>@enderror
                        </div>

                        <div class="form-group" style="margin-bottom: 0;">
                            <label class="form-label">Status *</label>
                            <select name="status" class="form-input"
                                style="cursor: pointer; appearance: none; background-image: url('data:image/svg+xml;charset=UTF-8,%3csvg xmlns=%27http://www.w3.org/2000/svg%27 width=%2712%27 height=%278%27 viewBox=%270 0 12 8%27%3e%3cpath fill=%27%2394a3b8%27 d=%27M6 8L0 0h12z%27/%3e%3c/svg%3e'); background-repeat: no-repeat; background-position: right 16px center; background-size: 12px; padding-right: 40px;">
                                <option value="active" {{ old('status', 'active') === 'active' ? 'selected' : '' }}>🟢
                                    Active</option>
                                <option value="inactive" {{ old('status') === 'inactive' ? 'selected' : '' }}>🔴 Inactive
                                </option>
                            </select>
                            @error('status')<span
                                style="color: #ff9500; font-size: 0.95rem; font-weight: 600; margin-top: 6px; display: block;">❌
                            {{ $message }}</span>@enderror
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="form-label">Low Stock Threshold</label>
                        <input type="number" name="low_stock_threshold" value="{{ old('low_stock_threshold', 20) }}"
                            class="form-input" min="1" required>
                        <div class="info-box" style="margin-top: 8px;">
                            <span style="color: #cbd5e1;">Receive alerts when stock falls below this level</span>
                        </div>
                        @error('low_stock_threshold')<span
                            style="color: #ff9500; font-size: 0.95rem; font-weight: 600; margin-top: 6px; display: block;">❌
                        {{ $message }}</span>@enderror
                    </div>

                    <!-- Stock Management -->
                    <div style="margin-top: 28px; padding-top: 24px; border-top: 1px solid rgba(71, 85, 105, 0.3);">
                        <div style="display: flex; align-items: center; gap: 10px; margin-bottom: 20px;">
                            <span style="font-size: 1.3rem;">📊</span>
                            <h4
                                style="color: #cbd5e1; font-weight: 600; font-size: 0.95rem; margin: 0; letter-spacing: 0.3px;">
                                Stock Management</h4>
                        </div>

                        <div class="form-group" style="margin-bottom: 12px;">
                            <label class="form-label">Default Stock *</label>
                            <input type="number" name="current_stock" value="{{ old('current_stock', 0) }}" min="0"
                                required class="form-input" placeholder="0" />
                            @error('current_stock')<span
                                style="color: #fca5a5; font-size: 0.85rem; font-weight: 600; margin-top: 6px; display: block;">❌
                            {{ $message }}</span>@enderror
                        </div>

                        <div class="info-box" style="margin-top: 12px;">
                            <span style="color: #cbd5e1; font-size: 0.85rem;"><strong
                                    style="color: #e2e8f0;">Tip:</strong> Add variants above to track stock by size,
                                color, or style. Each variant has its own stock level.</span>
                        </div>
                    </div>
                </div>

                <!-- Manage Variants Section - NEW CLEAN DESIGN -->
                <div class="section-container">
                    <div class="section-header">
                        <span style="display: flex; align-items: center; gap: 10px;">
                            <span style="font-size: 1.3rem;">📦</span>
                            <span>Product Variants</span>
                        </span>
                        <span style="color: #94a3b8; font-size: 0.85rem; font-weight: 500;">Optional • Add as many as you need</span>
                    </div>

                    <!-- Info Card -->
                    <div style="background: linear-gradient(135deg, rgba(59, 130, 246, 0.1) 0%, rgba(37, 99, 235, 0.05) 100%); border: 1px solid rgba(59, 130, 246, 0.3); border-radius: 10px; padding: 20px; margin-bottom: 24px;">
                        <div style="display: flex; align-items: start; gap: 12px;">
                            <span style="font-size: 1.8rem; line-height: 1;">💡</span>
                            <div>
                                <h4 style="color: #e2e8f0; font-weight: 600; margin: 0 0 8px 0; font-size: 0.95rem;">About Product Variants</h4>
                                <p style="color: #94a3b8; font-size: 0.85rem; line-height: 1.6; margin: 0 0 8px 0;">
                                    Variants let customers choose between different options (sizes, colors, styles). Each variant has its own stock and optional price adjustment.
                                </p>
                                <p style="color: #a78bfa; font-size: 0.85rem; line-height: 1.6; margin: 0; font-weight: 600;">
                                    💡 Tip: Add variants if customers need to choose options, or leave empty for a simple product with base price.
                                </p>
                            </div>
                        </div>
                    </div>

                    <!-- Variants List -->
                    <div id="variantsListContainer" style="display: none; margin-bottom: 24px;">
                        <div id="variantsList" style="display: grid; gap: 16px; margin-bottom: 20px;">
                            <!-- Variants will be added here dynamically -->
                        </div>
                        
                        <!-- Summary Stats -->
                        <div id="variantsSummary" style="background: rgba(30, 41, 59, 0.4); border: 1px solid rgba(71, 85, 105, 0.3); border-radius: 8px; padding: 16px; display: grid; grid-template-columns: repeat(3, 1fr); gap: 16px;">
                            <div style="text-align: center;">
                                <p style="color: #94a3b8; font-size: 0.75rem; margin: 0 0 4px 0; text-transform: uppercase; letter-spacing: 0.5px;">Total Variants</p>
                                <p id="variantsCount" style="color: #3b82f6; font-weight: 700; font-size: 1.5rem; margin: 0;">0</p>
                            </div>
                            <div style="text-align: center;">
                                <p style="color: #94a3b8; font-size: 0.75rem; margin: 0 0 4px 0; text-transform: uppercase; letter-spacing: 0.5px;">Total Stock</p>
                                <p id="totalVariantStock" style="color: #22c55e; font-weight: 700; font-size: 1.5rem; margin: 0;">0</p>
                            </div>
                            <div style="text-align: center;">
                                <p style="color: #94a3b8; font-size: 0.75rem; margin: 0 0 4px 0; text-transform: uppercase; letter-spacing: 0.5px;">Avg Price Change</p>
                                <p id="avgPriceChange" style="color: #f59e0b; font-weight: 700; font-size: 1.5rem; margin: 0;">₱0.00</p>
                            </div>
                        </div>
                    </div>

                    <!-- Empty State -->
                    <div id="emptyVariantsState" style="background: rgba(30, 41, 59, 0.3); border: 2px dashed rgba(71, 85, 105, 0.5); border-radius: 10px; padding: 40px; text-align: center;">
                        <div style="font-size: 3rem; margin-bottom: 12px; opacity: 0.6;">📦</div>
                        <p style="color: #cbd5e1; font-weight: 600; margin: 0 0 8px 0; font-size: 1rem;">No Variants Added</p>
                        <p style="color: #94a3b8; font-size: 0.85rem; margin: 0 0 20px 0; line-height: 1.6; max-width: 400px; margin-left: auto; margin-right: auto;">
                            This will be a simple product with one price and stock level. Click below to add variants if needed.
                        </p>
                    </div>

                    <!-- Add Variant Button -->
                    <button type="button" id="addVariantBtn" class="btn-primary" style="width: 100%; padding: 14px; font-size: 0.95rem; margin-top: 20px; display: flex; align-items: center; justify-content: center; gap: 8px;">
                        <span style="font-size: 1.2rem;">+</span>
                        <span>Add Variant</span>
                    </button>
                </div>

                <!-- Action Buttons -->
                <div
                    style="display: flex; gap: 12px; margin-top: 32px; padding-top: 20px; border-top: 1px solid rgba(71, 85, 105, 0.3); flex-wrap: wrap;">
                    <button type="button" id="saveBtn"
                        style="flex: 1; min-width: 140px; padding: 12px 20px; background: #3b82f6; color: white; border: none; border-radius: 6px; font-weight: 600; cursor: pointer; font-size: 1rem; transition: all 0.2s ease; letter-spacing: 0.3px; display: flex; align-items: center; justify-content: center; gap: 8px;"
                        onmouseover="this.style.background='#2563eb';" onmouseout="this.style.background='#3b82f6';">
                        <span>Create Product</span>
                    </button>
                    <a href="{{ route('admin.inventory.index') }}" class="btn-cancel"
                        style="flex: 1; min-width: 140px; padding: 12px 20px; font-size: 1rem; font-weight: 600; letter-spacing: 0.3px; text-align: center; text-decoration: none; display: flex; align-items: center; justify-content: center; gap: 8px;">
                        <span>Cancel</span>
                    </a>
                </div>

                <input type="file" id="imageInput" name="image" accept="image/*" style="display: none;" />
            </form>
        </div>

        <!-- Right Panel: Image -->
        <div style="background: rgba(30, 41, 59, 0.4); backdrop-filter: blur(10px); border: 1px solid rgba(71, 85, 105, 0.3); border-radius: 8px; padding: 20px; height: fit-content; position: sticky; top: 20px; z-index: 1; transition: all 0.3s ease;"
            onmouseover="this.style.borderColor='rgba(59, 130, 246, 0.4)'; this.style.background='rgba(30, 41, 59, 0.5)';"
            onmouseout="this.style.borderColor='rgba(71, 85, 105, 0.3)'; this.style.background='rgba(30, 41, 59, 0.4)';">
            <h3
                style="color: #cbd5e1; font-weight: 600; margin: 0 0 16px 0; font-size: 0.95rem; letter-spacing: 0.3px; display: flex; align-items: center; gap: 8px;">
                <span>Product Image</span>
            </h3>

            <label for="imageInput" id="imagePreview"
                style="width: 100%; aspect-ratio: 1; background: rgba(15, 23, 42, 0.6); border: 2px dashed rgba(100, 116, 139, 0.5); border-radius: 6px; display: flex; align-items: center; justify-content: center; cursor: pointer; margin-bottom: 16px; overflow: hidden; transition: all 0.25s ease;"
                onmouseover="this.style.borderColor='#3b82f6'; this.style.backgroundColor='rgba(59, 130, 246, 0.05)'; this.style.transform='scale(1.01)';"
                onmouseout="this.style.borderColor='rgba(100, 116, 139, 0.5)'; this.style.backgroundColor='rgba(15, 23, 42, 0.6)'; this.style.transform='scale(1)';">
                <div style="text-align: center;">
                    <p style="color: #cbd5e1; font-weight: 600; margin: 0; font-size: 1rem;">Click to Upload</p>
                    <p style="color: #64748b; font-size: 0.85rem; margin: 6px 0 0 0;">or drag & drop</p>
                </div>
            </label>

            <div id="imageStatus"
                style="display:none; color: #94a3b8; font-size: 0.85rem; margin-bottom: 8px; text-align:center"></div>
            <!-- Visible debug log to capture picker events (helpful if devtools aren't open) -->
            <div id="imageDebug"
                style="display:none; color:#94a3b8; font-size:0.8rem; margin-top:6px; padding:8px; background: rgba(2,6,23,0.3); border-radius:6px; max-height:120px; overflow:auto; white-space:pre-wrap; font-family: monospace;">
                Debug log (events will appear here)</div>

            <div
                style="background: rgba(59, 130, 246, 0.08); border: 1px solid rgba(59, 130, 246, 0.2); border-radius: 6px; padding: 12px; text-align: center; margin-bottom: 16px;">
                <p style="color: #cbd5e1; font-weight: 600; margin: 0 0 4px 0; font-size: 0.85rem;">
                    <span>Image Guidelines</span>
                </p>
                <p style="color: #94a3b8; font-size: 0.8rem; margin: 0; line-height: 1.5;">JPG, PNG, GIF, WebP • Max 5MB
                </p>
            </div>

            <button type="button" id="removeImageBtn" class="btn-danger"
                style="width: 100%; padding: 12px; font-size: 1rem; font-weight: 700; display: none;">
                🗑️ Remove Image
            </button>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        let variantIndex = 0;

        // Auto-generate slug from product name
        document.querySelector('input[name="name"]').addEventListener('input', function () {
            const slug = this.value
                .toLowerCase()
                .trim()
                .replace(/[^\w\s-]/g, '')
                .replace(/\s+/g, '-')
                .replace(/-+/g, '-');
            document.querySelector('input[name="slug"]').value = slug;
        });

        // Variant Management - NEW CLEAN SYSTEM
        window.createVariantCard = function(index, data = {}) {
            const card = document.createElement('div');
            card.className = 'variant-card';
            card.dataset.variantIndex = index;
            card.style.cssText = 'background: linear-gradient(135deg, rgba(30, 41, 59, 0.6) 0%, rgba(15, 23, 42, 0.8) 100%); border: 1px solid rgba(59, 130, 246, 0.3); border-radius: 10px; padding: 20px; position: relative; transition: all 0.3s ease;';
            
            card.innerHTML = `
                <div style="position: absolute; top: 12px; right: 12px; display: flex; gap: 8px;">
                    <button type="button" class="remove-variant-btn" onclick="window.removeVariant(${index})" style="background: rgba(239, 68, 68, 0.2); border: 1px solid rgba(239, 68, 68, 0.4); color: #fca5a5; padding: 6px 12px; border-radius: 6px; cursor: pointer; font-size: 0.8rem; font-weight: 600; transition: all 0.2s;" onmouseover="this.style.background='rgba(239, 68, 68, 0.3)'; this.style.borderColor='rgba(239, 68, 68, 0.6)';" onmouseout="this.style.background='rgba(239, 68, 68, 0.2)'; this.style.borderColor='rgba(239, 68, 68, 0.4)';">
                        🗑️ Remove
                    </button>
                </div>

                <div style="margin-bottom: 16px;">
                    <label style="display: block; color: #e2e8f0; font-weight: 600; margin-bottom: 8px; font-size: 0.9rem;">Variant Name *</label>
                    <input type="text" name="variants[${index}][name]" value="${data.name || ''}" class="form-input" placeholder="e.g., Red - Large, Blue - Medium" required style="font-size: 0.95rem;" oninput="window.updateVariantSummary()" />
                    <p style="color: #94a3b8; font-size: 0.75rem; margin: 4px 0 0 0;">This is what customers will see</p>
                </div>

                <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 16px;">
                    <div>
                        <label style="display: block; color: #e2e8f0; font-weight: 600; margin-bottom: 8px; font-size: 0.9rem;">Stock Quantity *</label>
                        <input type="number" name="variants[${index}][stock_quantity]" value="${data.stock_quantity || ''}" class="form-input variant-stock" min="0" placeholder="0" required style="font-size: 0.95rem;" oninput="window.updateVariantSummary()" />
                    </div>
                    <div>
                        <label style="display: block; color: #e2e8f0; font-weight: 600; margin-bottom: 8px; font-size: 0.9rem;">Price Change (₱)</label>
                        <input type="number" name="variants[${index}][price_modifier]" value="${data.price_modifier || ''}" class="form-input variant-price" step="0.01" placeholder="0.00" style="font-size: 0.95rem;" oninput="window.updateVariantSummary()" />
                        <p style="color: #94a3b8; font-size: 0.75rem; margin: 4px 0 0 0;">+/- from base price</p>
                    </div>
                </div>
            `;
            
            return card;
        }

        window.addVariant = function() {
            const container = document.getElementById('variantsList');
            const card = window.createVariantCard(variantIndex++);
            container.appendChild(card);
            window.updateVariantDisplay();
            window.updateVariantSummary();
            
            // Scroll to new variant
            setTimeout(() => {
                card.scrollIntoView({ behavior: 'smooth', block: 'nearest' });
            }, 100);
        }

        window.removeVariant = function(index) {
            const card = document.querySelector(`[data-variant-index="${index}"]`);
            if (card) {
                card.style.opacity = '0';
                card.style.transform = 'translateX(-20px)';
                setTimeout(() => {
                    card.remove();
                    window.reindexVariants();
                    window.updateVariantDisplay();
                    window.updateVariantSummary();
                }, 300);
            }
        }

        window.reindexVariants = function() {
            const cards = document.querySelectorAll('.variant-card');
            cards.forEach((card, newIndex) => {
                card.dataset.variantIndex = newIndex;
                card.querySelectorAll('input').forEach(input => {
                    const name = input.getAttribute('name');
                    if (name) {
                        input.setAttribute('name', name.replace(/\[\d+\]/, `[${newIndex}]`));
                    }
                });
                card.querySelector('.remove-variant-btn').setAttribute('onclick', `window.removeVariant(${newIndex})`);
            });
            variantIndex = cards.length;
        }

        window.updateVariantDisplay = function() {
            const count = document.querySelectorAll('.variant-card').length;
            const emptyState = document.getElementById('emptyVariantsState');
            const listContainer = document.getElementById('variantsListContainer');
            
            if (count === 0) {
                emptyState.style.display = 'block';
                listContainer.style.display = 'none';
            } else {
                emptyState.style.display = 'none';
                listContainer.style.display = 'block';
            }
        }

        window.updateVariantSummary = function() {
            const cards = document.querySelectorAll('.variant-card');
            let totalStock = 0;
            let totalPriceChange = 0;
            let count = cards.length;
            
            cards.forEach(card => {
                const stockInput = card.querySelector('.variant-stock');
                const priceInput = card.querySelector('.variant-price');
                totalStock += parseInt(stockInput.value) || 0;
                totalPriceChange += parseFloat(priceInput.value) || 0;
            });
            
            document.getElementById('variantsCount').textContent = count;
            document.getElementById('totalVariantStock').textContent = totalStock;
            document.getElementById('avgPriceChange').textContent = count > 0 ? `₱${(totalPriceChange / count).toFixed(2)}` : '₱0.00';
        }

        // Add variant button
        document.getElementById('addVariantBtn').addEventListener('click', window.addVariant);

        // Image upload (robust)
        const imageInput = document.getElementById('imageInput');
        const imagePreview = document.getElementById('imagePreview');
        let removeImageBtn = document.getElementById('removeImageBtn');

        // Helper to create the remove button when necessary (safe to call)
        function ensureRemoveBtnCreate() {
            const imagePanel = imagePreview.parentElement;

            // If not present, create it
            if (!removeImageBtn) {
                removeImageBtn = document.createElement('button');
                removeImageBtn.id = 'removeImageBtn';
                removeImageBtn.type = 'button';
                removeImageBtn.className = 'btn-danger';
                removeImageBtn.style.cssText = 'width: 100%; padding: 14px; font-size: 1.1rem; font-weight: 700; margin-top: 28px; display: none;';
                removeImageBtn.innerHTML = '🗑️ Remove Image';
                imagePanel.appendChild(removeImageBtn);
            }

            // Attach click handler once (idempotent)
            if (!removeImageBtn.dataset.listenerAttached) {
                removeImageBtn.addEventListener('click', function (e) {
                    e.preventDefault();
                    e.stopPropagation();
                    // Clear file input and preview
                    try { imageInput.value = ''; } catch (err) { /* suppressed in production */ }
                    const statusEl = document.getElementById('imageStatus');
                    if (statusEl) { statusEl.style.display = 'none'; }
                    imagePreview.innerHTML = `<div style="text-align: center;">
                        <div style="font-size: 64px; margin-bottom: 12px; animation: pulse 2s infinite;">📸</div>
                        <p style="color: #ffffff; font-weight: 700; margin: 0; font-size: 1.1rem;">Click to Upload</p>
                        <p style="color: #b0bcc4; font-size: 0.95rem; margin: 8px 0 0 0;">or drag & drop</p>
                    </div>`;

                    // hide the button until an image is selected again
                    this.style.display = 'none';

                    // If the page has a hidden input to signal backend to delete an existing image, set it
                    const removeExisting = document.querySelector('input[name="remove_existing_image"]');
                    if (removeExisting) removeExisting.value = '1';

                    // Log for debugging
                    appendImageDebug('remove clicked - cleared input/preview');
                });
                removeImageBtn.dataset.listenerAttached = '1';
            }

            return removeImageBtn;
        }

        // Debug logging helper + robust change handling
        function appendImageDebug(msg) {
            try {
                if (!window.APP_DEBUG) return;
                const el = document.getElementById('imageDebug');
                if (!el) return;
                const time = new Date().toLocaleTimeString();
                el.textContent = `[${time}] ${msg}\n` + el.textContent;
            } catch (err) {
                // suppressed in production
            }
        }
        let pickerRequested = false;
        let imagePickerInProgress = false;
        imageInput.addEventListener('change', function (e) {
            // suppressed debug logging
            appendImageDebug('change: files=' + (this.files && this.files.length ? Array.from(this.files).map(f => f.name).join(',') : 'none'));
            const file = this.files && this.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = (event) => {
                    // suppressed debug logging
                    appendImageDebug('reader.onload: ' + (file && file.name));
                    imagePreview.innerHTML = `<img src="${event.target.result}" style="width: 100%; height: 100%; object-fit: cover;" />`;
                    const btn = ensureRemoveBtnCreate();
                    if (btn) btn.style.display = 'block';
                    // show a short UI status so users without console see that a file was selected
                    const statusEl = document.getElementById('imageStatus');
                    if (statusEl) {
                        statusEl.textContent = 'Selected: ' + (file.name || 'image');
                        statusEl.style.display = 'block';
                        setTimeout(() => { statusEl.style.display = 'none'; }, 2000);
                    }
                    // clear picker state so preview click can open again
                    pickerRequested = false;
                    imageInput.dataset.opening = '';
                    imagePickerInProgress = false;
                };
                reader.readAsDataURL(file);
            } else {
                // suppressed debug logging
                appendImageDebug('no file selected');
            }
        });

        // If there's already a remove button rendered in DOM for some reason, attach safe handler
        const existingRemoveBtn = document.getElementById('removeImageBtn');
        if (existingRemoveBtn && !existingRemoveBtn.dataset.listenerAttached) {
            existingRemoveBtn.addEventListener('click', function (e) {
                e.preventDefault();
                e.stopPropagation();
                try { imageInput.value = ''; } catch (err) { /* suppressed in production */ }
                const statusEl = document.getElementById('imageStatus');
                if (statusEl) { statusEl.style.display = 'none'; }
                imagePreview.innerHTML = `<div style="text-align: center;">
                    <div style="font-size: 64px; margin-bottom: 12px; animation: pulse 2s infinite;">📸</div>
                    <p style="color: #ffffff; font-weight: 700; margin: 0; font-size: 1.1rem;">Click to Upload</p>
                    <p style="color: #b0bcc4; font-size: 0.95rem; margin: 8px 0 0 0;">or drag & drop</p>
                </div>`;
                this.style.display = 'none';
                this.dataset.listenerAttached = '1';
                appendImageDebug('existing remove clicked - cleared input/preview');
            });
        }

        // Make click/open handling robust for browsers (avoid double re-open)
        // Clear the input on pointerdown so selecting the same file still fires change
        imagePreview.addEventListener('pointerdown', function (e) {
            if (e.target.tagName !== 'IMG' && !e.target.closest('#removeImageBtn')) {
                imageInput.value = '';
            }
        });

        // Use native label behavior to open the file picker (avoid double-open). pointerdown clears selection.

        // Log file presence just before form submit to help debugging
        document.getElementById('saveBtn').addEventListener('click', function (ev) {
            // suppressed debug logging
            appendImageDebug('before submit files=' + (imageInput.files && imageInput.files.length));
        });

        // When the window regains focus after the file picker, clear opening state
        window.addEventListener('focus', function () {
            if (imageInput && imageInput.dataset && imageInput.dataset.opening) {
                // suppressed debug logging
                appendImageDebug('focus detected - clearing opening flag');
                imageInput.dataset.opening = '';
            }
            // clear progress flag on focus to avoid stuck state
            imagePickerInProgress = false;
            // Show debug area only in debug mode
            try {
                if (window.APP_DEBUG) {
                    const debugEl = document.getElementById('imageDebug');
                    if (debugEl) debugEl.style.display = 'block';
                }
            } catch (e) { /* silent */ }
        });

        // Check for success/error on page load
        window.addEventListener('load', function () {
            @if (session('success'))
                Swal.fire({
                    title: 'Success!',
                    text: '{{ session("success") }}',
                    icon: 'success',
                    iconColor: '#22c55e',
                    background: 'rgba(15, 23, 42, 0.98)',
                    color: '#e2e8f0',
                    confirmButtonColor: '#3b82f6',
                    backdrop: 'rgba(0, 0, 0, 0.7)',
                    didOpen: (modal) => {
                        setTimeout(() => {
                            window.location.href = '{{ route("admin.inventory.index") }}';
                        }, 2500);
                    }
                });
            @elseif ($errors->any())
                Swal.fire({
                    title: 'Creation Failed',
                    html: '<ul style="text-align: left; display: inline-block; margin: 0; padding-left: 20px;">@foreach ($errors->all() as $error)<li style="margin: 6px 0; color: #fca5a5;">❌ {{ $error }}</li>@endforeach</ul>',
                    icon: 'error',
                    iconColor: '#ef4444',
                    background: 'rgba(15, 23, 42, 0.98)',
                    color: '#e2e8f0',
                    confirmButtonColor: '#3b82f6',
                    backdrop: 'rgba(0, 0, 0, 0.7)'
                });
            @endif
        });

        // Save button with variant validation
        document.getElementById('saveBtn').addEventListener('click', function (e) {
            e.preventDefault();

            // Check variants count
            const variantCount = document.querySelectorAll('.variant-card').length;

            // No validation - allow any number of variants

            // Build confirmation message
            let confirmMessage;
            if (variantCount === 0) {
                const defaultStock = document.querySelector('input[name="current_stock"]')?.value || 0;
                confirmMessage = 'This will be a simple product with no variant options. Stock will be ' + defaultStock + ' units.';
            } else {
                confirmMessage = 'Are you sure you want to create this product with ' + variantCount + ' variant' + (variantCount > 1 ? 's' : '') + '?';
            }

            Swal.fire({
                title: 'Create Product?',
                text: confirmMessage,
                icon: 'question',
                iconColor: '#3b82f6',
                background: 'rgba(15, 23, 42, 0.98)',
                color: '#e2e8f0',
                showCancelButton: true,
                confirmButtonColor: '#3b82f6',
                cancelButtonColor: '#64748b',
                confirmButtonText: 'Yes, Create',
                backdrop: 'rgba(0, 0, 0, 0.7)'
            }).then(result => {
                if (result.isConfirmed) {
                    // Show loading alert
                    Swal.fire({
                        title: 'Creating Product...',
                        html: 'Please wait while we create your product.',
                        icon: 'info',
                        iconColor: '#3b82f6',
                        background: 'rgba(15, 23, 42, 0.98)',
                        color: '#e2e8f0',
                        allowOutsideClick: false,
                        allowEscapeKey: false,
                        backdrop: 'rgba(0, 0, 0, 0.7)',
                        didOpen: (modal) => {
                            Swal.showLoading();
                        }
                    });

                    // Submit form
                    document.getElementById('productForm').submit();
                }
            });
        });
    </script>
</x-admin-layout>