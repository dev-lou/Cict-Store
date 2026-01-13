<x-admin-layout>
    @section('page-title', 'All Orders')

    <style>
        .filter-badge {
            display: inline-block;
            padding: 4px 12px;
            background-color: #3b82f6;
            color: #ffffff;
            border-radius: 20px;
            font-size: 12px;
            font-weight: 700;
            margin-left: 8px;
        }
    </style>

    <!-- Header Section -->
    <div class="mb-8">
        <h2 class="text-2xl font-bold" style="color: #f1f5f9;">
            All Orders
            <span class="filter-badge">{{ $orders->total() }}</span>
        </h2>
        <p class="mt-1" style="color: #94a3b8;">View and manage all customer orders</p>
    </div>

    <!-- Filter Bar -->
    <div class="rounded-lg shadow-lg p-6 mb-6" style="background-color: #1e293b; border: 1px solid #334155;">
        <form method="GET" class="flex gap-4 flex-wrap items-end">
            <!-- Search Bar -->
            <div class="flex-1 min-w-64">
                <label class="block text-sm font-semibold mb-2" style="color: #94a3b8;">Search Order or Customer</label>
                <input 
                    type="text" 
                    name="search" 
                    value="{{ request('search', '') }}"
                    placeholder="Search by order number or customer name..." 
                    class="w-full px-4 py-2 rounded-lg text-white focus:outline-none"
                    style="border: 1px solid #334155; background-color: #0f172a;" 
                    onfocus="this.style.borderColor='#3b82f6'" 
                    onblur="this.style.borderColor='#334155'"
                >
            </div>

            <!-- Date Filter Dropdown -->
            <div>
                <label class="block text-sm font-semibold mb-2" style="color: #94a3b8;">Filter by Date</label>
                <select 
                    name="date_filter" 
                    class="px-4 py-2 rounded-lg text-white focus:outline-none"
                    style="border: 1px solid #334155; background-color: #0f172a; min-width: 180px;"
                    onfocus="this.style.borderColor='#3b82f6'"
                    onblur="this.style.borderColor='#334155'"
                >
                    <option value="" style="background-color: #0f172a; color: white;">All Time</option>
                    <option value="today" {{ request('date_filter') == 'today' ? 'selected' : '' }} style="background-color: #0f172a; color: white;">Today</option>
                    <option value="3days" {{ request('date_filter') == '3days' ? 'selected' : '' }} style="background-color: #0f172a; color: white;">Last 3 Days</option>
                    <option value="week" {{ request('date_filter') == 'week' ? 'selected' : '' }} style="background-color: #0f172a; color: white;">Last Week</option>
                    <option value="month" {{ request('date_filter') == 'month' ? 'selected' : '' }} style="background-color: #0f172a; color: white;">Last Month</option>
                </select>
            </div>

            <!-- Filter Button -->
            <button type="submit" class="px-6 py-2 rounded-lg font-bold transition-colors" style="background-color: #3b82f6; color: #ffffff; border: none;" onmouseover="this.style.backgroundColor='#2563eb'" onmouseout="this.style.backgroundColor='#3b82f6'">
                Apply Filter
            </button>

            <!-- Clear Filters -->
            <a href="{{ route('admin.orders.index') }}" class="px-6 py-2 rounded-lg font-bold transition-colors text-center" style="background-color: transparent; color: #94a3b8; border: 1px solid #334155;" onmouseover="this.style.backgroundColor='#334155';" onmouseout="this.style.backgroundColor='transparent';">
                Clear
            </a>
        </form>
    </div>

    <!-- Orders Table -->
    <div class="rounded-lg shadow-lg overflow-hidden" style="background-color: #1e293b; border: 1px solid #334155;">
        <div class="overflow-x-auto">
            <table class="w-full">
                <thead>
                    <tr class="transition-colors" style="border-bottom: 1px solid #334155; background-color: #3b82f6;">
                        <th class="px-6 py-4 text-left text-sm font-bold" style="color: #ffffff;">Order Number</th>
                        <th class="px-6 py-4 text-left text-sm font-bold" style="color: #ffffff;">Customer</th>
                        <th class="px-6 py-4 text-left text-sm font-bold" style="color: #ffffff;">Total</th>
                        <th class="px-6 py-4 text-left text-sm font-bold" style="color: #ffffff;">Status</th>
                        <th class="px-6 py-4 text-left text-sm font-bold" style="color: #ffffff;">Date Created</th>
                        <th class="px-6 py-4 text-right text-sm font-bold" style="color: #ffffff;">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($orders as $order)
                        <tr class="transition-colors" style="border-bottom: 1px solid #334155;" onmouseover="this.style.backgroundColor='#334155'" onmouseout="this.style.backgroundColor='transparent'">
                            <td class="px-6 py-4 font-bold" style="color: #94a3b8;">#{{ $order->order_number }}</td>
                            <td class="px-6 py-4" style="color: #f1f5f9;">{{ $order->user->name ?? 'Unknown' }}</td>
                            <td class="px-6 py-4 font-bold" style="color: #f1f5f9;">₱{{ number_format($order->total, 2) }}</td>
                            <td class="px-6 py-4">
                                @php
                                    $statusColor = match($order->status) {
                                        'completed' => '#10b981',
                                        'cancelled' => '#ef4444',
                                        'processing' => '#f59e0b',
                                        default => '#64748b'
                                    };
                                    $statusTextColor = 'white';
                                @endphp
                                <span class="px-3 py-1 rounded-full text-xs font-bold" style="background-color: {{ $statusColor }}; color: {{ $statusTextColor }};">{{ ucfirst($order->status) }}</span>
                            </td>
                            <td class="px-6 py-4" style="color: #94a3b8;">{{ $order->created_at->format('M d, Y h:i A') }}</td>
                            <td class="px-6 py-4 text-right">
                                <div style="display: flex; gap: 6px; justify-content: flex-end;">
                                    <!-- View Button -->
                                    <a href="{{ route('admin.orders.show', $order) }}" class="inline-flex items-center gap-1 px-3 py-1.5 rounded-md text-xs font-semibold transition-all" style="background-color: #3b82f6; color: #ffffff; border: none;" onmouseover="this.style.backgroundColor='#2563eb'" onmouseout="this.style.backgroundColor='#3b82f6'">
                                        <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path></svg>
                                        View
                                    </a>
                                    <!-- Delete Button -->
                                    <button type="button" onclick="deleteOrder({{ $order->id }})" class="inline-flex items-center gap-1 px-3 py-1.5 rounded-md text-xs font-semibold transition-all" style="background-color: #ef4444; color: white; border: none; cursor: pointer;" onmouseover="this.style.backgroundColor='#dc2626'" onmouseout="this.style.backgroundColor='#ef4444'">
                                        <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                                        Delete
                                    </button>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="px-6 py-8 text-center" style="color: #94a3b8;">
                                No orders found
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
