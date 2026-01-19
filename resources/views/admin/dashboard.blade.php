<x-admin-layout>
    @section('page-title', 'Dashboard')

    <!-- Breadcrumb -->
    <x-admin.breadcrumb :items="[
        ['label' => 'Dashboard']
    ]" />

    <!-- Page Header -->
    <x-admin.page-header title="Dashboard Overview" subtitle="Welcome back! Here's what's happening with your store today.">
        <x-slot:actions>
            <span class="text-sm font-semibold" style="color: rgba(255, 255, 255, 0.6);">
                📅 {{ now()->format('F d, Y') }}
            </span>
        </x-slot:actions>
    </x-admin.page-header>

    <!-- Top Stats Cards -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
        <!-- Today's Sales -->
        <x-admin.stats-card 
            title="Today's Sales" 
            value="₱{{ number_format($todaysSales, 2) }}"
            subtitle="📦 {{ $todaysOrdersCount }} orders today"
            card-bg="linear-gradient(135deg, #3b82f6 0%, #2563eb 100%)"
            border-color="#60a5fa">
            <x-slot:icon>
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                </svg>
            </x-slot:icon>
        </x-admin.stats-card>

        <!-- Pending Orders -->
        <x-admin.stats-card 
            title="Pending Orders" 
            value="{{ $pendingOrdersCount }}"
            subtitle="⚠️ Awaiting processing"
            card-bg="linear-gradient(135deg, #f59e0b 0%, #d97706 100%)"
            border-color="#fbbf24">
            <x-slot:icon>
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                </svg>
            </x-slot:icon>
        </x-admin.stats-card>

        <!-- Low Stock Alerts -->
        <x-admin.stats-card 
            title="Low Stock Items" 
            value="{{ $lowStockCount }}"
            subtitle="View details"
            card-bg="linear-gradient(135deg, #ef4444 0%, #dc2626 100%)"
            border-color="#f87171">
            <x-slot:icon>
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path>
                </svg>
            </x-slot:icon>
        </x-admin.stats-card>

        <!-- Month's Revenue -->
        <x-admin.stats-card 
            title="Month's Revenue" 
            value="₱{{ number_format($monthsRevenue, 2) }}"
            subtitle="📅 {{ now()->format('F Y') }}"
            card-bg="linear-gradient(135deg, #10b981 0%, #059669 100%)"
            border-color="#34d399">
            <x-slot:icon>
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path>
                </svg>
            </x-slot:icon>
        </x-admin.stats-card>
    </div>

    <!-- Revenue Trend (full width) -->
    <div class="rounded-xl shadow-lg p-6 mb-8" style="background: linear-gradient(135deg, rgba(15, 20, 25, 0.8) 0%, rgba(26, 31, 46, 0.8) 100%); border: 1px solid rgba(255, 255, 255, 0.1);">
        <div class="flex items-center gap-3 mb-6">
            <div class="w-10 h-10 rounded-lg flex items-center justify-center" style="background: linear-gradient(135deg, #3b82f6 0%, #2563eb 100%); border: 1px solid rgba(59, 130, 246, 0.3);">
                <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 12l3-3 3 3 4-4M8 21l4-4 4 4M3 4h18M4 4h16v12a1 1 0 01-1 1H5a1 1 0 01-1-1V4z"></path>
                </svg>
            </div>
            <h3 class="text-lg font-semibold text-white" style="letter-spacing: 0.5px;">Revenue Trend (Last 7 Days)</h3>
        </div>
        <div class="h-96 flex items-center justify-center rounded-lg" style="background: rgba(15, 20, 25, 0.6); border: 1px solid rgba(255, 255, 255, 0.05); height: 28rem;">
            <canvas id="revenueChart" style="width: 100%; height: 100%;"></canvas>
        </div>
    </div>

    <!-- Services & Inventory - Bento Grid Section 2 -->
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6 mb-8">
        <!-- Services Analytics (now spans 2 columns) -->
        <div class="lg:col-span-2 rounded-xl shadow-lg p-6" style="background: linear-gradient(135deg, rgba(15, 20, 25, 0.8) 0%, rgba(26, 31, 46, 0.8) 100%); border: 1px solid rgba(255, 255, 255, 0.1);">
            <div class="flex items-center justify-between mb-4">
                <div class="flex items-center gap-3">
                    <div class="w-10 h-10 rounded-lg flex items-center justify-center" style="background: linear-gradient(135deg, #3b82f6 0%, #2563eb 100%); border: 1px solid rgba(59, 130, 246, 0.3);">
                        <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 3v4M3 5h4m3-2h4m-2-2v4m3-2h4m-2-2v4M5 13v6m-2-3h4m3-3h4m-2-2v4m3-2h4m-2-2v4" />
                        </svg>
                    </div>
                    <div>
                        <h3 class="text-lg font-semibold text-white" style="letter-spacing: 0.5px;">Services Catalog</h3>
                        <p class="text-sm" style="color: rgba(255, 255, 255, 0.6);">Track active offerings and options</p>
                    </div>
                </div>
                <a href="{{ route('admin.services.index') }}" class="text-sm font-semibold px-4 py-2 rounded-lg transition-all duration-300" style="background: rgba(59, 130, 246, 0.1); color: #60a5fa; border: 1px solid rgba(59, 130, 246, 0.2); text-decoration:none;" onmouseover="this.style.background='rgba(59, 130, 246, 0.2)'" onmouseout="this.style.background='rgba(59, 130, 246, 0.1)'">Manage services →</a>
            </div>
            <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
                <div class="p-4 rounded-lg" style="background: linear-gradient(135deg, rgba(15, 20, 25, 0.6) 0%, rgba(26, 31, 46, 0.6) 100%); border: 1px solid rgba(255, 255, 255, 0.1);">
                    <p class="text-sm font-semibold" style="color: rgba(255, 255, 255, 0.6);">Total services</p>
                    <p class="text-3xl font-bold" style="color: #60a5fa;">{{ $servicesTotal }}</p>
                </div>
                <div class="p-4 rounded-lg" style="background: linear-gradient(135deg, #3b82f6 0%, #2563eb 100%); border: 1px solid rgba(59, 130, 246, 0.3);">
                    <p class="text-sm font-semibold text-white">Active</p>
                    <p class="text-3xl font-bold text-white">{{ $servicesActive }}</p>
                </div>
                <div class="p-4 rounded-lg" style="background: linear-gradient(135deg, #10b981 0%, #059669 100%); border: 1px solid rgba(16, 185, 129, 0.3);">
                    <p class="text-sm font-semibold text-white">Options/variants</p>
                    <p class="text-3xl font-bold text-white">{{ $serviceOptionsCount }}</p>
                </div>
            </div>
        </div>

        <!-- Inventory Overview -->
        <div class="rounded-xl shadow-lg p-6" style="background: linear-gradient(135deg, rgba(15, 20, 25, 0.8) 0%, rgba(26, 31, 46, 0.8) 100%); border: 1px solid rgba(255, 255, 255, 0.1);">
            <div class="flex items-center gap-3 mb-6">
                <div class="w-10 h-10 rounded-lg flex items-center justify-center" style="background: linear-gradient(135deg, #3b82f6 0%, #2563eb 100%); border: 1px solid rgba(59, 130, 246, 0.3);">
                    <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path>
                    </svg>
                </div>
                <h3 class="text-lg font-semibold text-white" style="letter-spacing: 0.5px;">Inventory Status</h3>
            </div>
            <div class="space-y-4">
                <!-- Total Products -->
                <div class="flex items-center justify-between p-4 rounded-lg transition-all duration-300" style="background: linear-gradient(135deg, rgba(15, 20, 25, 0.6) 0%, rgba(26, 31, 46, 0.6) 100%); border: 1px solid rgba(255, 255, 255, 0.1);" onmouseover="this.style.borderColor='rgba(59, 130, 246, 0.5)'" onmouseout="this.style.borderColor='rgba(255, 255, 255, 0.1)'">
                    <span class="text-sm font-semibold" style="color: rgba(255, 255, 255, 0.6);">Total Products</span>
                    <span class="text-2xl font-bold text-white">{{ $totalProducts }}</span>
                </div>

                <!-- In Stock -->
                <div class="flex items-center justify-between p-4 rounded-lg transition-all duration-300" style="background: linear-gradient(135deg, #10b981 0%, #059669 100%); border: 1px solid rgba(16, 185, 129, 0.3);" onmouseover="this.style.boxShadow='0 4px 12px rgba(16, 185, 129, 0.4)'" onmouseout="this.style.boxShadow='none'">
                    <span class="text-sm font-semibold text-white">In Stock</span>
                    <span class="text-2xl font-bold text-white">{{ $inStockProducts }}</span>
                </div>

                <!-- Out of Stock -->
                <div class="flex items-center justify-between p-4 rounded-lg transition-all duration-300" style="background: linear-gradient(135deg, #ef4444 0%, #dc2626 100%); border: 1px solid rgba(239, 68, 68, 0.3);" onmouseover="this.style.boxShadow='0 4px 12px rgba(239, 68, 68, 0.4)'" onmouseout="this.style.boxShadow='none'">
                    <span class="text-sm font-semibold text-white">Out of Stock</span>
                    <span class="text-2xl font-bold text-white">{{ $outOfStockProducts }}</span>
                </div>

                <!-- Stock Health -->
                <div class="mt-4 pt-4" style="border-top: 1px solid rgba(255, 255, 255, 0.1);">
                    <div class="w-full rounded-full h-3" style="background: rgba(15, 20, 25, 0.6);">
                        <div 
                            class="h-3 rounded-full transition-all duration-500" 
                            style="background: linear-gradient(90deg, #3b82f6 0%, #60a5fa 100%); width: {{ $totalProducts > 0 ? ($inStockProducts / $totalProducts * 100) : 0 }}%; box-shadow: 0 0 10px rgba(59, 130, 246, 0.5);"
                        ></div>
                    </div>
                    <p class="text-sm mt-3 font-semibold" style="color: rgba(255, 255, 255, 0.6);">
                        📦 {{ $totalProducts > 0 ? round(($inStockProducts / $totalProducts * 100), 1) : 0 }}% of inventory in stock
                    </p>
                </div>
            </div>
        </div>
    </div>

    <!-- Customer Insights & Low Stock Alert - Bento Grid Section 3 -->
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6 mb-8">
        <!-- Customer Insights -->
        <div class="rounded-xl shadow-lg p-6" style="background: linear-gradient(135deg, rgba(15, 20, 25, 0.8) 0%, rgba(26, 31, 46, 0.8) 100%); border: 1px solid rgba(255, 255, 255, 0.1);">
            <div class="flex items-center gap-3 mb-6">
                <div class="w-10 h-10 rounded-lg flex items-center justify-center" style="background: linear-gradient(135deg, #3b82f6 0%, #2563eb 100%); border: 1px solid rgba(59, 130, 246, 0.3);">
                    <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path>
                    </svg>
                </div>
                <h3 class="text-lg font-semibold text-white" style="letter-spacing: 0.5px;">Customer Insights</h3>
            </div>
            <div class="space-y-4">
                <div class="p-4 rounded-lg transition-all duration-300" style="background: linear-gradient(135deg, #3b82f6 0%, #2563eb 100%); border: 1px solid rgba(59, 130, 246, 0.3);" onmouseover="this.style.boxShadow='0 4px 12px rgba(59, 130, 246, 0.4)'; this.style.transform='translateY(-2px)'" onmouseout="this.style.boxShadow='none'; this.style.transform='translateY(0)'">
                    <div class="flex items-center gap-3 mb-2">
                        <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path>
                        </svg>
                        <span class="text-sm font-semibold text-white" style="letter-spacing: 0.3px;">Total Customers</span>
                    </div>
                    <p class="text-3xl font-bold text-white">{{ $totalCustomers }}</p>
                </div>

                <div class="p-4 rounded-lg transition-all duration-300" style="background: linear-gradient(135deg, #10b981 0%, #059669 100%); border: 1px solid rgba(16, 185, 129, 0.3);" onmouseover="this.style.boxShadow='0 4px 12px rgba(16, 185, 129, 0.4)'; this.style.transform='translateY(-2px)'" onmouseout="this.style.boxShadow='none'; this.style.transform='translateY(0)'">
                    <div class="flex items-center gap-3 mb-2">
                        <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z"></path>
                        </svg>
                        <span class="text-sm font-semibold text-white" style="letter-spacing: 0.3px;">New This Month</span>
                    </div>
                    <p class="text-3xl font-bold text-white">{{ $newCustomersThisMonth }}</p>
                </div>

                <div class="p-4 rounded-lg transition-all duration-300" style="background: linear-gradient(135deg, #8b5cf6 0%, #7c3aed 100%); border: 1px solid rgba(139, 92, 246, 0.3);" onmouseover="this.style.boxShadow='0 4px 12px rgba(139, 92, 246, 0.4)'; this.style.transform='translateY(-2px)'" onmouseout="this.style.boxShadow='none'; this.style.transform='translateY(0)'">
                    <div class="flex items-center gap-3 mb-2">
                        <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"></path>
                        </svg>
                        <span class="text-sm font-semibold text-white" style="letter-spacing: 0.3px;">Active (30 days)</span>
                    </div>
                    <p class="text-3xl font-bold text-white">{{ $activeCustomers }}</p>
                </div>
            </div>
        </div>

        <!-- Low Stock Alert Widget -->
        <div class="lg:col-span-2 rounded-xl shadow-lg p-6" style="background: linear-gradient(135deg, #ef4444 0%, #dc2626 100%); border: 1px solid rgba(239, 68, 68, 0.3);">
            <div class="flex items-center justify-between mb-6">
                <div class="flex items-center gap-3">
                    <div class="w-12 h-12 rounded-lg flex items-center justify-center" style="background: rgba(255, 255, 255, 0.2); border: 1px solid rgba(255, 255, 255, 0.3);">
                        <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path>
                        </svg>
                    </div>
                    <h3 class="text-lg font-semibold text-white" style="letter-spacing: 0.5px;">⚠️ Low Stock Alert</h3>
                </div>
                <a href="{{ route('admin.inventory.index') }}" class="text-sm font-semibold px-5 py-2.5 rounded-lg transition-all duration-300" style="background: rgba(255, 255, 255, 0.2); color: white; border: 1px solid rgba(255, 255, 255, 0.3); text-decoration: none;" onmouseover="this.style.background='rgba(255, 255, 255, 0.3)'; this.style.transform='translateX(4px)'" onmouseout="this.style.background='rgba(255, 255, 255, 0.2)'; this.style.transform='translateX(0)'">Manage Inventory →</a>
            </div>

            @if($lowStockProducts->count() > 0)
                <div class="grid grid-cols-1 md:grid-cols-2 gap-3 max-h-64 overflow-y-auto" style="scrollbar-width: thin; scrollbar-color: rgba(255, 255, 255, 0.3) transparent;">
                    @foreach($lowStockProducts as $product)
                        <div class="flex items-center gap-3 p-3 rounded-lg transition-all duration-300" style="background: rgba(0, 0, 0, 0.3); border: 1px solid rgba(255, 255, 255, 0.2);" onmouseover="this.style.background='rgba(0, 0, 0, 0.5)'; this.style.borderColor='rgba(255, 255, 255, 0.4)'; this.style.transform='translateX(4px)'" onmouseout="this.style.background='rgba(0, 0, 0, 0.3)'; this.style.borderColor='rgba(255, 255, 255, 0.2)'; this.style.transform='translateX(0)'">
                            @if($product->image_path)
                                <img src="{{ $product->image_url }}" alt="{{ $product->name }}" class="w-14 h-14 rounded-lg object-cover" style="border: 1px solid rgba(255, 255, 255, 0.3);">
                            @else
                                <div class="w-14 h-14 rounded-lg flex items-center justify-center" style="background: rgba(255, 255, 255, 0.15); border: 1px solid rgba(255, 255, 255, 0.3);">
                                    <svg class="w-7 h-7 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path>
                                    </svg>
                                </div>
                            @endif
                            <div class="flex-1 min-w-0">
                                <p class="font-semibold text-white text-sm truncate">{{ $product->name }}</p>
                                <div class="flex items-center gap-2 mt-1">
                                    <span class="text-xs font-bold px-2.5 py-1 rounded" style="background: rgba(255, 255, 255, 0.25); color: white;">{{ $product->current_stock }} left</span>
                                    <span class="text-xs" style="color: rgba(255, 255, 255, 0.7);">Threshold: {{ $product->low_stock_threshold }}</span>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            @else
                <div class="text-center py-8">
                    <svg class="w-16 h-16 mx-auto mb-3 text-white opacity-30" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                    <p class="text-white font-semibold text-lg">All products are well stocked!</p>
                    <p class="text-sm mt-2" style="color: rgba(255, 255, 255, 0.7);">No low stock alerts at the moment</p>
                </div>
            @endif
        </div>
    </div>

    <!-- Top Selling Products & Recent Orders - Bento Grid Section 4 -->
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
        <!-- Top Selling Products -->
        <div class="rounded-xl shadow-lg p-6" style="background: linear-gradient(135deg, rgba(15, 20, 25, 0.8) 0%, rgba(26, 31, 46, 0.8) 100%); border: 1px solid rgba(255, 255, 255, 0.1);">
            <div class="flex items-center justify-between mb-6">
                <div class="flex items-center gap-3">
                    <div class="w-10 h-10 rounded-lg flex items-center justify-center" style="background: linear-gradient(135deg, #3b82f6 0%, #2563eb 100%); border: 1px solid rgba(59, 130, 246, 0.3);">
                        <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"></path>
                        </svg>
                    </div>
                    <h3 class="text-lg font-semibold text-white" style="letter-spacing: 0.5px;">📈 Top Selling Products</h3>
                </div>
            </div>

            @if ($topProducts->count() > 0)
                <div class="space-y-3">
                    @foreach ($topProducts as $item)
                        @if ($item->product)
                        <div class="flex items-center gap-4 p-4 rounded-lg transition-all duration-300" style="background: linear-gradient(135deg, rgba(15, 20, 25, 0.6) 0%, rgba(26, 31, 46, 0.6) 100%); border: 1px solid rgba(255, 255, 255, 0.1);" onmouseover="this.style.borderColor='rgba(59, 130, 246, 0.5)'; this.style.boxShadow='0 4px 12px rgba(59, 130, 246, 0.3)'; this.style.transform='translateX(4px)'" onmouseout="this.style.borderColor='rgba(255, 255, 255, 0.1)'; this.style.boxShadow='none'; this.style.transform='translateX(0)'">
                            <div class="flex-1 min-w-0">
                                <p class="font-semibold text-white text-base truncate">{{ optional($item->product)->name ?? $item->product_name ?? 'Product' }}</p>
                                <p class="text-sm mt-1" style="color: rgba(255, 255, 255, 0.6);">📦 {{ $item->order_count }} orders</p>
                            </div>
                            <div class="text-right flex-shrink-0">
                                <p class="font-bold text-lg" style="color: #60a5fa;">₱{{ number_format($item->revenue, 2) }}</p>
                            </div>
                        </div>
                        @endif
                    @endforeach
                </div>
            @else
                <div class="text-center py-8">
                    <p class="text-lg font-semibold" style="color: rgba(255, 255, 255, 0.6);">No sales yet</p>
                </div>
            @endif
        </div>

        <!-- Recent Orders -->
        <div class="rounded-xl shadow-lg p-6" style="background: linear-gradient(135deg, rgba(15, 20, 25, 0.8) 0%, rgba(26, 31, 46, 0.8) 100%); border: 1px solid rgba(255, 255, 255, 0.1);">
            <div class="flex items-center justify-between mb-6">
                <div class="flex items-center gap-3">
                    <div class="w-10 h-10 rounded-lg flex items-center justify-center" style="background: linear-gradient(135deg, #3b82f6 0%, #2563eb 100%); border: 1px solid rgba(59, 130, 246, 0.3);">
                        <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"></path>
                        </svg>
                    </div>
                    <h3 class="text-lg font-semibold text-white" style="letter-spacing: 0.5px;">📝 Recent Orders</h3>
                </div>
                <a href="{{ route('admin.orders.index') }}" class="text-sm font-semibold transition-all duration-300" style="color: #60a5fa; text-decoration: none;" onmouseover="this.style.color='#ffffff'; this.style.textDecoration='underline'" onmouseout="this.style.color='#60a5fa'; this.style.textDecoration='none'">View all →</a>
            </div>

            @if ($recentOrders->count() > 0)
                <div class="space-y-3">
                    @foreach ($recentOrders as $order)
                        <a href="{{ route('admin.orders.show', $order) }}" class="block p-4 rounded-lg transition-all duration-300" style="background: linear-gradient(135deg, rgba(15, 20, 25, 0.6) 0%, rgba(26, 31, 46, 0.6) 100%); border: 1px solid rgba(255, 255, 255, 0.1); text-decoration: none;" onmouseover="this.style.borderColor='rgba(59, 130, 246, 0.5)'; this.style.boxShadow='0 4px 12px rgba(59, 130, 246, 0.3)'; this.style.transform='translateX(4px)'" onmouseout="this.style.borderColor='rgba(255, 255, 255, 0.1)'; this.style.boxShadow='none'; this.style.transform='translateX(0)'">
                            <div class="flex items-center justify-between mb-3">
                                <div class="flex-1">
                                    <p class="font-semibold text-base" style="color: #60a5fa;">{{ $order->order_number }}</p>
                                    <p class="text-sm mt-1" style="color: rgba(255, 255, 255, 0.6);">👤 {{ $order->customer->name }}</p>
                                </div>
                                <x-badge :status="$order->status" size="sm" />
                            </div>
                            <div class="flex items-center justify-between text-sm pt-2" style="border-top: 1px solid rgba(255, 255, 255, 0.1);">
                                <p style="color: rgba(255, 255, 255, 0.6);">📅 {{ $order->created_at->diffForHumans() }}</p>
                                <p class="font-bold text-base" style="color: #60a5fa;">₱{{ number_format($order->total, 2) }}</p>
                            </div>
                        </a>
                    @endforeach
                </div>
            @else
                <div class="text-center py-8">
                    <p class="text-lg font-semibold" style="color: rgba(255, 255, 255, 0.6);">No orders yet</p>
                </div>
            @endif
        </div>
    </div>

    <!-- Chart.js Library & Script -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js@3.9.1/dist/chart.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const ctx = document.getElementById('revenueChart').getContext('2d');
            
            new Chart(ctx, {
                type: 'line',
                data: {
                    labels: {!! $revenueLabels !!},
                    datasets: [{
                        label: 'Revenue',
                        data: {!! $revenueData !!},
                        borderColor: '#0f6fdd',
                        backgroundColor: 'rgba(15, 111, 221, 0.15)',
                        tension: 0.4,
                        fill: true,
                        pointBackgroundColor: '#00d9ff',
                        pointBorderColor: '#0f1419',
                        pointBorderWidth: 3,
                        pointRadius: 6,
                        pointHoverRadius: 8,
                        pointHoverBackgroundColor: '#00d9ff',
                        pointHoverBorderColor: '#ffffff',
                        borderWidth: 3,
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: {
                        legend: {
                            display: false,
                        },
                        tooltip: {
                            backgroundColor: 'rgba(15, 20, 25, 0.95)',
                            titleColor: '#00d9ff',
                            bodyColor: '#ffffff',
                            borderColor: '#2a3f5f',
                            borderWidth: 2,
                            padding: 12,
                            displayColors: false,
                            callbacks: {
                                label: function(context) {
                                    return 'Revenue: ₱' + context.parsed.y.toLocaleString();
                                }
                            }
                        }
                    },
                    scales: {
                        y: {
                            beginAtZero: true,
                            grid: {
                                color: 'rgba(42, 63, 95, 0.3)',
                                drawBorder: true,
                                borderColor: '#2a3f5f'
                            },
                            ticks: {
                                color: '#b0bcc4',
                                font: {
                                    size: 12,
                                    weight: '600'
                                },
                                callback: function(value) {
                                    return '₱' + value.toLocaleString();
                                }
                            }
                        },
                        x: {
                            grid: {
                                color: 'rgba(42, 63, 95, 0.2)',
                            },
                            ticks: {
                                color: '#b0bcc4',
                                font: {
                                    size: 12,
                                    weight: '600'
                                }
                            }
                        }
                    }
                }
            });
        });
    </script>
</x-admin-layout>
