<x-admin-layout>
    @section('page-title', 'Inventory Management')

    <!-- Success Message -->
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
        ['label' => 'Inventory']
    ]" />

    <!-- Header Section -->
    <x-admin.page-header title="Products Inventory" subtitle="Manage your inventory and product information">
        <x-slot:actions>
            <x-admin.button href="{{ route('admin.inventory.create') }}" variant="primary" size="lg">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                </svg>
                Add Product
            </x-admin.button>
        </x-slot:actions>
    </x-admin.page-header>

    <!-- Statistics Dashboard -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
        <!-- Total Products -->
        <x-admin.stats-card 
            title="Total Products" 
            value="{{ $stats['total_products'] }}"
            subtitle="{{ $stats['active_products'] }} Active • {{ $stats['inactive_products'] }} Inactive"
            card-bg="linear-gradient(135deg, #3b82f6 0%, #2563eb 100%)"
            border-color="#60a5fa">
            <x-slot:icon>
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path>
                </svg>
            </x-slot:icon>
        </x-admin.stats-card>

        <!-- Low Stock Alerts -->
        <x-admin.stats-card 
            title="Low Stock Alerts" 
            value="{{ $stats['low_stock_count'] }}"
            subtitle="{{ $stats['low_stock_count'] > 0 ? 'Restock items below threshold' : 'All items well stocked' }}"
            card-bg="linear-gradient(135deg, #f59e0b 0%, #d97706 100%)"
            border-color="#fbbf24">
            <x-slot:icon>
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path>
                </svg>
            </x-slot:icon>
        </x-admin.stats-card>

        <!-- Total Inventory Value -->
        <x-admin.stats-card 
            title="Inventory Value" 
            value="₱{{ number_format($stats['total_inventory_value'], 2) }}"
            subtitle="Total stock value at base price"
            card-bg="linear-gradient(135deg, #10b981 0%, #059669 100%)"
            border-color="#34d399">
            <x-slot:icon>
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                </svg>
            </x-slot:icon>
        </x-admin.stats-card>

        <!-- Total Stock Units -->
        <x-admin.stats-card 
            title="Total Stock" 
            value="{{ number_format($stats['total_stock']) }}"
            subtitle="Across all products & variants"
            card-bg="linear-gradient(135deg, #6366f1 0%, #4f46e5 100%)"
            border-color="#818cf8">
            <x-slot:icon>
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"></path>
                </svg>
            </x-slot:icon>
        </x-admin.stats-card>
    </div>

    <!-- Search & Filter -->
    <div class="rounded-xl shadow-lg p-6 mb-6" 
         style="background: linear-gradient(135deg, rgba(15, 20, 25, 0.8) 0%, rgba(26, 31, 46, 0.8) 100%); 
                border: 1px solid rgba(255, 255, 255, 0.1);">
        <form method="GET" class="space-y-4">
            <!-- First Row: Search & Status -->
            <div class="flex gap-4 flex-wrap items-end">
                <div class="flex-1 min-w-64">
                    <label class="block text-sm font-semibold mb-2" style="color: rgba(255, 255, 255, 0.6);">Search Product</label>
                    <input 
                        type="text" 
                        name="search" 
                        value="{{ request('search', '') }}"
                        placeholder="Search by product name..." 
                        class="w-full px-4 py-2.5 rounded-xl text-white focus:outline-none transition-all"
                        style="border: 1px solid rgba(255, 255, 255, 0.1); background: rgba(15, 20, 25, 0.6);" 
                        onfocus="this.style.borderColor='#3b82f6'; this.style.background='rgba(15, 20, 25, 0.8)'" 
                        onblur="this.style.borderColor='rgba(255, 255, 255, 0.1)'; this.style.background='rgba(15, 20, 25, 0.6)'"
                    >
                </div>
                <div>
                    <label class="block text-sm font-semibold mb-2" style="color: rgba(255, 255, 255, 0.6);">Status</label>
                    <select name="status" class="px-4 py-2.5 rounded-xl text-white focus:outline-none transition-all" 
                            style="border: 1px solid rgba(255, 255, 255, 0.1); background: rgba(15, 20, 25, 0.6); min-width: 150px;" 
                            onfocus="this.style.borderColor='#3b82f6'; this.style.background='rgba(15, 20, 25, 0.8)'" 
                            onblur="this.style.borderColor='rgba(255, 255, 255, 0.1)'; this.style.background='rgba(15, 20, 25, 0.6)'">
                        <option value="all" {{ request('status', 'all') === 'all' ? 'selected' : '' }}>All Status</option>
                        <option value="active" {{ request('status') === 'active' ? 'selected' : '' }}>Active</option>
                        <option value="inactive" {{ request('status') === 'inactive' ? 'selected' : '' }}>Inactive</option>
                    </select>
                </div>
                <div>
                    <label class="block text-sm font-semibold mb-2" style="color: rgba(255, 255, 255, 0.6);">Stock Level</label>
                    <select name="stock_level" class="px-4 py-2.5 rounded-xl text-white focus:outline-none transition-all" 
                            style="border: 1px solid rgba(255, 255, 255, 0.1); background: rgba(15, 20, 25, 0.6); min-width: 150px;" 
                            onfocus="this.style.borderColor='#3b82f6'; this.style.background='rgba(15, 20, 25, 0.8)'" 
                            onblur="this.style.borderColor='rgba(255, 255, 255, 0.1)'; this.style.background='rgba(15, 20, 25, 0.6)'">
                        <option value="" {{ !request('stock_level') ? 'selected' : '' }}>All Levels</option>
                        <option value="low" {{ request('stock_level') === 'low' ? 'selected' : '' }}>Low Stock</option>
                        <option value="out" {{ request('stock_level') === 'out' ? 'selected' : '' }}>Out of Stock</option>
                        <option value="in_stock" {{ request('stock_level') === 'in_stock' ? 'selected' : '' }}>In Stock</option>
                    </select>
                </div>
            </div>

            <!-- Second Row: Price Range & Sort -->
            <div class="flex gap-4 flex-wrap items-end">
                <div>
                    <label class="block text-sm font-semibold mb-2" style="color: rgba(255, 255, 255, 0.6);">Min Price (₱)</label>
                    <input 
                        type="number" 
                        name="min_price" 
                        value="{{ request('min_price', '') }}"
                        placeholder="0.00" 
                        step="0.01"
                        class="px-4 py-2.5 rounded-xl text-white focus:outline-none transition-all"
                        style="border: 1px solid rgba(255, 255, 255, 0.1); background: rgba(15, 20, 25, 0.6); width: 140px;" 
                        onfocus="this.style.borderColor='#3b82f6'; this.style.background='rgba(15, 20, 25, 0.8)'" 
                        onblur="this.style.borderColor='rgba(255, 255, 255, 0.1)'; this.style.background='rgba(15, 20, 25, 0.6)'"
                    >
                </div>
                <div>
                    <label class="block text-sm font-semibold mb-2" style="color: rgba(255, 255, 255, 0.6);">Max Price (₱)</label>
                    <input 
                        type="number" 
                        name="max_price" 
                        value="{{ request('max_price', '') }}"
                        placeholder="9999.99" 
                        step="0.01"
                        class="px-4 py-2.5 rounded-xl text-white focus:outline-none transition-all"
                        style="border: 1px solid rgba(255, 255, 255, 0.1); background: rgba(15, 20, 25, 0.6); width: 140px;" 
                        onfocus="this.style.borderColor='#3b82f6'; this.style.background='rgba(15, 20, 25, 0.8)'" 
                        onblur="this.style.borderColor='rgba(255, 255, 255, 0.1)'; this.style.background='rgba(15, 20, 25, 0.6)'"
                    >
                </div>
                <div>
                    <label class="block text-sm font-semibold mb-2" style="color: rgba(255, 255, 255, 0.6);">Sort By</label>
                    <select name="sort_by" class="px-4 py-2.5 rounded-xl text-white focus:outline-none transition-all" 
                            style="border: 1px solid rgba(255, 255, 255, 0.1); background: rgba(15, 20, 25, 0.6); min-width: 150px;" 
                            onfocus="this.style.borderColor='#3b82f6'; this.style.background='rgba(15, 20, 25, 0.8)'" 
                            onblur="this.style.borderColor='rgba(255, 255, 255, 0.1)'; this.style.background='rgba(15, 20, 25, 0.6)'">
                        <option value="name" {{ request('sort_by', 'name') === 'name' ? 'selected' : '' }}>Name</option>
                        <option value="price" {{ request('sort_by') === 'price' ? 'selected' : '' }}>Price</option>
                        <option value="stock" {{ request('sort_by') === 'stock' ? 'selected' : '' }}>Stock</option>
                        <option value="created_at" {{ request('sort_by') === 'created_at' ? 'selected' : '' }}>Date Added</option>
                    </select>
                </div>
                <div>
                    <label class="block text-sm font-semibold mb-2" style="color: rgba(255, 255, 255, 0.6);">Order</label>
                    <select name="sort_order" class="px-4 py-2.5 rounded-xl text-white focus:outline-none transition-all" 
                            style="border: 1px solid rgba(255, 255, 255, 0.1); background: rgba(15, 20, 25, 0.6); min-width: 120px;" 
                            onfocus="this.style.borderColor='#3b82f6'; this.style.background='rgba(15, 20, 25, 0.8)'" 
                            onblur="this.style.borderColor='rgba(255, 255, 255, 0.1)'; this.style.background='rgba(15, 20, 25, 0.6)'">
                        <option value="asc" {{ request('sort_order', 'asc') === 'asc' ? 'selected' : '' }}>↑ Ascending</option>
                        <option value="desc" {{ request('sort_order') === 'desc' ? 'selected' : '' }}>↓ Descending</option>
                    </select>
                </div>
                
                <x-admin.button type="submit" variant="primary">
                    Search
                </x-admin.button>
                
                @if(request('search') || request('status') !== 'all' || request('stock_level') || request('min_price') || request('max_price') || (request('sort_by') && request('sort_by') !== 'name'))
                    <x-admin.button href="{{ route('admin.inventory.index') }}" variant="secondary">
                        Clear Filters
                    </x-admin.button>
                @endif
            </div>
        </form>
    </div>

    <!-- Products Table -->
    <div class="rounded-xl shadow-lg overflow-hidden" 
         style="background: linear-gradient(135deg, rgba(15, 20, 25, 0.8) 0%, rgba(26, 31, 46, 0.8) 100%); 
                border: 1px solid rgba(255, 255, 255, 0.1);">
        <div class="overflow-x-auto">
            <table class="w-full">
                <thead>
                    <tr style="background: linear-gradient(135deg, #3b82f6 0%, #2563eb 100%); border-bottom: 2px solid rgba(255, 255, 255, 0.1);">
                        <th class="px-6 py-4 text-left text-sm font-bold text-white" style="width: 50px;"></th>
                        <th class="px-6 py-4 text-left text-sm font-bold text-white">Product</th>
                        <th class="px-6 py-4 text-left text-sm font-bold text-white">Price</th>
                        <th class="px-6 py-4 text-left text-sm font-bold text-white">Variants</th>
                        <th class="px-6 py-4 text-left text-sm font-bold text-white">Total Stock</th>
                        <th class="px-6 py-4 text-left text-sm font-bold text-white">Status</th>
                        <th class="px-6 py-4 text-right text-sm font-bold text-white">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($products as $product)
                        <tr class="transition-all duration-200" 
                            style="border-bottom: 1px solid rgba(255, 255, 255, 0.05);" 
                            onmouseover="this.style.background='rgba(59, 130, 246, 0.1)'" 
                            onmouseout="this.style.background='transparent'">
                            <!-- Product Image Thumbnail -->
                            <td class="px-6 py-4">
                                <div style="width: 50px; height: 50px; border-radius: 10px; overflow: hidden; border: 1px solid rgba(255, 255, 255, 0.1); background: rgba(15, 20, 25, 0.6);">
                                    @if ($product->image_path)
                                        <img src="{{ $product->image_url }}" alt="{{ $product->name }}" style="width: 100%; height: 100%; object-fit: cover;" />
                                    @else
                                        <div style="width: 100%; height: 100%; display: flex; align-items: center; justify-content: center; font-size: 24px; color: rgba(255, 255, 255, 0.3);">📦</div>
                                    @endif
                                </div>
                            </td>
                            <td class="px-6 py-4">
                                <p class="font-semibold text-white">{{ $product->name }}</p>
                            </td>
                            <td class="px-6 py-4 font-bold text-white">₱{{ number_format($product->base_price, 2) }}</td>
                            <td class="px-6 py-4">
                                @if ($product->variants->count() > 0)
                                    <div style="display: flex; flex-wrap: wrap; gap: 6px; max-width: 350px;">
                                        @foreach ($product->variants as $variant)
                                            <div style="background: rgba(59, 130, 246, 0.1); border: 1px solid {{ $variant->stock_quantity <= 20 ? '#f59e0b' : '#3b82f6' }}; border-radius: 8px; padding: 6px 12px; display: inline-flex; align-items: center; gap: 6px; white-space: nowrap;">
                                                <span style="color: #3b82f6; font-weight: 600; font-size: 0.85rem;">{{ $variant->name }}</span>
                                                <span style="background: rgba(255, 255, 255, 0.1); color: white; padding: 2px 6px; border-radius: 4px; font-size: 0.75rem; font-weight: 600;">{{ $variant->stock_quantity }}</span>
                                                @if($variant->price_modifier > 0)
                                                    <span style="color: #10b981; font-size: 0.75rem; font-weight: 600;">+₱{{ number_format($variant->price_modifier, 2) }}</span>
                                                @endif
                                            </div>
                                        @endforeach
                                    </div>
                                @else
                                    <span style="color: rgba(255, 255, 255, 0.6); font-style: italic;">No variants</span>
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
                                    <span style="font-size: 1.2rem; margin-left: 4px;">⚠️</span>
                                @endif
                            </td>
                            <td class="px-6 py-4">
                                @php
                                    $statusStyles = $product->status === 'active' 
                                        ? 'background: linear-gradient(135deg, #10b981 0%, #059669 100%); color: white;'
                                        : 'background: linear-gradient(135deg, #6b7280 0%, #4b5563 100%); color: white;';
                                @endphp
                                <span class="px-3 py-1.5 rounded-lg text-xs font-bold inline-block" style="{{ $statusStyles }}">
                                    {{ $product->status === 'active' ? 'Active' : 'Inactive' }}
                                </span>
                            </td>
                            <td class="px-6 py-4 text-right">
                                <div class="flex justify-end gap-2">
                                    <x-admin.button 
                                        href="{{ route('admin.inventory.edit', $product) }}" 
                                        size="sm" 
                                        variant="primary">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                                        </svg>
                                        Edit
                                    </x-admin.button>

                                    <x-admin.button 
                                        type="button" 
                                        onclick="deleteProduct('{{ $product->slug }}')" 
                                        size="sm" 
                                        variant="danger">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                                        </svg>
                                        Delete
                                    </x-admin.button>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="px-6 py-12 text-center">
                                <svg class="w-16 h-16 mx-auto mb-4 opacity-30" style="color: rgba(255, 255, 255, 0.3);" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path>
                                </svg>
                                <p class="text-lg font-semibold mb-2" style="color: rgba(255, 255, 255, 0.6);">No products found</p>
                                <x-admin.button href="{{ route('admin.inventory.create') }}" variant="primary" size="sm">
                                    Create Product
                                </x-admin.button>
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
