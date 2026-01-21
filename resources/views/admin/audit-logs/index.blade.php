<x-admin-layout>
    @section('page-title', 'Audit Logs')

    <!-- Breadcrumb -->
    <x-admin.breadcrumb :items="[
        ['label' => 'System'],
        ['label' => 'Audit Logs']
    ]" />

    <!-- Page Header -->
    <x-admin.page-header title="Audit Logs" subtitle="Track all system changes, deletions, and updates" />

    <!-- Filter Section -->
    <x-admin.filter-bar action="{{ route('admin.audit-logs.index') }}">
        <div class="grid grid-cols-1 md:grid-cols-3 gap-4 w-full">
            <!-- Action Filter -->
            <div>
                <label class="block text-sm font-semibold mb-2" style="color: rgba(255, 255, 255, 0.6);">Action</label>
                <select name="action" class="w-full px-4 py-2.5 rounded-xl text-white focus:outline-none transition-all" 
                        style="border: 1px solid rgba(255, 255, 255, 0.1); background: rgba(15, 20, 25, 0.6);" 
                        onfocus="this.style.borderColor='#3b82f6'; this.style.background='rgba(15, 20, 25, 0.8)'" 
                        onblur="this.style.borderColor='rgba(255, 255, 255, 0.1)'; this.style.background='rgba(15, 20, 25, 0.6)'">
                    <option value="">All Actions</option>
                    <option value="create" {{ request('action') === 'create' ? 'selected' : '' }}>Create</option>
                    <option value="update" {{ request('action') === 'update' ? 'selected' : '' }}>Update</option>
                    <option value="delete" {{ request('action') === 'delete' ? 'selected' : '' }}>Delete</option>
                </select>
            </div>

            <!-- Model Filter -->
            <div>
                <label class="block text-sm font-semibold mb-2" style="color: rgba(255, 255, 255, 0.6);">Model</label>
                <select name="model" class="w-full px-4 py-2.5 rounded-xl text-white focus:outline-none transition-all" 
                        style="border: 1px solid rgba(255, 255, 255, 0.1); background: rgba(15, 20, 25, 0.6);" 
                        onfocus="this.style.borderColor='#3b82f6'; this.style.background='rgba(15, 20, 25, 0.8)'" 
                        onblur="this.style.borderColor='rgba(255, 255, 255, 0.1)'; this.style.background='rgba(15, 20, 25, 0.6)'">
                    <option value="">All Models</option>
                    @foreach($models as $model)
                        <option value="{{ $model }}" {{ request('model') === $model ? 'selected' : '' }}>{{ $model }}</option>
                    @endforeach
                </select>
            </div>

            <!-- Search -->
            <div>
                <label class="block text-sm font-semibold mb-2" style="color: rgba(255, 255, 255, 0.6);">User</label>
                <input type="text" name="search" value="{{ request('search') }}" placeholder="Search by user..." 
                       class="w-full px-4 py-2.5 rounded-xl text-white focus:outline-none transition-all"
                       style="border: 1px solid rgba(255, 255, 255, 0.1); background: rgba(15, 20, 25, 0.6);" 
                       onfocus="this.style.borderColor='#3b82f6'; this.style.background='rgba(15, 20, 25, 0.8)'" 
                       onblur="this.style.borderColor='rgba(255, 255, 255, 0.1)'; this.style.background='rgba(15, 20, 25, 0.6)'" />
            </div>
        </div>

        <div class="flex gap-2">
            <x-admin.button type="submit" variant="primary">Filter</x-admin.button>
            <x-admin.button href="{{ route('admin.audit-logs.index') }}" variant="secondary">Clear</x-admin.button>
        </div>
    </x-admin.filter-bar>

    <!-- Audit Logs Table -->
    <div class="rounded-xl shadow-lg overflow-hidden" 
         style="background: linear-gradient(135deg, rgba(15, 20, 25, 0.8) 0%, rgba(26, 31, 46, 0.8) 100%); 
                border: 1px solid rgba(255, 255, 255, 0.1);">
        <div class="overflow-x-auto">
            <table class="w-full">
                <thead>
                    <tr style="background: linear-gradient(135deg, #3b82f6 0%, #2563eb 100%); border-bottom: 2px solid rgba(255, 255, 255, 0.1);">
                        <th class="px-6 py-4 text-left text-sm font-bold text-white">Date/Time</th>
                        <th class="px-6 py-4 text-left text-sm font-bold text-white">User</th>
                        <th class="px-6 py-4 text-left text-sm font-bold text-white">Action</th>
                        <th class="px-6 py-4 text-left text-sm font-bold text-white">Model</th>
                        <th class="px-6 py-4 text-left text-sm font-bold text-white">ID</th>
                        <th class="px-6 py-4 text-center text-sm font-bold text-white">Details</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($logs as $log)
                        <tr class="transition-all duration-200" 
                            style="border-bottom: 1px solid rgba(255, 255, 255, 0.05);" 
                            onmouseover="this.style.background='rgba(59, 130, 246, 0.1)'" 
                            onmouseout="this.style.background='transparent'">
                            <td class="px-6 py-4" style="color: rgba(255, 255, 255, 0.6);">{{ $log->created_at->format('M d, Y H:i:s') }}</td>
                            <td class="px-6 py-4 text-white font-semibold">{{ $log->user->name ?? 'System' }}</td>
                            <td class="px-6 py-4">
                                @php
                                    $actionStyles = match($log->action) {
                                        'create' => 'background: linear-gradient(135deg, #10b981 0%, #059669 100%); color: white;',
                                        'update' => 'background: linear-gradient(135deg, #f59e0b 0%, #d97706 100%); color: white;',
                                        'delete' => 'background: linear-gradient(135deg, #ef4444 0%, #dc2626 100%); color: white;',
                                        default => 'background: linear-gradient(135deg, #6b7280 0%, #4b5563 100%); color: white;'
                                    };
                                @endphp
                                <span class="px-3 py-1.5 rounded-lg text-xs font-bold inline-block" style="{{ $actionStyles }}">
                                    {{ ucfirst($log->action) }}
                                </span>
                            </td>
                            <td class="px-6 py-4 text-white font-semibold">{{ $log->model_type }}</td>
                            <td class="px-6 py-4" style="color: rgba(255, 255, 255, 0.6);">#{{ $log->model_id }}</td>
                            <td class="px-6 py-4 text-center">
                                <x-admin.button 
                                    href="{{ route('admin.audit-logs.show', $log) }}" 
                                    size="sm" 
                                    variant="primary">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                                    </svg>
                                    View
                                </x-admin.button>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="px-6 py-12 text-center">
                                <svg class="w-16 h-16 mx-auto mb-4 opacity-30" style="color: rgba(255, 255, 255, 0.3);" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                                </svg>
                                <p class="text-lg font-semibold" style="color: rgba(255, 255, 255, 0.6);">No audit logs found</p>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <!-- Pagination -->
    @if($logs->hasPages())
        <div class="mt-6">
            <div class="flex items-center justify-between px-6 py-4 rounded-xl" style="background: linear-gradient(135deg, rgba(15, 20, 25, 0.8) 0%, rgba(26, 31, 46, 0.8) 100%); border: 1px solid rgba(255, 255, 255, 0.1);">
                <div style="color: rgba(255, 255, 255, 0.7);">
                    Showing <span class="font-semibold text-white">{{ $logs->firstItem() }}</span> to <span class="font-semibold text-white">{{ $logs->lastItem() }}</span> of <span class="font-semibold text-white">{{ $logs->total() }}</span> entries
                </div>
                <div>
                    {{ $logs->links() }}
                </div>
            </div>
        </div>
    @endif
</x-admin-layout>
