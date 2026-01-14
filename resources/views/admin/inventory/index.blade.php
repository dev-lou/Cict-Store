<x-admin-layout>
    @section('page-title', 'Inventory Management')

    <!-- Flash Messages -->
    @if(session('success'))
        <div style="background: var(--success, #10b981); border: 1px solid rgba(16, 185, 129, 0.3); border-radius: 12px; padding: 16px 20px; margin-bottom: 20px; display: flex; align-items: center; gap: 12px;">
            <span style="color: #ffffff; font-weight: 600;">{{ session('success') }}</span>
        </div>
    @endif
    
    @if(session('warning'))
        <div style="background: var(--warning, #f59e0b); border: 1px solid rgba(245, 158, 11, 0.3); border-radius: 12px; padding: 16px 20px; margin-bottom: 20px; display: flex; align-items: center; gap: 12px;">
            <span style="color: #ffffff; font-weight: 600;">{{ session('warning') }}</span>
        </div>
    @endif
    
    @if(session('error'))
        <div style="background: var(--danger, #ef4444); border: 1px solid rgba(239, 68, 68, 0.3); border-radius: 12px; padding: 16px 20px; margin-bottom: 20px; display: flex; align-items: center; gap: 12px;">
            <span style="color: #ffffff; font-weight: 600;">{{ session('error') }}</span>
        </div>
    @endif

    <!-- Header Section -->
    <div class="mb-8 flex items-center justify-between">
        <div>
            <h2 class="text-3xl font-bold mb-2" style="color: #f1f5f9; letter-spacing: 0.5px;">Products Inventory</h2>
            <p class="text-sm" style="color: #94a3b8;">Manage your inventory and product information</p>
        </div>
        <div class="flex gap-3">
            <x-button href="{{ route('admin.inventory.create') }}" variant="primary" size="lg" style="background: #3b82f6; border: 1px solid #3b82f6; border-radius: 12px; padding: 12px 24px; font-weight: 600; transition: all 0.3s ease; display: flex; align-items: center; gap: 6px;" onmouseover="this.style.background='#2563eb';" onmouseout="this.style.background='#3b82f6';">
                <span style="font-size: 20px; font-weight: 700;">+</span>
                <span>Add Product</span>
            </x-button>
        </div>
    </div>

    <!-- Statistics Dashboard -->
    <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(240px, 1fr)); gap: 20px; margin-bottom: 32px;">
        <!-- Total Products -->
        <div style="background: #1e293b; border: 1px solid #334155; border-radius: 12px; padding: 24px; position: relative; overflow: hidden; transition: all 0.3s ease;" onmouseover="this.style.transform='translateY(-2px)';" onmouseout="this.style.transform='translateY(0)';">
            <p style="color: #94a3b8; font-size: 0.85rem; margin: 0 0 8px 0; font-weight: 600; text-transform: uppercase; letter-spacing: 0.5px;">Total Products</p>
            <div style="display: flex; align-items: baseline; gap: 8px;">
                <span style="color: #f1f5f9; font-weight: 700; font-size: 2.5rem;">{{ $stats['total_products'] }}</span>
                <span style="color: #94a3b8; font-size: 0.9rem; font-weight: 600;">items</span>
            </div>
            <div style="margin-top: 12px; padding-top: 12px; border-top: 1px solid rgba(255, 255, 255, 0.05);">
                <span style="color: #10b981; font-size: 0.85rem; font-weight: 600;">{{ $stats['active_products'] }} Active</span>
                <span style="color: #94a3b8; margin: 0 8px;">•</span>
                <span style="color: #ef4444; font-size: 0.85rem; font-weight: 600;">{{ $stats['inactive_products'] }} Inactive</span>
            </div>
        </div>

        <!-- Low Stock Alerts -->
        <div style="background: #1e293b; border: 1px solid #334155; border-radius: 12px; padding: 24px; position: relative; overflow: hidden; transition: all 0.3s ease;" onmouseover="this.style.transform='translateY(-2px)';" onmouseout="this.style.transform='translateY(0)';">
            <p style="color: #94a3b8; font-size: 0.85rem; margin: 0 0 8px 0; font-weight: 600; text-transform: uppercase; letter-spacing: 0.5px;">Low Stock Alerts</p>
            <div style="display: flex; align-items: baseline; gap: 8px;">
                <span style="color: #f59e0b; font-weight: 700; font-size: 2.5rem;">{{ $stats['low_stock_count'] }}</span>
                <span style="color: #94a3b8; font-size: 0.9rem; font-weight: 600;">warnings</span>
            </div>
            @if($stats['low_stock_count'] > 0)
                <p style="color: #94a3b8; font-size: 0.85rem; margin: 12px 0 0 0;">Restock items below threshold</p>
            @else
                <p style="color: #10b981; font-size: 0.85rem; margin: 12px 0 0 0;">All items well stocked</p>
            @endif
        </div>

        <!-- Total Inventory Value -->
        <div style="background: #1e293b; border: 1px solid #334155; border-radius: 12px; padding: 24px; position: relative; overflow: hidden; transition: all 0.3s ease;" onmouseover="this.style.transform='translateY(-2px)';" onmouseout="this.style.transform='translateY(0)';">
            <p style="color: #94a3b8; font-size: 0.85rem; margin: 0 0 8px 0; font-weight: 600; text-transform: uppercase; letter-spacing: 0.5px;">Inventory Value</p>
            <div style="display: flex; align-items: baseline; gap: 4px;">
                <span style="color: #10b981; font-weight: 700; font-size: 2rem;">₱{{ number_format($stats['total_inventory_value'], 2) }}</span>
            </div>
            <p style="color: #94a3b8; font-size: 0.85rem; margin: 12px 0 0 0;">Total stock value at base price</p>
        </div>

        <!-- Total Stock Units -->
        <div style="background: #1e293b; border: 1px solid #334155; border-radius: 12px; padding: 24px; position: relative; overflow: hidden; transition: all 0.3s ease;" onmouseover="this.style.transform='translateY(-2px)';" onmouseout="this.style.transform='translateY(0)';">
            <p style="color: #94a3b8; font-size: 0.85rem; margin: 0 0 8px 0; font-weight: 600; text-transform: uppercase; letter-spacing: 0.5px;">Total Stock</p>
            <div style="display: flex; align-items: baseline; gap: 8px;">
                <span style="color: #f1f5f9; font-weight: 700; font-size: 2.5rem;">{{ number_format($stats['total_stock']) }}</span>
                <span style="color: #94a3b8; font-size: 0.9rem; font-weight: 600;">units</span>
            </div>
            <p style="color: #94a3b8; font-size: 0.85rem; margin: 12px 0 0 0;">Across all products & variants</p>
        </div>
    </div>

    <!-- Search & Filter -->
    <div class="rounded-xl shadow-lg p-6 mb-6" style="background: #1e293b; border: 1px solid #334155; border-radius: 16px;">
        <form method="GET" class="space-y-4">
            <!-- First Row: Search & Status -->
            <div class="flex gap-4 flex-wrap items-end">
                <div class="flex-1 min-w-64">
                    <label class="block text-sm font-semibold mb-2" style="color: #94a3b8;">Search Product</label>
                    <input 
                        type="text" 
                        name="search" 
                        value="{{ request('search', '') }}"
                        placeholder="Search by product name..." 
                        class="w-full px-5 py-3 rounded-lg text-white focus:outline-none transition-all duration-300"
                        style="border: 2px solid #2a3f5f; background-color: #0f1419; border-radius: 10px; color: #ffffff;" 
                        onfocus="this.style.borderColor='#0f6fdd'; this.style.boxShadow='0 0 12px rgba(15, 111, 221, 0.3)';" 
                        onblur="this.style.borderColor='#2a3f5f'; this.style.boxShadow='';" 
                    >
                </div>
                <div>
                    <label class="block text-sm font-semibold mb-2" style="color: #94a3b8;">Status</label>
                    <select name="status" class="px-5 py-3 rounded-lg text-white focus:outline-none transition-all duration-300" style="border: 1px solid #334155; background-color: #0f172a; border-radius: 10px; color: #f1f5f9; min-width: 150px;" onfocus="this.style.borderColor='#3b82f6';" onblur="this.style.borderColor='#334155';">
                        <option value="all" style="background-color: #0f172a; color: #f1f5f9;" {{ request('status', 'all') === 'all' ? 'selected' : '' }}>All Status</option>
                        <option value="active" style="background-color: #0f172a; color: #f1f5f9;" {{ request('status') === 'active' ? 'selected' : '' }}>Active</option>
                        <option value="inactive" style="background-color: #0f172a; color: #f1f5f9;" {{ request('status') === 'inactive' ? 'selected' : '' }}>Inactive</option>
                    </select>
                </div>
                <div>
                    <label class="block text-sm font-semibold mb-2" style="color: #94a3b8;">Stock Level</label>
                    <select name="stock_level" class="px-5 py-3 rounded-lg text-white focus:outline-none transition-all duration-300" style="border: 1px solid #334155; background-color: #0f172a; border-radius: 10px; color: #f1f5f9; min-width: 150px;" onfocus="this.style.borderColor='#3b82f6';" onblur="this.style.borderColor='#334155';">
                        <option value="" style="background-color: #0f172a; color: #f1f5f9;" {{ !request('stock_level') ? 'selected' : '' }}>All Levels</option>
                        <option value="low" style="background-color: #0f172a; color: #f1f5f9;" {{ request('stock_level') === 'low' ? 'selected' : '' }}>Low Stock</option>
                        <option value="out" style="background-color: #0f172a; color: #f1f5f9;" {{ request('stock_level') === 'out' ? 'selected' : '' }}>Out of Stock</option>
                        <option value="in_stock" style="background-color: #0f172a; color: #f1f5f9;" {{ request('stock_level') === 'in_stock' ? 'selected' : '' }}>In Stock</option>
                    </select>
                </div>
            </div>

            <!-- Second Row: Price Range & Sort -->
            <div class="flex gap-4 flex-wrap items-end">
                <div>
                    <label class="block text-sm font-semibold mb-2" style="color: #b0bcc4;">Min Price (₱)</label>
                    <input 
                        type="number" 
                        name="min_price" 
                        value="{{ request('min_price', '') }}"
                        placeholder="0.00" 
                        step="0.01"
                        class="px-5 py-3 rounded-lg text-white focus:outline-none transition-all duration-300"
                        style="border: 2px solid #2a3f5f; background-color: #0f1419; border-radius: 10px; color: #ffffff; width: 140px;" 
                        onfocus="this.style.borderColor='#0f6fdd'; this.style.boxShadow='0 0 12px rgba(15, 111, 221, 0.3)';" 
                        onblur="this.style.borderColor='#2a3f5f'; this.style.boxShadow='';" 
                    >
                </div>
                <div>
                    <label class="block text-sm font-semibold mb-2" style="color: #b0bcc4;">Max Price (₱)</label>
                    <input 
                        type="number" 
                        name="max_price" 
                        value="{{ request('max_price', '') }}"
                        placeholder="9999.99" 
                        step="0.01"
                        class="px-5 py-3 rounded-lg text-white focus:outline-none transition-all duration-300"
                        style="border: 2px solid #2a3f5f; background-color: #0f1419; border-radius: 10px; color: #ffffff; width: 140px;" 
                        onfocus="this.style.borderColor='#0f6fdd'; this.style.boxShadow='0 0 12px rgba(15, 111, 221, 0.3)';" 
                        onblur="this.style.borderColor='#2a3f5f'; this.style.boxShadow='';" 
                    >
                </div>
                <div>
                    <label class="block text-sm font-semibold mb-2" style="color: #b0bcc4;">Sort By</label>
                    <select name="sort_by" class="px-5 py-3 rounded-lg text-white focus:outline-none transition-all duration-300" style="border: 2px solid #2a3f5f; background-color: #0f1419; border-radius: 10px; color: #ffffff; min-width: 150px;" onfocus="this.style.borderColor='#0f6fdd'; this.style.boxShadow='0 0 12px rgba(15, 111, 221, 0.3)';" onblur="this.style.borderColor='#2a3f5f'; this.style.boxShadow='';">
                        <option value="name" {{ request('sort_by', 'name') === 'name' ? 'selected' : '' }}>Name</option>
                        <option value="price" {{ request('sort_by') === 'price' ? 'selected' : '' }}>Price</option>
                        <option value="stock" {{ request('sort_by') === 'stock' ? 'selected' : '' }}>Stock</option>
                        <option value="created_at" {{ request('sort_by') === 'created_at' ? 'selected' : '' }}>Date Added</option>
                    </select>
                </div>
                <div>
                    <label class="block text-sm font-semibold mb-2" style="color: #b0bcc4;">Order</label>
                    <select name="sort_order" class="px-5 py-3 rounded-lg text-white focus:outline-none transition-all duration-300" style="border: 2px solid #2a3f5f; background-color: #0f1419; border-radius: 10px; color: #ffffff; min-width: 120px;" onfocus="this.style.borderColor='#0f6fdd'; this.style.boxShadow='0 0 12px rgba(15, 111, 221, 0.3)';" onblur="this.style.borderColor='#2a3f5f'; this.style.boxShadow='';">
                        <option value="asc" {{ request('sort_order', 'asc') === 'asc' ? 'selected' : '' }}>↑ Ascending</option>
                        <option value="desc" {{ request('sort_order') === 'desc' ? 'selected' : '' }}>↓ Descending</option>
                    </select>
                </div>
                <x-button type="submit" variant="primary" style="background: #3b82f6; border: 1px solid #3b82f6; border-radius: 10px; padding: 12px 24px; font-weight: 600; transition: all 0.3s ease;" onmouseover="this.style.background='#2563eb';" onmouseout="this.style.background='#3b82f6';">
                    Search
                </x-button>
                @if(request('search') || request('status') !== 'all' || request('stock_level') || request('min_price') || request('max_price') || (request('sort_by') && request('sort_by') !== 'name'))
                    <a href="{{ route('admin.inventory.index') }}" class="px-5 py-3 rounded-lg text-white font-semibold transition-all duration-300 flex items-center justify-center" style="background: #64748b; border: 1px solid #64748b; border-radius: 10px; text-align: center;" onmouseover="this.style.background='#475569';" onmouseout="this.style.background='#64748b';">
                        Clear Filters
                    </a>
                @endif
            </div>
        </form>
    </div>

    <!-- Products Table -->
    <div class="rounded-xl shadow-lg overflow-hidden" style="background-color: #1e293b; border: 1px solid #334155; border-radius: 16px;">
        <div class="overflow-x-auto">
            <table class="w-full">
                <thead>
                    <tr class="transition-colors" style="border-bottom: 1px solid #334155; background: #1e293b;">
                        <th class="px-6 py-4 text-left text-sm font-bold uppercase" style="color: #f1f5f9; letter-spacing: 0.5px; width: 50px;"></th>
                        <th class="px-6 py-4 text-left text-sm font-bold uppercase" style="color: #f1f5f9; letter-spacing: 0.5px;">Product</th>
                        <th class="px-6 py-4 text-left text-sm font-bold uppercase" style="color: #f1f5f9; letter-spacing: 0.5px;">Price</th>
                        <th class="px-6 py-4 text-left text-sm font-bold uppercase" style="color: #f1f5f9; letter-spacing: 0.5px;">Variants</th>
                        <th class="px-6 py-4 text-left text-sm font-bold uppercase" style="color: #f1f5f9; letter-spacing: 0.5px;">Total Stock</th>
                        <th class="px-6 py-4 text-left text-sm font-bold uppercase" style="color: #f1f5f9; letter-spacing: 0.5px;">Status</th>
                        <th class="px-6 py-4 text-right text-sm font-bold uppercase" style="color: #f1f5f9; letter-spacing: 0.5px;">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($products as $product)
                        <tr class="transition-all duration-300" style="border-bottom: 1px solid #334155;" onmouseover="this.style.backgroundColor='#334155';" onmouseout="this.style.backgroundColor='transparent';">
                            <!-- Product Image Thumbnail -->
                            <td class="px-6 py-4">
                                <div style="width: 50px; height: 50px; border-radius: 8px; overflow: hidden; border: 1px solid #334155; background: #0f172a;">
                                    @if ($product->image_path)
                                        <img src="{{ $product->image_url }}" alt="{{ $product->name }}" style="width: 100%; height: 100%; object-fit: cover;" />
                                    @else
                                        <div style="width: 100%; height: 100%; display: flex; align-items: center; justify-content: center; font-size: 24px; color: #64748b;">•</div>
                                    @endif
                                </div>
                            </td>
                            <td class="px-6 py-4">
                                <p class="font-semibold" style="color: #f1f5f9; font-size: 1.05rem;">{{ $product->name }}</p>
                            </td>
                            <td class="px-6 py-4 font-bold" style="color: #3b82f6; font-size: 1.1rem;">₱{{ number_format($product->base_price, 2) }}</td>
                            <td class="px-6 py-4">
                                @if ($product->variants->count() > 0)
                                    <div style="display: flex; flex-wrap: wrap; gap: 6px; max-width: 350px;">
                                        @foreach ($product->variants as $variant)
                                            <div style="background: #0f172a; border: 1px solid {{ $variant->stock_quantity <= 20 ? '#f59e0b' : '#3b82f6' }}; border-radius: 8px; padding: 6px 12px; display: inline-flex; align-items: center; gap: 6px; white-space: nowrap;">
                                                <span style="color: #3b82f6; font-weight: 600; font-size: 0.85rem;">{{ $variant->name }}</span>
                                                <span style="background: rgba(59, 130, 246, 0.1); color: #f1f5f9; padding: 2px 6px; border-radius: 4px; font-size: 0.75rem; font-weight: 600;">{{ $variant->stock_quantity }}</span>
                                                @if($variant->price_modifier > 0)
                                                    <span style="color: #10b981; font-size: 0.75rem; font-weight: 600;">+₱{{ number_format($variant->price_modifier, 2) }}</span>
                                                @endif
                                            </div>
                                        @endforeach
                                    </div>
                                @else
                                    <span style="color: #94a3b8; font-style: italic; font-size: 0.9rem;">No variants</span>
                                @endif
                            </td>
                            <td class="px-6 py-4">
                                @php
                                    // Get total stock from variants if they exist, otherwise fall back to current_stock
                                    $variantStock = (int) $product->variants->sum('stock_quantity');
                                    $totalStock = $variantStock > 0 ? $variantStock : (int) $product->current_stock;
                                    
                                    // Determine color based on stock level
                                    $isLowStock = $totalStock <= ($product->low_stock_threshold ?? 20);
                                    $stockColor = $isLowStock ? '#ef4444' : '#22c55e'; // red if low, green if good
                                @endphp
                                <span class="font-bold" style="color: {{ $stockColor }}; font-size: 1.2rem;">{{ number_format($totalStock) }}</span>
                                @if($isLowStock && $totalStock > 0)
                                    <span style="color: #fbbf24; font-size: 0.75rem; margin-left: 4px;">⚠️</span>
                                @endif
                            </td>
                            <td class="px-6 py-4">
                                <x-badge status="success" style="background: {{ $product->status === 'active' ? '#10b981' : '#ef4444' }}; color: #ffffff; padding: 8px 16px; border-radius: 8px; font-weight: 600; font-size: 0.9rem;">
                                    {{ $product->status === 'active' ? 'Active' : 'Inactive' }}
                                </x-badge>
                            </td>
                            <td class="px-6 py-4 text-right">
                                <div class="flex justify-end gap-3">
                                    <!-- Edit Button -->
                                    <a href="{{ route('admin.inventory.edit', $product) }}" class="inline-flex items-center gap-2 px-4 py-2 rounded-lg font-semibold transition-all duration-300" style="background: #3b82f6; color: white; border: 1px solid #3b82f6; border-radius: 10px;" onmouseover="this.style.background='#2563eb';" onmouseout="this.style.background='#3b82f6';">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                                        </svg>
                                        Edit
                                    </a>

                                    <!-- Delete Button -->
                                    <button type="button" onclick="deleteProduct('{{ $product->slug }}')" class="inline-flex items-center gap-2 px-4 py-2 rounded-lg font-semibold transition-all duration-300" style="background: #ef4444; color: white; border: 1px solid #ef4444; border-radius: 10px;" onmouseover="this.style.background='#dc2626';" onmouseout="this.style.background='#ef4444';">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                                        </svg>
                                        Delete
                                    </button>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="px-6 py-12 text-center">
                                <span style="color: #b0bcc4;">No products created yet.</span>
                                <a href="{{ route('admin.inventory.create') }}" style="color: #0f6fdd; font-weight: bold;" onmouseover="this.style.color='#1a7fff'" onmouseout="this.style.color='#0f6fdd'">Create one →</a>
                            </td>
                        </tr>
                    @endforelse
            </table>
        </div>
    </div>

    <!-- Pagination -->
    @if ($products->hasPages())
        <div class="mt-8">
            {{ $products->links() }}
        </div>
    @endif
</x-admin-layout>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.10.0/dist/sweetalert2.all.min.js"></script>
<script>
    function deleteProduct(productId) {
        Swal.fire({
            title: 'Delete Product?',
            text: 'This action cannot be undone. The product and all its variants will be permanently deleted.',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#ff6b6b',
            cancelButtonColor: '#2a3f5f',
            confirmButtonText: 'Yes, Delete',
            cancelButtonText: 'Cancel',
            background: '#0f1419',
            color: '#ffffff',
            iconColor: '#ff9500',
            didOpen: () => {
                document.querySelector('.swal2-title').style.color = '#ffffff';
                document.querySelector('.swal2-popup').style.border = '3px solid #daa520';
            }
        }).then((result) => {
            if (result.isConfirmed) {
                // Show loading state
                Swal.fire({
                    title: 'Deleting...',
                    text: 'Please wait while the product is being deleted.',
                    icon: 'info',
                    allowOutsideClick: false,
                    allowEscapeKey: false,
                    didOpen: () => {
                        Swal.showLoading();
                        document.querySelector('.swal2-title').style.color = '#ffd700';
                        document.querySelector('.swal2-popup').style.border = '3px solid #daa520';
                    },
                    background: '#1a0f0f',
                    color: '#ffd700',
                    iconColor: '#daa520'
                });
                
                // Get CSRF token
                const csrfToken = document.querySelector('meta[name="csrf-token"]')?.content;
                
                // Log the request for debugging
                // suppressed debug logging: delete request
                
                // Send DELETE request via AJAX
                fetch(`/admin/inventory/${productId}`, {
                    method: 'DELETE',
                    headers: {
                        'X-CSRF-TOKEN': csrfToken,
                        'Content-Type': 'application/json',
                        'Accept': 'application/json',
                        'X-Requested-With': 'XMLHttpRequest'
                    }
                })
                .then(response => {
                    // suppressed debug logging
                    if (!response.ok) {
                        throw new Error(`HTTP error! status: ${response.status}`);
                    }
                    return response.json();
                })
                .then(data => {
                    // suppressed debug logging
                    Swal.fire({
                        title: 'Delete Successful!',
                        text: data.message || 'The product has been deleted successfully.',
                        icon: 'success',
                        confirmButtonColor: '#4caf50',
                        background: '#0f1419',
                        color: '#ffffff',
                        iconColor: '#4caf50',
                        didOpen: () => {
                            document.querySelector('.swal2-title').style.color = '#4caf50';
                            document.querySelector('.swal2-popup').style.border = '3px solid #0f6fdd';
                        }
                    }).then(() => {
                        // Reload the page after alert closes
                        window.location.href = '{{ route("admin.inventory.index") }}';
                    });
                })
                .catch(error => {
                    console.error('Delete error:', error);
                    Swal.fire({
                        title: 'Delete Failed!',
                        text: error.message || 'An error occurred while deleting the product. Please try again.',
                        icon: 'error',
                        confirmButtonColor: '#ff6b6b',
                        background: '#0f1419',
                        color: '#ffffff',
                        iconColor: '#ff6b6b',
                        didOpen: () => {
                            document.querySelector('.swal2-title').style.color = '#ff6b6b';
                            document.querySelector('.swal2-popup').style.border = '3px solid #0f6fdd';
                        }
                    });
                });
            }
        });
    }
</script>
