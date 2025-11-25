<x-admin-layout>
    @section('page-title', 'Audit Logs')

    <!-- Header Section -->
    <div class="mb-8">
        <div>
            <h2 class="text-3xl font-bold mb-2" style="color: #ffffff; letter-spacing: 0.5px;">Audit Logs</h2>
            <p class="text-sm" style="color: #b0bcc4;">Track all system changes, deletions, and updates</p>
        </div>
    </div>

    <!-- Filter Section -->
    <div class="rounded-xl shadow-lg p-6 mb-6" style="background: linear-gradient(135deg, #1a1f2e 0%, #0f1419 100%); border: 2px solid #b0bcc4; border-radius: 16px;">
        <form method="GET" action="{{ route('admin.audit-logs.index') }}" class="space-y-4">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                <!-- Action Filter -->
                <div>
                    <label style="color: #b0bcc4; font-weight: 600;" class="block mb-2">Action</label>
                    <select name="action" class="w-full rounded-lg px-4 py-2" style="border: 2px solid #b0bcc4; background-color: #0f1419; color: #b0bcc4;">
                        <option value="">All Actions</option>
                        <option value="create" {{ request('action') === 'create' ? 'selected' : '' }}>Create</option>
                        <option value="update" {{ request('action') === 'update' ? 'selected' : '' }}>Update</option>
                        <option value="delete" {{ request('action') === 'delete' ? 'selected' : '' }}>Delete</option>
                    </select>
                </div>

                <!-- Model Filter -->
                <div>
                    <label style="color: #b0bcc4; font-weight: 600;" class="block mb-2">Model</label>
                    <select name="model" class="w-full rounded-lg px-4 py-2" style="border: 2px solid #b0bcc4; background-color: #0f1419; color: #b0bcc4;">
                        <option value="">All Models</option>
                        @foreach($models as $model)
                            <option value="{{ $model }}" {{ request('model') === $model ? 'selected' : '' }}>{{ $model }}</option>
                        @endforeach
                    </select>
                </div>

                <!-- Search -->
                <div>
                    <label style="color: #b0bcc4; font-weight: 600;" class="block mb-2">User</label>
                    <input type="text" name="search" value="{{ request('search') }}" placeholder="Search by user..." class="w-full rounded-lg px-4 py-2" style="border: 2px solid #b0bcc4; background-color: #0f1419; color: #b0bcc4;" />
                </div>
            </div>

            <div class="flex gap-2">
                <button type="submit" class="px-6 py-2 rounded-lg font-bold" style="background-color: #0f6fdd; color: #ffffff; border: 2px solid #b0bcc4;" onmouseover="this.style.backgroundColor='#1a7fff'" onmouseout="this.style.backgroundColor='#0f6fdd'">
                    Filter
                </button>
                <a href="{{ route('admin.audit-logs.index') }}" class="px-6 py-2 rounded-lg font-bold" style="background-color: #666; color: white; border: 2px solid #888;">
                    Clear
                </a>
            </div>
        </form>
    </div>

    <!-- Audit Logs Table -->
    <div class="rounded-xl shadow-lg overflow-hidden" style="background-color: #1a1f2e; border: 2px solid #b0bcc4; border-radius: 16px;">
        <table class="w-full">
            <thead>
                <tr style="background-color: #0f6fdd; border-bottom: 2px solid #b0bcc4;">
                    <th class="px-6 py-4 text-left font-bold" style="color: #ffffff;">Date/Time</th>
                    <th class="px-6 py-4 text-left font-bold" style="color: #ffffff;">User</th>
                    <th class="px-6 py-4 text-left font-bold" style="color: #ffffff;">Action</th>
                    <th class="px-6 py-4 text-left font-bold" style="color: #ffffff;">Model</th>
                    <th class="px-6 py-4 text-left font-bold" style="color: #ffffff;">ID</th>
                    <th class="px-6 py-4 text-center font-bold" style="color: #ffffff;">Details</th>
                </tr>
            </thead>
            <tbody>
                @forelse($logs as $log)
                    <tr class="transition-colors" style="border-bottom: 2px solid #b0bcc4;" onmouseover="this.style.backgroundColor='#0f6fdd'" onmouseout="this.style.backgroundColor='transparent'">
                        <td class="px-6 py-4" style="color: #b0bcc4;">{{ $log->created_at->format('M d, Y H:i:s') }}</td>
                        <td class="px-6 py-4" style="color: #ffffff;">{{ $log->user->name ?? 'System' }}</td>
                        <td class="px-6 py-4">
                            @if($log->action === 'create')
                                <span class="px-3 py-1 rounded-full text-xs font-bold" style="background-color: #4caf50; color: white;">Create</span>
                            @elseif($log->action === 'update')
                                <span class="px-3 py-1 rounded-full text-xs font-bold" style="background-color: #ff9500; color: #0f1419;">Update</span>
                            @else
                                <span class="px-3 py-1 rounded-full text-xs font-bold" style="background-color: #f44336; color: white;">Delete</span>
                            @endif
                        </td>
                        <td class="px-6 py-4" style="color: #ffffff; font-weight: bold;">{{ $log->model }}</td>
                        <td class="px-6 py-4" style="color: #b0bcc4;">#{{ $log->model_id }}</td>
                        <td class="px-6 py-4 text-center">
                            <a href="{{ route('admin.audit-logs.show', $log) }}" class="inline-flex items-center gap-1 px-3 py-1.5 rounded-md text-xs font-semibold" style="background-color: #0f6fdd; color: #ffffff; border: 1px solid #b0bcc4;" onmouseover="this.style.backgroundColor='#1a7fff'; this.style.boxShadow='0 2px 4px rgba(0,0,0,0.2)'" onmouseout="this.style.backgroundColor='#0f6fdd'; this.style.boxShadow=''">
                                <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path></svg>
                                View
                            </a>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="px-6 py-12 text-center" style="color: #b0bcc4;">
                            No audit logs found.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <!-- Pagination -->
    @if($logs->hasPages())
        <div class="mt-8 flex justify-center">
            {{ $logs->links('pagination::tailwind') }}
        </div>
    @endif
</x-admin-layout>
