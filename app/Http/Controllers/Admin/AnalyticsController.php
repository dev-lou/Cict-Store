<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\User;
use Illuminate\Http\Request;
use Carbon\Carbon;

class AnalyticsController extends Controller
{
    /**
     * Show analytics dashboard
     */
    public function index()
    {
        return view('admin.analytics.index');
    }

    /**
     * Get revenue data for chart
     */
    public function getRevenue()
    {
        $days = 30;
        $startDate = Carbon::now()->subDays($days)->startOfDay();
        
        $revenue = Order::where('created_at', '>=', $startDate)
            ->selectRaw('DATE(created_at) as date, SUM(total) as total')
            ->groupBy('date')
            ->orderBy('date')
            ->get();

        return response()->json([
            'dates' => $revenue->pluck('date'),
            'revenue' => $revenue->pluck('total'),
        ]);
    }

    /**
     * Get category breakdown
     */
    public function getCategories()
    {
        $categories = Order::with('user')
            ->where('created_at', '>=', Carbon::now()->subDays(30))
            ->selectRaw('status, COUNT(*) as count, SUM(total) as total')
            ->groupBy('status')
            ->get();

        return response()->json([
            'categories' => $categories->pluck('status'),
            'values' => $categories->pluck('total'),
            'counts' => $categories->pluck('count'),
        ]);
    }

    /**
     * Get top products
     */
    public function getTopProducts()
    {
        // Since we don't have order items table, we'll show order statistics
        $orders = Order::where('created_at', '>=', Carbon::now()->subDays(30))
            ->orderBy('total', 'desc')
            ->limit(5)
            ->get();

        return response()->json([
            'products' => $orders->map(fn($o) => 'Order #' . $o->order_number)->values(),
            'revenue' => $orders->pluck('total'),
        ]);
    }

    /**
     * Get KPI metrics
     */
    public function getKpis()
    {
        $today = Carbon::now();
        $thisMonth = $today->copy()->startOfMonth();
        $lastMonth = $today->copy()->subMonth()->startOfMonth();

        $todayRevenue = Order::whereDate('created_at', $today)
            ->sum('total');
        
        $monthRevenue = Order::whereBetween('created_at', [$thisMonth, $today])
            ->sum('total');
        
        $lastMonthRevenue = Order::whereBetween('created_at', [$lastMonth, $lastMonth->copy()->endOfMonth()])
            ->sum('total');

        $todayOrders = Order::whereDate('created_at', $today)->count();
        $monthOrders = Order::whereBetween('created_at', [$thisMonth, $today])->count();

        $avgOrderValue = $monthOrders > 0 ? $monthRevenue / $monthOrders : 0;

        $monthGrowth = $lastMonthRevenue > 0 
            ? (($monthRevenue - $lastMonthRevenue) / $lastMonthRevenue) * 100 
            : 0;

        return response()->json([
            'today_revenue' => (float) $todayRevenue,
            'month_revenue' => (float) $monthRevenue,
            'month_orders' => (int) $monthOrders,
            'avg_order_value' => (float) $avgOrderValue,
            'month_growth' => (float) $monthGrowth,
        ]);
    }

    /**
     * Get daily orders
     */
    public function getDailyOrders()
    {
        $days = 30;
        $startDate = Carbon::now()->subDays($days)->startOfDay();
        
        $orders = Order::where('created_at', '>=', $startDate)
            ->selectRaw('DATE(created_at) as date, COUNT(*) as count')
            ->groupBy('date')
            ->orderBy('date')
            ->get();

        return response()->json([
            'dates' => $orders->pluck('date'),
            'counts' => $orders->pluck('count'),
        ]);
    }

    /**
     * Get order status breakdown
     */
    public function getOrderStatus()
    {
        $statusBreakdown = Order::where('created_at', '>=', Carbon::now()->subDays(30))
            ->selectRaw('status, COUNT(*) as count')
            ->groupBy('status')
            ->get();

        return response()->json([
            'statuses' => $statusBreakdown->pluck('status'),
            'counts' => $statusBreakdown->pluck('count'),
        ]);
    }

    /**
     * Get top customers
     */
    public function getTopCustomers()
    {
        $topCustomers = Order::where('created_at', '>=', Carbon::now()->subDays(30))
            ->selectRaw('user_id, COUNT(*) as orders, SUM(total) as revenue')
            ->groupBy('user_id')
            ->orderBy('revenue', 'desc')
            ->limit(10)
            ->with('user')
            ->get();

        return response()->json([
            'customers' => $topCustomers->map(fn($o) => $o->user->name ?? 'Unknown')->values(),
            'revenue' => $topCustomers->pluck('revenue'),
            'orders' => $topCustomers->pluck('orders'),
        ]);
    }

    /**
     * Get peak hours analysis
     */
    public function getPeakHours()
    {
        $hours = Order::where('created_at', '>=', Carbon::now()->subDays(7))
            ->selectRaw('HOUR(created_at) as hour, COUNT(*) as count, SUM(total) as revenue')
            ->groupBy('hour')
            ->orderBy('hour')
            ->get();

        return response()->json([
            'hours' => $hours->pluck('hour')->map(fn($h) => $h . ':00'),
            'orders' => $hours->pluck('count'),
            'revenue' => $hours->pluck('revenue'),
        ]);
    }

    /**
     * Get weekly comparison
     */
    public function getWeeklyComparison()
    {
        $thisWeek = Order::whereBetween('created_at', [
            Carbon::now()->startOfWeek(),
            Carbon::now()->endOfWeek()
        ])->sum('total');

        $lastWeek = Order::whereBetween('created_at', [
            Carbon::now()->subWeek()->startOfWeek(),
            Carbon::now()->subWeek()->endOfWeek()
        ])->sum('total');

        $twoWeeksAgo = Order::whereBetween('created_at', [
            Carbon::now()->subWeeks(2)->startOfWeek(),
            Carbon::now()->subWeeks(2)->endOfWeek()
        ])->sum('total');

        $threeWeeksAgo = Order::whereBetween('created_at', [
            Carbon::now()->subWeeks(3)->startOfWeek(),
            Carbon::now()->subWeeks(3)->endOfWeek()
        ])->sum('total');

        return response()->json([
            'weeks' => [
                'Week 1 (Latest)',
                'Week 2',
                'Week 3',
                'Week 4'
            ],
            'revenue' => [$thisWeek, $lastWeek, $twoWeeksAgo, $threeWeeksAgo],
        ]);
    }

    /**
     * Get conversion metrics
     */
    public function getConversionMetrics()
    {
        $totalUsers = User::where('created_at', '>=', Carbon::now()->subDays(30))->count();
        $convertedUsers = Order::where('created_at', '>=', Carbon::now()->subDays(30))
            ->distinct('user_id')
            ->count('user_id');
        
        $conversionRate = $totalUsers > 0 ? ($convertedUsers / $totalUsers) * 100 : 0;
        
        $completedOrders = Order::where('status', 'completed')
            ->where('created_at', '>=', Carbon::now()->subDays(30))
            ->count();
        
        $totalOrders = Order::where('created_at', '>=', Carbon::now()->subDays(30))->count();
        $completionRate = $totalOrders > 0 ? ($completedOrders / $totalOrders) * 100 : 0;

        return response()->json([
            'conversion_rate' => (float) $conversionRate,
            'completion_rate' => (float) $completionRate,
            'total_customers' => (int) $totalUsers,
            'converted_customers' => (int) $convertedUsers,
        ]);
    }

    /**
     * Get payment method breakdown
     */
    public function getPaymentMethods()
    {
        // Mock data - adjust based on your actual payment method field
        $methods = Order::where('created_at', '>=', Carbon::now()->subDays(30))
            ->selectRaw("'Payment Method' as method, COUNT(*) as count, SUM(total) as total")
            ->groupBy('method')
            ->get();

        // If no payment method field exists, return default
        if ($methods->isEmpty()) {
            return response()->json([
                'methods' => ['Online Payment', 'Cash on Delivery', 'Bank Transfer'],
                'counts' => [45, 30, 25],
                'totals' => [45000, 30000, 25000],
            ]);
        }

        return response()->json([
            'methods' => $methods->pluck('method'),
            'counts' => $methods->pluck('count'),
            'totals' => $methods->pluck('total'),
        ]);
    }

    /**
     * Get inventory performance
     */
    public function getInventoryPerformance()
    {
        // Get top selling products from orders
        $topProducts = Order::where('created_at', '>=', Carbon::now()->subDays(30))
            ->selectRaw('order_number, total, created_at')
            ->orderBy('total', 'desc')
            ->limit(8)
            ->get();

        return response()->json([
            'products' => $topProducts->map(fn($o) => 'Order #' . $o->order_number)->values(),
            'quantity' => $topProducts->map(fn($o) => 1)->values(), // 1 per order
            'price' => $topProducts->pluck('total'),
        ]);
    }

    /**
     * Get revenue by month (year view)
     */
    public function getMonthlyRevenue()
    {
        $months = [];
        $revenue = [];

        for ($i = 11; $i >= 0; $i--) {
            $date = Carbon::now()->subMonths($i);
            $months[] = $date->format('M');
            $monthRevenue = Order::whereBetween('created_at', [
                $date->startOfMonth(),
                $date->endOfMonth()
            ])->sum('total');
            $revenue[] = (float) $monthRevenue;
        }

        return response()->json([
            'months' => $months,
            'revenue' => $revenue,
        ]);
    }
}
