<x-admin-layout>
    @section('page-title', 'Order Details')

    <!-- Breadcrumb -->
    <x-admin.breadcrumb :items="[
        ['label' => 'Sales & Orders'],
        ['label' => 'Orders', 'url' => route('admin.orders.index')],
        ['label' => 'Order #' . $order->order_number]
    ]" />

    <!-- Page Header -->
    <x-admin.page-header title="Order #{{ $order->order_number }}"
        subtitle="{{ $order->created_at->format('F d, Y h:i A') }}">
        <x-slot:actions>
            <div class="flex items-center gap-3">
                @php
                    $statusStyles = match ($order->status) {
                        'completed' => 'background: linear-gradient(135deg, #10b981 0%, #059669 100%); color: white;',
                        'cancelled' => 'background: linear-gradient(135deg, #ef4444 0%, #dc2626 100%); color: white;',
                        'processing' => 'background: linear-gradient(135deg, #f59e0b 0%, #d97706 100%); color: white;',
                        default => 'background: linear-gradient(135deg, #6b7280 0%, #4b5563 100%); color: white;'
                    };
                @endphp
                <span class="px-4 py-2 rounded-xl text-sm font-bold"
                    style="{{ $statusStyles }}">{{ ucfirst($order->status) }}</span>

                <x-admin.button type="button" onclick="deleteOrder({{ $order->id }})" variant="danger" size="md">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16">
                        </path>
                    </svg>
                    Delete Order
                </x-admin.button>
            </div>
        </x-slot:actions>
    </x-admin.page-header>

    <!-- Main Content Grid -->
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
        <!-- Left Column - Order Details -->
        <div class="lg:col-span-2 space-y-8">
            <!-- Order Items -->
            <div class="rounded-2xl shadow-2xl overflow-hidden"
                style="background: linear-gradient(180deg, #1a1f2e 0%, #0f1419 100%); border: 2px solid #b0bcc4; border-radius: 20px;">
                <div style="height: 3px; background: linear-gradient(90deg, #0f6fdd 0%, #b0bcc4 50%, #0f6fdd 100%);">
                </div>
                <div class="p-8">
                    <div class="flex items-center gap-3 mb-6">
                        <div
                            style="background-color: #0f6fdd; padding: 10px 14px; border-radius: 10px; display: flex; align-items: center; justify-content: center;">
                            <svg class="w-5 h-5" fill="none" stroke="#ffffff" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path>
                            </svg>
                        </div>
                        <div>
                            <h2 class="text-2xl font-bold" style="color: #ffffff;">Order Items</h2>
                            <p class="text-xs mt-1" style="color: #b0bcc4;">Products included in this order</p>
                        </div>
                    </div>
                    <div class="space-y-4">
                        @forelse ($order->items as $item)
                            <div class="flex justify-between items-center py-4 px-4 rounded-lg"
                                style="background: rgba(15, 111, 221, 0.05); border: 1px solid rgba(15, 111, 221, 0.2);">
                                <div>
                                    <p class="font-bold text-lg" style="color: #ffffff;">
                                        {{ optional($item->product)->name ?? $item->product_name ?? 'Product' }}</p>
                                    <p class="text-sm mt-1" style="color: #b0bcc4;">Quantity: <span class="font-semibold"
                                            style="color: #0f6fdd;">{{ $item->quantity }}</span></p>
                                </div>
                                <p class="font-bold text-xl" style="color: #0f6fdd;">
                                    ₱{{ number_format($item->unit_price * $item->quantity, 2) }}</p>
                            </div>
                        @empty
                            <p style="color: #b0bcc4; text-align: center; padding: 2rem;">No items in this order</p>
                        @endforelse
                    </div>
                </div>
            </div>

            <!-- Order Status Management -->
            <div class="rounded-2xl shadow-2xl overflow-hidden"
                style="background: linear-gradient(180deg, #1a1f2e 0%, #0f1419 100%); border: 2px solid #b0bcc4; border-radius: 20px;">
                <div style="height: 3px; background: linear-gradient(90deg, #0f6fdd 0%, #b0bcc4 50%, #0f6fdd 100%);">
                </div>
                <div class="p-8">
                    <div class="flex items-center gap-3 mb-6">
                        <div
                            style="background-color: #0f6fdd; padding: 10px 14px; border-radius: 10px; display: flex; align-items: center; justify-content: center;">
                            <svg class="w-5 h-5" fill="none" stroke="#ffffff" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                        </div>
                        <div>
                            <h2 class="text-2xl font-bold" style="color: #ffffff;">Update Status</h2>
                            <p class="text-xs mt-1" style="color: #b0bcc4;">Change the order status</p>
                        </div>
                    </div>
                    <form id="updateStatusForm" action="{{ route('admin.orders.update-status', $order) }}" method="POST"
                        class="space-y-4" onsubmit="return confirmStatusUpdate(event)">
                        @csrf
                        @method('PATCH')
                        <select id="statusSelect" name="status"
                            class="w-full rounded-lg px-4 py-3 font-semibold text-base"
                            style="border: 2px solid #444; background-color: #0f1419; color: #ffffff;">
                            <option value="pending" {{ $order->status === 'pending' ? 'selected' : '' }}>⏳ Pending
                            </option>
                            <option value="processing" {{ $order->status === 'processing' ? 'selected' : '' }}>🔄
                                Processing</option>
                            <option value="completed" {{ $order->status === 'completed' ? 'selected' : '' }}>✅ Completed
                            </option>
                            <option value="cancelled" {{ $order->status === 'cancelled' ? 'selected' : '' }}>❌ Cancelled
                            </option>
                        </select>
                        <button type="submit"
                            class="w-full px-6 py-3 rounded-lg font-bold transition-all flex items-center justify-center gap-2"
                            style="background: linear-gradient(135deg, #4caf50 0%, #45a049 100%); color: white; border: 2px solid #45a049; box-shadow: 0 4px 12px rgba(76, 175, 80, 0.3);"
                            onmouseover="this.style.boxShadow='0 8px 20px rgba(76, 175, 80, 0.4)'; this.style.transform='translateY(-2px)'"
                            onmouseout="this.style.boxShadow='0 4px 12px rgba(76, 175, 80, 0.3)'; this.style.transform='translateY(0)'">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M5 13l4 4L19 7"></path>
                            </svg>
                            Update Status
                        </button>
                    </form>
                </div>
            </div>
        </div>

        <!-- Right Column - Order Summary & Customer Info -->
        <div class="lg:col-span-1 space-y-8">
            <!-- Order Summary -->
            <div class="rounded-2xl shadow-2xl overflow-hidden"
                style="background: linear-gradient(180deg, #1a1f2e 0%, #0f1419 100%); border: 2px solid #b0bcc4; border-radius: 20px;">
                <div style="height: 3px; background: linear-gradient(90deg, #0f6fdd 0%, #b0bcc4 50%, #0f6fdd 100%);">
                </div>
                <div class="p-8">
                    <div class="flex items-center gap-3 mb-6">
                        <div
                            style="background-color: #0f6fdd; padding: 10px 14px; border-radius: 10px; display: flex; align-items: center; justify-content: center;">
                            <svg class="w-5 h-5" fill="none" stroke="#ffffff" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M9 7h6m0 10v-3m-3 3h.01M9 17h.01M9 14h.01M12 14h.01M15 11h.01M12 11h.01M9 11h.01M7 21h10a2 2 0 002-2V5a2 2 0 00-2-2H7a2 2 0 00-2 2v14a2 2 0 002 2z">
                                </path>
                            </svg>
                        </div>
                        <div>
                            <h2 class="text-2xl font-bold" style="color: #ffffff;">Order Summary</h2>
                            <p class="text-xs mt-1" style="color: #b0bcc4;">Payment breakdown</p>
                        </div>
                    </div>
                    <div class="space-y-4">
                        <div class="flex justify-between items-center py-3 px-4 rounded-lg"
                            style="background: rgba(15, 111, 221, 0.05); border: 1px solid rgba(15, 111, 221, 0.2);">
                            <span style="color: #b0bcc4; font-weight: 500;">Subtotal</span>
                            <span
                                style="color: #ffffff; font-weight: bold; font-size: 1.125rem;">₱{{ number_format($order->subtotal ?? $order->total, 2) }}</span>
                        </div>
                        <div class="flex justify-between items-center pt-4" style="border-top: 2px solid #444;">
                            <span style="color: #ffffff; font-weight: bold; font-size: 1.25rem;">Total</span>
                            <span
                                style="color: #0f6fdd; font-weight: bold; font-size: 1.5rem;">₱{{ number_format($order->total, 2) }}</span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Customer Info -->
            <div class="rounded-2xl shadow-2xl overflow-hidden"
                style="background: linear-gradient(180deg, #1a1f2e 0%, #0f1419 100%); border: 2px solid #b0bcc4; border-radius: 20px;">
                <div style="height: 3px; background: linear-gradient(90deg, #0f6fdd 0%, #b0bcc4 50%, #0f6fdd 100%);">
                </div>
                <div class="p-8">
                    <div class="flex items-center gap-3 mb-6">
                        <div
                            style="background-color: #0f6fdd; padding: 10px 14px; border-radius: 10px; display: flex; align-items: center; justify-content: center;">
                            <svg class="w-5 h-5" fill="none" stroke="#ffffff" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                            </svg>
                        </div>
                        <div>
                            <h2 class="text-2xl font-bold" style="color: #ffffff;">Customer Info</h2>
                            <p class="text-xs mt-1" style="color: #b0bcc4;">Order placed by</p>
                        </div>
                    </div>
                    <div class="space-y-4">
                        <div class="py-3 px-4 rounded-lg"
                            style="background: rgba(15, 111, 221, 0.05); border: 1px solid rgba(15, 111, 221, 0.2);">
                            <p style="color: #b0bcc4; font-size: 0.75rem; margin-bottom: 4px;">Name</p>
                            <p style="color: #ffffff; font-weight: bold; font-size: 1.125rem;">
                                {{ $order->user->name ?? 'Unknown' }}</p>
                        </div>
                        <div class="py-3 px-4 rounded-lg"
                            style="background: rgba(15, 111, 221, 0.05); border: 1px solid rgba(15, 111, 221, 0.2);">
                            <p style="color: #b0bcc4; font-size: 0.75rem; margin-bottom: 4px;">Email</p>
                            <p style="color: #ffffff; font-weight: bold; font-size: 1.125rem;">
                                {{ $order->user->email ?? 'N/A' }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-admin-layout>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.10.0/dist/sweetalert2.all.min.js"></script>
@if (session('success'))
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            Swal.fire({
                title: 'Status Updated',
                text: @json(session('success')),
                icon: 'success',
                confirmButtonColor: '#4caf50',
                background: '#0f1419',
                color: '#ffffff',
                titleColor: '#4caf50',
                iconColor: '#4caf50',
                didOpen: () => {
                    document.querySelector('.swal2-popup').style.border = '3px solid #b0bcc4';
                }
            });
        });
    </script>
@endif
<script>
    function confirmStatusUpdate(event) {
        event.preventDefault();
        const currentStatus = '{{ $order->status }}';
        const newStatus = document.getElementById('statusSelect').value;

        if (currentStatus === newStatus) {
            Swal.fire({
                title: 'No Change',
                text: 'The selected status is the same as the current status.',
                icon: 'info',
                confirmButtonColor: '#3b82f6',
                background: '#0f1419',
                color: '#ffffff',
                didOpen: () => {
                    document.querySelector('.swal2-popup').style.border = '3px solid #b0bcc4';
                }
            });
            return false;
        }

        const statusEmoji = {
            'pending': '⏳',
            'processing': '🔄',
            'completed': '✅',
            'cancelled': '❌'
        };

        Swal.fire({
            title: 'Update Order Status?',
            html: `Change status from <strong>${statusEmoji[currentStatus]} ${currentStatus.toUpperCase()}</strong> to <strong>${statusEmoji[newStatus]} ${newStatus.toUpperCase()}</strong>`,
            icon: 'question',
            showCancelButton: true,
            confirmButtonColor: '#4caf50',
            cancelButtonColor: '#666',
            confirmButtonText: 'Yes, Update',
            cancelButtonText: 'Cancel',
            background: '#0f1419',
            color: '#ffffff',
            didOpen: () => {
                document.querySelector('.swal2-popup').style.border = '3px solid #b0bcc4';
            }
        }).then((result) => {
            if (result.isConfirmed) {
                Swal.fire({
                    title: 'Updating...',
                    text: 'Please wait while the status is being updated.',
                    icon: 'info',
                    allowOutsideClick: false,
                    allowEscapeKey: false,
                    didOpen: () => {
                        Swal.showLoading();
                        document.querySelector('.swal2-popup').style.border = '3px solid #b0bcc4';
                    },
                    background: '#0f1419',
                    color: '#ffffff'
                });
                document.getElementById('updateStatusForm').submit();
            }
        });

        return false;
    }

    function deleteOrder(orderId) {
        Swal.fire({
            title: 'Delete Order?',
            text: 'This action cannot be undone. The order will be permanently deleted.',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#f44336',
            cancelButtonColor: '#666',
            confirmButtonText: 'Yes, Delete',
            cancelButtonText: 'Cancel',
            background: '#0f1419',
            color: '#ffffff',
            titleColor: '#ffffff',
            iconColor: '#ff9500',
            didOpen: () => {
                document.querySelector('.swal2-popup').style.border = '3px solid #b0bcc4';
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
                        document.querySelector('.swal2-popup').style.border = '3px solid #b0bcc4';
                    },
                    background: '#0f1419',
                    color: '#ffffff',
                    titleColor: '#ffffff',
                    iconColor: '#b0bcc4'
                });

                // Add event listener for successful submission
                form.addEventListener('submit', function () {
                    setTimeout(() => {
                        Swal.fire({
                            title: 'Delete Successful!',
                            text: 'The order has been deleted successfully.',
                            icon: 'success',
                            confirmButtonColor: '#4caf50',
                            background: '#0f1419',
                            color: '#ffffff',
                            titleColor: '#4caf50',
                            iconColor: '#4caf50',
                            didOpen: () => {
                                document.querySelector('.swal2-popup').style.border = '3px solid #b0bcc4';
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