@props([])

<style>[x-cloak]{display:none!important;}</style>
<aside class="w-full h-full text-white flex flex-col overflow-hidden" style="background: linear-gradient(180deg, #1a1f2e 0%, #0f1419 100%); border-right: 1px solid rgba(255, 255, 255, 0.1);">
    <!-- Logo & Brand -->
    <div class="px-6 py-6 pb-8" style="border-bottom: 1px solid rgba(255, 255, 255, 0.1);">
        <a href="{{ route('admin.dashboard') }}" class="flex items-center gap-4 transition-all duration-200" onmouseover="this.style.opacity='0.8'" onmouseout="this.style.opacity='1'">
            <div class="w-14 h-14 rounded-full overflow-hidden flex-shrink-0" style="background: linear-gradient(135deg, #8B0000 0%, #6B0000 100%); box-shadow: 0 4px 12px rgba(139, 0, 0, 0.3);">
                @php
                    $logoSetting = \App\Models\Setting::where('key', 'site_logo')->first();
                    $logoUrl = $logoSetting && $logoSetting->value 
                        ? asset('storage/' . $logoSetting->value)
                        : null;
                @endphp
                @if($logoUrl)
                    <img src="{{ $logoUrl }}" alt="{{ config('app.name', 'CICT Dingle') }} logo" class="w-full h-full object-cover">
                @endif
            </div>
            <div>
                <p class="font-bold text-white text-xl" style="letter-spacing: 0.3px;">{{ config('app.name', 'CICT Dingle') }}</p>
                <p class="text-sm" style="color: rgba(255, 255, 255, 0.6);">Admin Panel</p>
            </div>
        </a>
    </div>

    <!-- Navigation Links -->
    <nav class="flex-1 px-3 py-4 space-y-1 overflow-y-auto min-h-0" style="scrollbar-width: thin; scrollbar-color: rgba(255,255,255,0.2) transparent;">
        <!-- Section: Overview -->
        <div class="px-3 py-2">
            <p class="text-xs font-semibold uppercase tracking-wider" style="color: rgba(255, 255, 255, 0.4);">Overview</p>
        </div>
        <!-- Dashboard -->
        <a
            href="{{ route('admin.dashboard') }}"
            class="flex items-center gap-3 px-3 py-2.5 rounded-lg text-sm font-medium transition-all duration-200"
            @if(request()->routeIs('admin.dashboard'))
                style="background: linear-gradient(135deg, #8B0000 0%, #6B0000 100%); color: #ffffff;"
            @else
                style="color: rgba(255, 255, 255, 0.7);"
                onmouseover="this.style.backgroundColor='rgba(255, 255, 255, 0.05)'; this.style.color='#ffffff';"
                onmouseout="this.style.backgroundColor='transparent'; this.style.color='rgba(255, 255, 255, 0.7)';"
            @endif
        >
            <svg class="w-5 h-5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-3m0 0l7-4 7 4M5 9v10a1 1 0 001 1h12a1 1 0 001-1V9m-9 4v4m4-4v4m4-12l2 3"></path>
            </svg>
            <span>Dashboard</span>
        </a>

        <!-- Section: Sales & Orders -->
        <div class="px-3 py-2 mt-4">
            <p class="text-xs font-semibold uppercase tracking-wider" style="color: rgba(255, 255, 255, 0.4);">Sales & Orders</p>
        </div>

        <!-- Orders -->
        <div x-data="{ ordersOpen: {{ request()->routeIs('admin.orders.*') ? 'true' : 'false' }} }" class="space-y-1">
            <button
                @click="ordersOpen = !ordersOpen"
                class="w-full flex items-center gap-3 px-3 py-2.5 rounded-lg text-sm font-medium transition-all duration-200"
                style="color: rgba(255, 255, 255, 0.7);"
                onmouseover="this.style.backgroundColor='rgba(255, 255, 255, 0.05)'; this.style.color='#ffffff';"
                onmouseout="this.style.backgroundColor='transparent'; this.style.color='rgba(255, 255, 255, 0.7)';"
            >
                <svg class="w-5 h-5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path>
                </svg>
                <span class="flex-1 text-left">Orders</span>
                @if($pendingOrderCount > 0)
                    <span class="inline-flex items-center justify-center w-5 h-5 rounded-full text-[10px] font-bold leading-none" style="background: #dc2626; color: white;">{{ $pendingOrderCount }}</span>
                @endif
                <svg class="w-4 h-4 transition-transform duration-200" :class="{ 'rotate-180': ordersOpen }" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                </svg>
            </button>

            <div x-show="ordersOpen" x-cloak x-transition class="ml-8 space-y-0.5">
                <a href="{{ route('admin.orders.index') }}" class="block px-3 py-2 rounded-lg text-sm transition-all duration-200" style="@if(request()->routeIs('admin.orders.index') && !request()->routeIs('admin.orders.pending') && !request()->routeIs('admin.orders.processing') && !request()->routeIs('admin.orders.completed'))background: rgba(139, 0, 0, 0.15); color: #ffffff;@else color: rgba(255, 255, 255, 0.6);@endif" onmouseover="this.style.backgroundColor='rgba(255, 255, 255, 0.05)'; this.style.color='#ffffff';" onmouseout="@if(!(request()->routeIs('admin.orders.index') && !request()->routeIs('admin.orders.pending') && !request()->routeIs('admin.orders.processing') && !request()->routeIs('admin.orders.completed')))this.style.backgroundColor='transparent'; this.style.color='rgba(255, 255, 255, 0.6)';@endif">All Orders</a>
                <a href="{{ route('admin.orders.pending') }}" class="flex items-center justify-between px-3 py-2 rounded-lg text-sm transition-all duration-200" style="@if(request()->routeIs('admin.orders.pending'))background: rgba(139, 0, 0, 0.15); color: #ffffff;@else color: rgba(255, 255, 255, 0.6);@endif" onmouseover="this.style.backgroundColor='rgba(255, 255, 255, 0.05)'; this.style.color='#ffffff';" onmouseout="@if(!request()->routeIs('admin.orders.pending'))this.style.backgroundColor='transparent'; this.style.color='rgba(255, 255, 255, 0.6)';@endif">
                    <span>Pending</span>
                    @if($pendingOrderCount > 0)
                        <span class="inline-flex items-center justify-center w-5 h-5 rounded-full text-[10px] font-bold leading-none" style="background: #dc2626; color: white;">{{ $pendingOrderCount }}</span>
                    @endif
                </a>
                <a href="{{ route('admin.orders.processing') }}" class="flex items-center justify-between px-3 py-2 rounded-lg text-sm transition-all duration-200" style="@if(request()->routeIs('admin.orders.processing'))background: rgba(139, 0, 0, 0.15); color: #ffffff;@else color: rgba(255, 255, 255, 0.6);@endif" onmouseover="this.style.backgroundColor='rgba(255, 255, 255, 0.05)'; this.style.color='#ffffff';" onmouseout="@if(!request()->routeIs('admin.orders.processing'))this.style.backgroundColor='transparent'; this.style.color='rgba(255, 255, 255, 0.6)';@endif">
                    <span>Processing</span>
                    @if($processingOrderCount > 0)
                        <span class="inline-flex items-center justify-center w-5 h-5 rounded-full text-[10px] font-bold leading-none" style="background: #dc2626; color: white;">{{ $processingOrderCount }}</span>
                    @endif
                </a>
                <a href="{{ route('admin.orders.completed') }}" class="block px-3 py-2 rounded-lg text-sm transition-all duration-200" style="@if(request()->routeIs('admin.orders.completed'))background: rgba(139, 0, 0, 0.15); color: #ffffff;@else color: rgba(255, 255, 255, 0.6);@endif" onmouseover="this.style.backgroundColor='rgba(255, 255, 255, 0.05)'; this.style.color='#ffffff';" onmouseout="@if(!request()->routeIs('admin.orders.completed'))this.style.backgroundColor='transparent'; this.style.color='rgba(255, 255, 255, 0.6)';@endif">Completed</a>
            </div>
        </div>

        <!-- Buy List -->
        <a
            href="{{ route('admin.buy-list.index') }}"
            class="flex items-center gap-3 px-3 py-2.5 rounded-lg text-sm font-medium transition-all duration-200"
            @if(request()->routeIs('admin.buy-list.*'))
                style="background: linear-gradient(135deg, #8B0000 0%, #6B0000 100%); color: #ffffff;"
            @else
                style="color: rgba(255, 255, 255, 0.7);"
                onmouseover="this.style.backgroundColor='rgba(255, 255, 255, 0.05)'; this.style.color='#ffffff';"
                onmouseout="this.style.backgroundColor='transparent'; this.style.color='rgba(255, 255, 255, 0.7)';"
            @endif
        >
            <svg class="w-5 h-5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"></path>
            </svg>
            <span>Buy List</span>
        </a>

        <!-- Section: Catalog -->
        <div class="px-3 py-2 mt-4">
            <p class="text-xs font-semibold uppercase tracking-wider" style="color: rgba(255, 255, 255, 0.4);">Catalog</p>
        </div>

        <!-- Inventory -->
        <div x-data="{ inventoryOpen: {{ request()->routeIs('admin.inventory.*') ? 'true' : 'false' }} }" class="space-y-1">
            <button
                @click="inventoryOpen = !inventoryOpen"
                class="w-full flex items-center gap-3 px-3 py-2.5 rounded-lg text-sm font-medium transition-all duration-200"
                style="color: rgba(255, 255, 255, 0.7);"
                onmouseover="this.style.backgroundColor='rgba(255, 255, 255, 0.05)'; this.style.color='#ffffff';"
                onmouseout="this.style.backgroundColor='transparent'; this.style.color='rgba(255, 255, 255, 0.7)';"
            >
                <svg class="w-5 h-5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m0 0l8 4m-8-4v10l8 4m0-10l8 4m-8-4v10M7 11l8 4m0-4v10"></path>
                </svg>
                <span class="flex-1 text-left">Inventory</span>
                <svg class="w-4 h-4 transition-transform duration-200" :class="{ 'rotate-180': inventoryOpen }" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                </svg>
            </button>

            <div x-show="inventoryOpen" x-cloak x-transition class="ml-8 space-y-0.5">
                <a href="{{ route('admin.inventory.index') }}" class="block px-3 py-2 rounded-lg text-sm transition-all duration-200" style="@if(request()->routeIs('admin.inventory.index'))background: rgba(139, 0, 0, 0.15); color: #ffffff;@else color: rgba(255, 255, 255, 0.6);@endif" onmouseover="this.style.backgroundColor='rgba(255, 255, 255, 0.05)'; this.style.color='#ffffff';" onmouseout="@if(!request()->routeIs('admin.inventory.index'))this.style.backgroundColor='transparent'; this.style.color='rgba(255, 255, 255, 0.6)';@endif">All Products</a>
                <a href="{{ route('admin.inventory.create') }}" class="block px-3 py-2 rounded-lg text-sm transition-all duration-200" style="@if(request()->routeIs('admin.inventory.create'))background: rgba(139, 0, 0, 0.15); color: #ffffff;@else color: rgba(255, 255, 255, 0.6);@endif" onmouseover="this.style.backgroundColor='rgba(255, 255, 255, 0.05)'; this.style.color='#ffffff';" onmouseout="@if(!request()->routeIs('admin.inventory.create'))this.style.backgroundColor='transparent'; this.style.color='rgba(255, 255, 255, 0.6)';@endif">Add Product</a>
            </div>
        </div>

        <!-- Services -->
        <a
            href="{{ route('admin.services-management.index') }}"
            class="flex items-center gap-3 px-3 py-2.5 rounded-lg text-sm font-medium transition-all duration-200"
            @if(request()->routeIs('admin.services-management.*'))
                style="background: linear-gradient(135deg, #8B0000 0%, #6B0000 100%); color: #ffffff;"
            @else
                style="color: rgba(255, 255, 255, 0.7);"
                onmouseover="this.style.backgroundColor='rgba(255, 255, 255, 0.05)'; this.style.color='#ffffff';"
                onmouseout="this.style.backgroundColor='transparent'; this.style.color='rgba(255, 255, 255, 0.7)';"
            @endif
        >
            <svg class="w-5 h-5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 8h10M7 12h10M7 16h6m4-9V7a2 2 0 00-2-2H7a2 2 0 00-2 2v10a2 2 0 002 2h8"></path>
            </svg>
            <span>Services</span>
        </a>

        <!-- Section: System -->
        <div class="px-3 py-2 mt-4">
            <p class="text-xs font-semibold uppercase tracking-wider" style="color: rgba(255, 255, 255, 0.4);">System</p>
        </div>

        <!-- Users -->
        <a
            href="{{ route('admin.users.index') }}"
            class="flex items-center gap-3 px-3 py-2.5 rounded-lg text-sm font-medium transition-all duration-200"
            @if(request()->routeIs('admin.users.*'))
                style="background: linear-gradient(135deg, #8B0000 0%, #6B0000 100%); color: #ffffff;"
            @else
                style="color: rgba(255, 255, 255, 0.7);"
                onmouseover="this.style.backgroundColor='rgba(255, 255, 255, 0.05)'; this.style.color='#ffffff';"
                onmouseout="this.style.backgroundColor='transparent'; this.style.color='rgba(255, 255, 255, 0.7)';"
            @endif
        >
            <svg class="w-5 h-5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.856-1.487M15 10a3 3 0 11-6 0 3 3 0 016 0zM6 20a6 6 0 1112 0v-2H6v2z"></path>
            </svg>
            <span>Users</span>
        </a>

        <!-- Audit Logs -->
        <a
            href="{{ route('admin.audit-logs.index') }}"
            class="flex items-center gap-3 px-3 py-2.5 rounded-lg text-sm font-medium transition-all duration-200"
            @if(request()->routeIs('admin.audit-logs.*'))
                style="background: linear-gradient(135deg, #8B0000 0%, #6B0000 100%); color: #ffffff;"
            @else
                style="color: rgba(255, 255, 255, 0.7);"
                onmouseover="this.style.backgroundColor='rgba(255, 255, 255, 0.05)'; this.style.color='#ffffff';"
                onmouseout="this.style.backgroundColor='transparent'; this.style.color='rgba(255, 255, 255, 0.7)';"
            @endif
        >
            <svg class="w-5 h-5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
            </svg>
            <span>Audit Logs</span>
        </a>

        <!-- Settings -->
        <a
            href="{{ route('admin.settings.index') }}"
            class="flex items-center gap-3 px-3 py-2.5 rounded-lg text-sm font-medium transition-all duration-200"
            @if(request()->routeIs('admin.settings.*'))
                style="background: linear-gradient(135deg, #8B0000 0%, #6B0000 100%); color: #ffffff;"
            @else
                style="color: rgba(255, 255, 255, 0.7);"
                onmouseover="this.style.backgroundColor='rgba(255, 255, 255, 0.05)'; this.style.color='#ffffff';"
                onmouseout="this.style.backgroundColor='transparent'; this.style.color='rgba(255, 255, 255, 0.7)';"
            @endif
        >
            <svg class="w-5 h-5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"></path>
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
            </svg>
            <span>Settings</span>
        </a>

        <!-- Divider -->
        <div style="border-top: 1px solid rgba(255, 255, 255, 0.1); margin: 1rem 0;"></div>

        <!-- View Customer Site -->
        <a
            href="{{ route('home') }}"
            class="flex items-center gap-3 px-3 py-2.5 rounded-lg text-sm font-medium transition-all duration-200"
            style="color: rgba(255, 255, 255, 0.7); border: 1px solid rgba(255, 255, 255, 0.1);"
            onmouseover="this.style.backgroundColor='rgba(255, 255, 255, 0.05)'; this.style.color='#ffffff'; this.style.borderColor='rgba(255, 255, 255, 0.2)';"
            onmouseout="this.style.backgroundColor='transparent'; this.style.color='rgba(255, 255, 255, 0.7)'; this.style.borderColor='rgba(255, 255, 255, 0.1)';"
        >
            <svg class="w-5 h-5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"></path>
            </svg>
            <span>View Customer Site</span>
        </a>

    </nav>

    <!-- Footer - User Menu -->
    <div class="px-6 py-4 shrink-0" style="border-top: 2px solid #2a3f5f; background: linear-gradient(180deg, #0f1419 0%, #1a1f2e 100%);">
        <!-- User Profile Info with Logout -->
        <div class="flex items-center justify-between gap-3">
            <div class="flex items-center gap-3 flex-1 min-w-0">
                @if(auth()->user()->profile_picture)
                    <img src="{{ asset('storage/' . auth()->user()->profile_picture) }}" alt="Profile" class="w-10 h-10 rounded-full flex-shrink-0 object-cover" style="border: 2px solid #00d9ff; box-shadow: 0 0 12px rgba(0, 217, 255, 0.3);">
                @else
                    <div class="w-10 h-10 rounded-full flex items-center justify-center text-sm font-bold" style="background: linear-gradient(135deg, #0f6fdd 0%, #1a7fff 100%); color: #ffffff; border: 2px solid #00d9ff; box-shadow: 0 0 12px rgba(0, 217, 255, 0.3);">
                        {{ auth()->user()->name[0] ?? 'A' }}
                    </div>
                @endif
                <div class="text-left flex-1 min-w-0">
                    <p class="text-sm font-bold text-white truncate">{{ auth()->user()->name }}</p>
                    <p class="text-xs truncate" style="color: #b0bcc4;">{{ auth()->user()->email }}</p>
                </div>
            </div>

            <!-- Logout Button Icon -->
            <form method="POST" action="{{ route('logout') }}" class="flex-shrink-0">
                @csrf
                <button type="submit" class="p-2 rounded-lg transition-all duration-300" style="background: linear-gradient(135deg, #ff6b6b 0%, #cc0000 100%); color: white;" title="Logout" onmouseover="this.style.boxShadow='0 4px 12px rgba(255, 107, 107, 0.5)'; this.style.transform='scale(1.05)'" onmouseout="this.style.boxShadow='none'; this.style.transform='scale(1)'">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path>
                    </svg>
                </button>
            </form>
        </div>
    </div>
</aside>