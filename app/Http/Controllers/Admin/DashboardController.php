<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Product;
use App\Models\OrderItem;
use App\Models\Service;
use App\Models\ServiceOption;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class DashboardController extends Controller
{
    /**
     * Display the admin dashboard with key metrics and Bento Grid layout.
     *
     * @return \Illuminate\View\View
     */
    public function index(): \Illuminate\View\View
    {
        // Cache key metrics for 2 minutes to reduce database load
        $cacheKey = 'admin_dashboard_metrics_' . date('YmdHi');
        
        $metrics = \Cache::remember($cacheKey, 120, function() {
            $today = Carbon::today();
            $startOfMonth = Carbon::now()->startOfMonth();

            // Use single query for today's orders
            $todaysOrders = Order::whereDate('created_at', $today)
                ->selectRaw("COUNT(*) as count, SUM(CASE WHEN status != 'cancelled' THEN total ELSE 0 END) as sales")
                ->first();

            return [
                'todaysSales' => $todaysOrders->sales ?? 0,
                'todaysOrdersCount' => $todaysOrders->count ?? 0,
                'pendingOrdersCount' => Order::where('status', 'pending')->count(),
                'lowStockCount' => Product::whereRaw('current_stock <= low_stock_threshold')->count(),
                'monthsRevenue' => Order::whereBetween('created_at', [$startOfMonth, now()])
                    ->where('status', '!=', 'cancelled')
                    ->sum('total'),
                'totalCustomers' => Order::distinct('user_id')->count('user_id'),
            ];
        });
        
        $today = Carbon::today();
        $startOfMonth = Carbon::now()->startOfMonth();
        
        $todaysSales = $metrics['todaysSales'];
        $todaysOrdersCount = $metrics['todaysOrdersCount'];
        $pendingOrdersCount = $metrics['pendingOrdersCount'];
        $lowStockCount = $metrics['lowStockCount'];

        $monthsRevenue = $metrics['monthsRevenue'];
        $totalCustomers = $metrics['totalCustomers'];

        // ========================================================================
        // REVENUE CHART DATA (Last 7 Days) - Cached
        // ========================================================================
        $chartData = \Cache::remember('admin_revenue_chart_' . date('Ymd'), 300, function() {
            $revenueData = [];
            $labels = [];
            
            // Single query for all 7 days
            $startDate = Carbon::now()->subDays(6)->startOfDay();
            $revenues = Order::where('created_at', '>=', $startDate)
                ->where('status', '!=', 'cancelled')
                ->selectRaw('DATE(created_at) as date, SUM(total) as total')
                ->groupBy('date')
                ->pluck('total', 'date');
            
            for ($i = 6; $i >= 0; $i--) {
                $date = Carbon::now()->subDays($i);
                $dayLabel = $date->format('M d');
                $dateKey = $date->format('Y-m-d');
                $labels[] = $dayLabel;
                $revenueData[] = (float)($revenues[$dateKey] ?? 0);
            }
            
            return compact('labels', 'revenueData');
        });
        
        $labels = $chartData['labels'];
        $revenueData = $chartData['revenueData'];

        // ========================================================================
        // TOP SELLING PRODUCTS - Cached 5 min
        // ========================================================================
        $topProducts = \Cache::remember('admin_top_products', 300, function() {
            return OrderItem::select('product_id', DB::raw('COUNT(*) as order_count'), DB::raw('SUM(total_price) as revenue'))
                ->groupBy('product_id')
                ->orderBy('order_count', 'desc')
                ->with('product:id,name,base_price')
                ->limit(5)
                ->get()
                ->filter(fn ($item) => $item->product !== null);
        });

        // ========================================================================
        // RECENT ORDERS - Not cached (real-time)
        // ========================================================================
        $recentOrders = Order::with('customer:id,name,email')
            ->select('id', 'order_number', 'user_id', 'status', 'total', 'created_at')
            ->orderBy('created_at', 'desc')
            ->limit(5)
            ->get();

        // ========================================================================
        // INVENTORY STATS - Cached 3 min
        // ========================================================================
        $inventoryStats = \Cache::remember('admin_inventory_stats', 180, function() {
            $stats = Product::selectRaw('
                COUNT(*) as total,
                SUM(CASE WHEN current_stock > 0 THEN 1 ELSE 0 END) as in_stock,
                SUM(CASE WHEN current_stock = 0 THEN 1 ELSE 0 END) as out_of_stock
            ')->first();
            
            return [
                'totalProducts' => $stats->total,
                'inStockProducts' => $stats->in_stock,
                'outOfStockProducts' => $stats->out_of_stock,
            ];
        });
        
        $totalProducts = $inventoryStats['totalProducts'];
        $inStockProducts = $inventoryStats['inStockProducts'];
        $outOfStockProducts = $inventoryStats['outOfStockProducts'];

        // Low Stock Products
        $lowStockProducts = Product::select('id', 'name', 'current_stock', 'low_stock_threshold')
            ->whereRaw('current_stock <= low_stock_threshold')
            ->where('current_stock', '>', 0)
            ->orderBy('current_stock', 'asc')
            ->limit(10)
            ->get();

        // ========================================================================
        // CUSTOMER & SERVICES - Cached 5 min
        // ========================================================================
        $customerAndServices = \Cache::remember('admin_customer_services_' . date('YmdH'), 300, function() use ($startOfMonth) {
            return [
                'newCustomersThisMonth' => \App\Models\User::whereBetween('created_at', [$startOfMonth, now()])
                    ->whereJsonContains('roles', 'customer')
                    ->count(),
                'activeCustomers' => Order::whereBetween('created_at', [Carbon::now()->subDays(30), now()])
                    ->distinct('user_id')
                    ->count('user_id'),
                'servicesTotal' => Service::count(),
                'servicesActive' => Service::where('is_active', '=', true)->count(),
                'serviceOptionsCount' => ServiceOption::count(),
            ];
        });
        
        $newCustomersThisMonth = $customerAndServices['newCustomersThisMonth'];
        $activeCustomers = $customerAndServices['activeCustomers'];
        $servicesTotal = $customerAndServices['servicesTotal'];
        $servicesActive = $customerAndServices['servicesActive'];
        $serviceOptionsCount = $customerAndServices['serviceOptionsCount'];

        return view('admin.dashboard', [
            // Metrics
            'todaysSales' => $todaysSales,
            'todaysOrdersCount' => $todaysOrdersCount,
            'pendingOrdersCount' => $pendingOrdersCount,
            'lowStockCount' => $lowStockCount,
            'monthsRevenue' => $monthsRevenue,
            'totalCustomers' => $totalCustomers,
            
            // Charts
            'revenueLabels' => json_encode($labels),
            'revenueData' => json_encode($revenueData),
            
            // Lists
            'topProducts' => $topProducts,
            'recentOrders' => $recentOrders,
            'lowStockProducts' => $lowStockProducts,
            
            // Inventory
            'totalProducts' => $totalProducts,
            'inStockProducts' => $inStockProducts,
            'outOfStockProducts' => $outOfStockProducts,

            // Customer Insights
            'newCustomersThisMonth' => $newCustomersThisMonth,
            'activeCustomers' => $activeCustomers,

            // Services
            'servicesTotal' => $servicesTotal,
            'servicesActive' => $servicesActive,
            'serviceOptionsCount' => $serviceOptionsCount,
        ]);
    }
}

