<x-admin-layout>
    @section('page-title', 'All Orders')

    <!-- Breadcrumb -->
    <x-admin.breadcrumb :items="[
        ['label' => 'Orders', 'url' => route('admin.orders.index')],
        ['label' => 'All Orders']
    ]" />

    <!-- Page Header -->
    <x-admin.page-header title="All Orders" subtitle="View and manage all customer orders">
        <x-slot:actions>
            <span class="inline-flex items-center px-4 py-2 rounded-xl font-bold text-white" style="background: linear-gradient(135deg, #3b82f6 0%, #2563eb 100%);">
                {{ $orders->total() }} Total
            </span>
        </x-slot:actions>
    </x-admin.page-header>

    <!-- Filter Bar -->
    <x-admin.filter-bar action="{{ route('admin.orders.index') }}">
        <!-- Search Bar -->
        <div class="flex-1 min-w-64">
            <label class="block text-sm font-semibold mb-2" style="color: rgba(255, 255, 255, 0.6);">Search Order or Customer</label>
            <input 
                type="text" 
                name="search" 
                value="{{ request('search', '') }}"
                placeholder="Search by order number or customer name..." 
                class="w-full px-4 py-2.5 rounded-xl text-white focus:outline-none transition-all"
                style="border: 1px solid rgba(255, 255, 255, 0.1); background: rgba(15, 20, 25, 0.6);" 
                onfocus="this.style.borderColor='#3b82f6'; this.style.background='rgba(15, 20, 25, 0.8)'" 
                onblur="this.style.borderColor='rgba(255, 255, 255, 0.1)'; this.style.background='rgba(15, 20, 25, 0.6)'"
            >
        </div>

        <!-- Date Filter -->
        <div>
            <label class="block text-sm font-semibold mb-2" style="color: rgba(255, 255, 255, 0.6);">Filter by Date</label>
            <select 
                name="date_filter" 
                class="px-4 py-2.5 rounded-xl text-white focus:outline-none transition-all"
                style="border: 1px solid rgba(255, 255, 255, 0.1); background: rgba(15, 20, 25, 0.6); min-width: 180px;"
                onfocus="this.style.borderColor='#3b82f6'; this.style.background='rgba(15, 20, 25, 0.8)'"
                onblur="this.style.borderColor='rgba(255, 255, 255, 0.1)'; this.style.background='rgba(15, 20, 25, 0.6)'"
            >
                <option value="">All Time</option>
                <option value="today" {{ request('date_filter') == 'today' ? 'selected' : '' }}>Today</option>
                <option value="3days" {{ request('date_filter') == '3days' ? 'selected' : '' }}>Last 3 Days</option>
                <option value="week" {{ request('date_filter') == 'week' ? 'selected' : '' }}>Last Week</option>
                <option value="month" {{ request('date_filter') == 'month' ? 'selected' : '' }}>Last Month</option>
            </select>
        </div>

        <!-- Buttons -->
        <x-admin.button type="submit" variant="primary">
            Apply Filter
        </x-admin.button>

        <x-admin.button href="{{ route('admin.orders.index') }}" variant="secondary">
            Clear
        </x-admin.button>
    </x-admin.filter-bar>

    <!-- Orders Table -->
    <div class="rounded-xl shadow-lg overflow-hidden" 
         style="background: linear-gradient(135deg, rgba(15, 20, 25, 0.8) 0%, rgba(26, 31, 46, 0.8) 100%); 
                border: 1px solid rgba(255, 255, 255, 0.1);">
        <div class="overflow-x-auto">
            <table class="w-full">
                <thead>
                    <tr style="background: linear-gradient(135deg, #3b82f6 0%, #2563eb 100%); border-bottom: 2px solid rgba(255, 255, 255, 0.1);">
                        <th class="px-6 py-4 text-left text-sm font-bold text-white">Order Number</th>
                        <th class="px-6 py-4 text-left text-sm font-bold text-white">Customer</th>
                        <th class="px-6 py-4 text-left text-sm font-bold text-white">Total</th>
                        <th class="px-6 py-4 text-left text-sm font-bold text-white">Status</th>
                        <th class="px-6 py-4 text-left text-sm font-bold text-white">Date Created</th>
                        <th class="px-6 py-4 text-right text-sm font-bold text-white">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($orders as $order)
                        <tr class="transition-all duration-200" 
                            style="border-bottom: 1px solid rgba(255, 255, 255, 0.05);" 
                            onmouseover="this.style.background='rgba(59, 130, 246, 0.1)'" 
                            onmouseout="this.style.background='transparent'">
                            <td class="px-6 py-4 font-bold" style="color: #3b82f6;">#{{ $order->order_number }}</td>
                            <td class="px-6 py-4 text-white">{{ $order->user->name ?? 'Unknown' }}</td>
                            <td class="px-6 py-4 font-bold text-white">₱{{ number_format($order->total, 2) }}</td>
                            <td class="px-6 py-4">
                                @php
                                    $statusStyles = match($order->status) {
                                        'completed' => 'background: linear-gradient(135deg, #10b981 0%, #059669 100%); color: white;',
                                        'cancelled' => 'background: linear-gradient(135deg, #ef4444 0%, #dc2626 100%); color: white;',
                                        'processing' => 'background: linear-gradient(135deg, #f59e0b 0%, #d97706 100%); color: white;',
                                        default => 'background: linear-gradient(135deg, #6b7280 0%, #4b5563 100%); color: white;'
                                    };
                                @endphp
                                <span class="px-3 py-1.5 rounded-lg text-xs font-bold inline-block" style="{{ $statusStyles }}">
                                    {{ ucfirst($order->status) }}
                                </span>
                            </td>
                            <td class="px-6 py-4" style="color: rgba(255, 255, 255, 0.6);">
                                {{ $order->created_at->format('M d, Y h:i A') }}
                            </td>
                            <td class="px-6 py-4 text-right">
                                <div class="flex gap-2 justify-end">
                                    <x-admin.button 
                                        href="{{ route('admin.orders.show', $order) }}" 
                                        size="sm" 
                                        variant="primary">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                                        </svg>
                                        View
                                    </x-admin.button>
                                    <x-admin.button 
                                        type="button" 
                                        onclick="deleteOrder({{ $order->id }})" 
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
                            <td colspan="6" class="px-6 py-12 text-center">
                                <svg class="w-16 h-16 mx-auto mb-4 opacity-30" style="color: rgba(255, 255, 255, 0.3);" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4"></path>
                                </svg>
                                <p class="text-lg font-semibold" style="color: rgba(255, 255, 255, 0.6);">No orders found</p>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <!-- Pagination -->
    @if($orders->hasPages())
        <div class="mt-8 flex justify-center">
            {{ $orders->links('pagination::tailwind') }}
        </div>
    @endif

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.10.0/dist/sweetalert2.all.min.js"></script>
    <script>
        function deleteOrder(orderId) {
            Swal.fire({
                title: 'Delete Order?',
                text: 'This action cannot be undone. The order will be permanently deleted.',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#ef4444',
                cancelButtonColor: '#64748b',
                confirmButtonText: 'Yes, Delete',
                cancelButtonText: 'Cancel',
                background: '#1e293b',
                color: '#f1f5f9',
                titleColor: '#f1f5f9',
                iconColor: '#f59e0b',
                didOpen: () => {
                    document.querySelector('.swal2-popup').style.border = '1px solid #334155';
                }
            }).then((result) => {
                if (result.isConfirmed) {
                    // Create form and submit delete request
                    const form = document.createElement('form');
                    form.method = 'POST';
                    form.action = `/admin/orders/${orderId}`;
                    form.innerHTML = `
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        <input type="hidden" name="_method" value="DELETE">
                    `;
                    document.body.appendChild(form);
                    
                    // Show loading state
                    Swal.fire({
                        title: 'Deleting...',
                        text: 'Please wait while the order is being deleted.',
                        icon: 'info',
                        allowOutsideClick: false,
                        allowEscapeKey: false,
                        didOpen: () => {
                            Swal.showLoading();
                            document.querySelector('.swal2-popup').style.border = '1px solid #334155';
                        },
                        background: '#1e293b',
                        color: '#f1f5f9',
                        titleColor: '#f1f5f9',
                        iconColor: '#64748b'
                    });
                    
                    // Add event listener for successful submission
                    form.addEventListener('submit', function() {
                        setTimeout(() => {
                            Swal.fire({
                                title: 'Delete Successful!',
                                text: 'The order has been deleted successfully.',
                                icon: 'success',
                                confirmButtonColor: '#10b981',
                                background: '#1e293b',
                                color: '#f1f5f9',
                                titleColor: '#10b981',
                                iconColor: '#10b981',
                                didOpen: () => {
                                    document.querySelector('.swal2-popup').style.border = '1px solid #334155';
                                },
                                didClose: () => {
                                    // Redirect to orders list after alert closes
                                    window.location.href = '{{ route("admin.orders.index") }}';
                                }
                            });
                        }, 500);
                    });
                    
                    form.submit();
                }
            });
        }
    </script>
</x-admin-layout>
