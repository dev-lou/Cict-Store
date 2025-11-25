<x-app-layout>
    @section('title', 'Notifications - ' . config('app.name'))

    <div style="background: #FFFAF1; min-height: 100vh; padding-top: 140px; padding-bottom: 80px;">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
            <!-- Header -->
            <div class="mb-8 flex items-center justify-between">
                <div>
                    <h1 style="font-size: 2.5rem; font-weight: 800; color: #1a1a1a; margin-bottom: 8px;">🔔 Notifications</h1>
                    <p style="color: #666666; font-size: 15px;">Stay updated with your order status changes</p>
                </div>
                @if($notifications->where('is_read', false)->count() > 0)
                    <button onclick="markAllAsRead()" style="background: #8B0000; color: white; padding: 10px 20px; border-radius: 8px; border: none; font-weight: 600; cursor: pointer;">
                        Mark All as Read
                    </button>
                @endif
            </div>

            <!-- Notifications List -->
            @forelse($notifications as $notification)
                <div class="notification-card {{ $notification->is_read ? 'read' : 'unread' }}" style="background: white; border: 1px solid #F0F0F0; border-radius: 12px; padding: 20px; margin-bottom: 16px; transition: all 0.3s ease;">
                    <div style="display: flex; gap: 16px; align-items: start;">
                        <!-- Icon -->
                        <div style="flex-shrink: 0;">
                            @if($notification->type === 'order_completed')
                                <div style="width: 48px; height: 48px; border-radius: 50%; background: #D4EDDA; display: flex; align-items: center; justify-content: center; font-size: 24px;">
                                    ✅
                                </div>
                            @elseif($notification->type === 'order_status_changed')
                                <div style="width: 48px; height: 48px; border-radius: 50%; background: #FFF3CD; display: flex; align-items: center; justify-content: center; font-size: 24px;">
                                    🔄
                                </div>
                            @else
                                <div style="width: 48px; height: 48px; border-radius: 50%; background: #D1ECF1; display: flex; align-items: center; justify-content: center; font-size: 24px;">
                                    🔔
                                </div>
                            @endif
                        </div>

                        <!-- Content -->
                        <div style="flex-grow: 1;">
                            <h3 style="font-size: 16px; font-weight: 700; color: #1a1a1a; margin-bottom: 6px;">
                                {{ $notification->title }}
                            </h3>
                            <p style="color: #666666; font-size: 14px; margin-bottom: 8px; line-height: 1.5;">
                                {{ $notification->message }}
                            </p>
                            <div style="display: flex; gap: 16px; align-items: center;">
                                <span style="color: #999999; font-size: 13px;">
                                    {{ $notification->created_at->diffForHumans() }}
                                </span>
                                @if($notification->data && isset($notification->data['order_id']))
                                    <a href="{{ route('orders.show', $notification->data['order_id']) }}" style="color: #8B0000; font-size: 13px; font-weight: 600; text-decoration: none;">
                                        View Order →
                                    </a>
                                @endif
                            </div>
                        </div>

                        <!-- Actions -->
                        <div style="flex-shrink: 0; display: flex; gap: 8px;">
                            @if(!$notification->is_read)
                                <button onclick="markAsRead({{ $notification->id }})" style="padding: 6px 12px; background: #F0F0F0; border: none; border-radius: 6px; font-size: 12px; cursor: pointer;">
                                    Mark as Read
                                </button>
                            @endif
                        </div>
                    </div>
                </div>
            @empty
                <div style="background: white; border: 1px solid #F0F0F0; border-radius: 12px; padding: 60px; text-align: center;">
                    <div style="font-size: 64px; margin-bottom: 16px;">🔕</div>
                    <h3 style="font-size: 20px; font-weight: 700; color: #1a1a1a; margin-bottom: 8px;">No Notifications</h3>
                    <p style="color: #666666;">You're all caught up! We'll notify you when there are updates.</p>
                </div>
            @endforelse

            <!-- Pagination -->
            @if($notifications->hasPages())
                <div class="mt-8">
                    {{ $notifications->links() }}
                </div>
            @endif
        </div>
    </div>

    <script>
        function markAsRead(notificationId) {
            fetch(`/notifications/${notificationId}/read`, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                },
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    location.reload();
                }
            });
        }

        function markAllAsRead() {
            fetch('/notifications/mark-all-read', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                },
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    location.reload();
                }
            });
        }
    </script>

    <style>
        .notification-card.unread {
            border-left: 4px solid #8B0000;
            background: #FFFBF5 !important;
        }

        .notification-card:hover {
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.08);
            transform: translateY(-2px);
        }
    </style>
</x-app-layout>
