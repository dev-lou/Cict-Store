<?php

namespace App\Http\Controllers;

use App\Models\Notification;
use App\Services\NotificationService;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class NotificationController extends Controller
{
    /**
     * Resolve where a notification should redirect.
     */
    private function resolveNotificationLink(Notification $notification): string
    {
        if ($notification->data && isset($notification->data['order_id'])) {
            return route('orders.show', $notification->data['order_id']);
        }

        return route('notifications.index');
    }

    /**
     * Display all notifications for the authenticated user.
     */
    public function index(Request $request)
    {
        $notifications = Notification::where('user_id', auth()->id())
            ->orderBy('created_at', 'desc')
            ->paginate(20);

        if ($request->wantsJson()) {
            return response()->json($notifications);
        }

        return view('notifications.index', compact('notifications'));
    }

    /**
     * Get unread notifications (AJAX endpoint).
     */
    public function getUnread()
    {
        // Return empty response if user is not authenticated
        if (! auth()->check()) {
            return response()->json([
                'notifications' => [],
                'unread_count' => 0,
            ]);
        }

        $notifications = Notification::where('user_id', auth()->id())
            ->orderBy('created_at', 'desc')
            ->limit(10)
            ->get()
            ->map(function ($notification) {
                $data = $notification->data ?? [];

                return [
                    'id' => $notification->id,
                    'type' => $notification->type,
                    'title' => $data['title'] ?? 'Notification',
                    'message' => $data['message'] ?? 'You have a new notification',
                    'is_read' => $notification->is_read, // Add is_read status
                    'time' => $notification->created_at->diffForHumans(),
                    'link' => route('notifications.open', $notification->id),
                ];
            });

        return response()->json([
            'notifications' => $notifications,
            'unread_count' => Notification::where('user_id', auth()->id())->unread()->count(),
        ]);
    }

    /**
     * Open a notification: mark as read then redirect to target.
     */
    public function open($notification)
    {
        if (! is_string($notification) || ! Str::isUuid($notification)) {
            return redirect()->route('notifications.index');
        }

        $notification = Notification::where('id', $notification)
            ->where('user_id', auth()->id())
            ->first();

        if (! $notification) {
            return redirect()->route('notifications.index');
        }

        $notification->markAsRead();

        return redirect()->to($this->resolveNotificationLink($notification));
    }

    /**
     * Mark a single notification as read.
     */
    public function markAsRead($notification)
    {
        if (! is_string($notification) || ! Str::isUuid($notification)) {
            return response()->json(['error' => 'Invalid notification id'], 422);
        }

        $notification = Notification::where('id', $notification)
            ->where('user_id', auth()->id())
            ->first();

        if (! $notification) {
            return response()->json(['error' => 'Notification not found'], 404);
        }

        $notification->markAsRead();

        return response()->json([
            'success' => true,
            'message' => 'Notification marked as read',
        ]);
    }

    /**
     * Mark all notifications as read for the authenticated user.
     */
    public function markAllAsRead()
    {
        NotificationService::markAllAsRead(auth()->id());

        return response()->json([
            'success' => true,
            'message' => 'All notifications marked as read',
        ]);
    }

    /**
     * Delete a notification.
     */
    public function destroy($notification)
    {
        if (! is_string($notification) || ! Str::isUuid($notification)) {
            return response()->json(['error' => 'Invalid notification id'], 422);
        }

        $notification = Notification::where('id', $notification)
            ->where('user_id', auth()->id())
            ->first();

        if (! $notification) {
            return response()->json(['error' => 'Notification not found'], 404);
        }

        $notification->delete();

        return response()->json([
            'success' => true,
            'message' => 'Notification deleted',
        ]);
    }
}
