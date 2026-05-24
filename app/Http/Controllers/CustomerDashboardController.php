<?php

namespace App\Http\Controllers;

use App\Models\Notification;
use App\Models\Order;
use Illuminate\Support\Facades\Auth;

class CustomerDashboardController extends Controller
{
    /**
     * Display the customer dashboard.
     */
    public function index(): \Illuminate\View\View
    {
        $user = Auth::user();

        // Get recent orders (last 5)
        $recentOrders = Order::where('user_id', $user->id)
            ->orderBy('created_at', 'desc')
            ->limit(5)
            ->get();

        // Get order statistics
        $totalOrders = Order::where('user_id', $user->id)->count();
        $pendingOrders = Order::where('user_id', $user->id)->where('status', 'pending')->count();
        $completedOrders = Order::where('user_id', $user->id)->where('status', 'completed')->count();

        // Total spent
        $totalSpent = Order::where('user_id', $user->id)
            ->where('status', '!=', 'cancelled')
            ->sum('total');

        // Recent notifications (last 5)
        $recentNotifications = Notification::where('user_id', $user->id)
            ->orderBy('created_at', 'desc')
            ->limit(5)
            ->get();

        // Unread notifications count
        $unreadNotificationsCount = Notification::where('user_id', $user->id)
            ->unread()
            ->count();

        return view('customer.dashboard', [
            'recentOrders' => $recentOrders,
            'totalOrders' => $totalOrders,
            'pendingOrders' => $pendingOrders,
            'completedOrders' => $completedOrders,
            'totalSpent' => $totalSpent,
            'recentNotifications' => $recentNotifications,
            'unreadNotificationsCount' => $unreadNotificationsCount,
        ]);
    }
}
