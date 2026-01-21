<?php

namespace App\Services;

use App\Models\Notification;
use App\Models\Order;

class NotificationService
{
    /**
     * Create notification for order status change.
     */
    public static function orderStatusChanged(Order $order, string $oldStatus, string $newStatus): void
    {
        $statusMessages = [
            'pending' => '⏳ Your order is pending confirmation',
            'processing' => '🔄 Your order is being processed',
            'completed' => '✅ Your order has been completed',
            'cancelled' => '❌ Your order has been cancelled',
        ];

        $title = match($newStatus) {
            'processing' => 'Order Being Processed',
            'completed' => 'Order Completed',
            'cancelled' => 'Order Cancelled',
            default => 'Order Status Updated',
        };

        $message = $statusMessages[$newStatus] ?? "Your order status has been updated to {$newStatus}";

        Notification::create([
            'user_id' => $order->user_id,
            'type' => 'order_status_changed',
            'notifiable_type' => 'App\\Models\\User',
            'notifiable_id' => $order->user_id,
            'data' => [
                'title' => $title,
                'message' => "{$message} (Order #{$order->order_number})",
                'order_id' => $order->id,
                'order_number' => $order->order_number,
                'old_status' => $oldStatus,
                'new_status' => $newStatus,
            ],
        ]);
    }

    /**
     * Create notification for completed order.
     */
    public static function orderCompleted(Order $order): void
    {
        Notification::create([
            'user_id' => $order->user_id,
            'type' => 'order_completed',
            'notifiable_type' => 'App\\Models\\User',
            'notifiable_id' => $order->user_id,
            'data' => [
                'title' => 'Thank You for Your Order! 🎉',
                'message' => "Your order #{$order->order_number} is ready for pickup at the CICT Student Council Office. Please bring your student ID and order number.",
                'order_id' => $order->id,
                'order_number' => $order->order_number,
                'pickup_location' => 'CICT Student Council Office',
            ],
        ]);
    }

    /**
     * Create notification for order assignment to staff.
     */
    public static function orderAssignedToStaff(Order $order): void
    {
        if (!$order->assigned_staff_id) {
            return;
        }

        Notification::create([
            'user_id' => $order->assigned_staff_id,
            'type' => 'order_assigned',
            'notifiable_type' => 'App\\Models\\User',
            'notifiable_id' => $order->assigned_staff_id,
            'data' => [
                'title' => 'New Order Assigned',
                'message' => "You have been assigned to order #{$order->order_number}. Total: ₱" . number_format($order->total, 2),
                'order_id' => $order->id,
                'order_number' => $order->order_number,
                'customer_name' => $order->user->name ?? 'Unknown',
            ],
        ]);
    }

    /**
     * Create notification for low stock alert.
     */
    public static function lowStockAlert(int $userId, string $productName, int $currentStock): void
    {
        Notification::create([
            'user_id' => $userId,
            'type' => 'low_stock_alert',
            'notifiable_type' => 'App\\Models\\User',
            'notifiable_id' => $userId,
            'data' => [
                'title' => '⚠️ Low Stock Alert',
                'message' => "{$productName} is running low on stock. Only {$currentStock} units remaining.",
                'product_name' => $productName,
                'current_stock' => $currentStock,
            ],
        ]);
    }

    /**
     * Get unread notification count for user.
     */
    public static function getUnreadCount(int $userId): int
    {
        return Notification::where('user_id', $userId)
            ->unread()
            ->count();
    }

    /**
     * Mark all notifications as read for user.
     */
    public static function markAllAsRead(int $userId): void
    {
        Notification::where('user_id', $userId)
            ->unread()
            ->update([
                'is_read' => true,
                'read_at' => now(),
            ]);
    }
}
