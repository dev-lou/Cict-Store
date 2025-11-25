<x-admin-layout>
    @section('page-title', 'Activity Logs')

    <!-- Header Section -->
    <div class="mb-8">
        <h2 class="text-2xl font-bold text-gray-900">Activity Logs</h2>
        <p class="text-gray-600 mt-1">Track system activities and changes</p>
    </div>

    <!-- Filters -->
    <div class="bg-white rounded-lg border border-gray-200 shadow-sm p-6 mb-6">
        <form method="GET" class="flex gap-4 flex-wrap">
            <input 
                type="text" 
                name="search" 
                placeholder="Search logs..." 
                class="flex-1 min-w-64 px-4 py-2 border-2 border-gray-200 rounded-lg focus:border-blue-500 focus:outline-none"
            >
            <select class="px-4 py-2 border-2 border-gray-200 rounded-lg focus:border-blue-500 focus:outline-none">
                <option>All Actions</option>
                <option>Created</option>
                <option>Updated</option>
                <option>Deleted</option>
                <option>Login</option>
            </select>
            <x-button type="submit" variant="primary">Filter</x-button>
        </form>
    </div>

    <!-- Activity Timeline -->
    <div class="space-y-4">
        @for ($i = 0; $i < 5; $i++)
            <div class="bg-white rounded-lg border border-gray-200 shadow-sm p-6 hover:shadow-md transition-shadow">
                <div class="flex items-start gap-4">
                    <!-- Timeline Dot -->
                    <div class="flex-shrink-0 mt-1">
                        <div class="w-3 h-3 bg-blue-600 rounded-full"></div>
                    </div>

                    <!-- Content -->
                    <div class="flex-1 min-w-0">
                        <p class="font-semibold text-gray-900">Product Inventory Updated</p>
                        <p class="text-sm text-gray-600 mt-1">Admin updated stock for "Sample Product" by +50 units</p>
                        <div class="flex items-center gap-4 mt-3">
                            <span class="text-xs font-medium text-gray-500">John Admin</span>
                            <span class="text-xs text-gray-500">{{ now()->subHours($i)->diffForHumans() }}</span>
                        </div>
                    </div>

                    <!-- Action Badge -->
                    <x-badge status="success" size="sm">Updated</x-badge>
                </div>
            </div>
        @endfor
    </div>

    <!-- Pagination -->
    <div class="mt-8 text-center">
        <p class="text-gray-600">Showing 5 of 142 activities</p>
    </div>
</x-admin-layout>
