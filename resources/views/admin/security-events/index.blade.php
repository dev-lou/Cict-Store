<x-admin-layout>
    @section('page-title', 'Security Events')

    <x-admin.breadcrumb :items="[
        ['label' => 'System'],
        ['label' => 'Security Events']
    ]" />

    <x-admin.page-header title="Security Events" subtitle="Monitor failed logins and temporary lockouts" />

    <x-admin.filter-bar action="{{ route('admin.security-events.index') }}">
        <div class="grid grid-cols-1 md:grid-cols-3 gap-4 w-full">
            <div>
                <label class="block text-sm font-semibold mb-2" style="color: rgba(255, 255, 255, 0.6);">IP Address</label>
                <input type="text" name="ip" value="{{ request('ip') }}" placeholder="Search IP..."
                       class="w-full px-4 py-2.5 rounded-xl text-white focus:outline-none transition-all"
                       style="border: 1px solid rgba(255, 255, 255, 0.1); background: rgba(15, 20, 25, 0.6);"
                       onfocus="this.style.borderColor='#3b82f6'; this.style.background='rgba(15, 20, 25, 0.8)'"
                       onblur="this.style.borderColor='rgba(255, 255, 255, 0.1)'; this.style.background='rgba(15, 20, 25, 0.6)'" />
            </div>

            <div>
                <label class="block text-sm font-semibold mb-2" style="color: rgba(255, 255, 255, 0.6);">Email</label>
                <input type="text" name="email" value="{{ request('email') }}" placeholder="Search email..."
                       class="w-full px-4 py-2.5 rounded-xl text-white focus:outline-none transition-all"
                       style="border: 1px solid rgba(255, 255, 255, 0.1); background: rgba(15, 20, 25, 0.6);"
                       onfocus="this.style.borderColor='#3b82f6'; this.style.background='rgba(15, 20, 25, 0.8)'"
                       onblur="this.style.borderColor='rgba(255, 255, 255, 0.1)'; this.style.background='rgba(15, 20, 25, 0.6)'" />
            </div>

            <div>
                <label class="block text-sm font-semibold mb-2" style="color: rgba(255, 255, 255, 0.6);">Status</label>
                <select name="status" class="w-full px-4 py-2.5 rounded-xl text-white focus:outline-none transition-all"
                        style="border: 1px solid rgba(255, 255, 255, 0.1); background: rgba(15, 20, 25, 0.6);"
                        onfocus="this.style.borderColor='#3b82f6'; this.style.background='rgba(15, 20, 25, 0.8)'"
                        onblur="this.style.borderColor='rgba(255, 255, 255, 0.1)'; this.style.background='rgba(15, 20, 25, 0.6)'">
                    <option value="">All</option>
                    <option value="failed" {{ request('status') === 'failed' ? 'selected' : '' }}>Failed</option>
                    <option value="blocked" {{ request('status') === 'blocked' ? 'selected' : '' }}>Blocked</option>
                </select>
            </div>
        </div>

        <div class="flex gap-2">
            <x-admin.button type="submit" variant="primary">Filter</x-admin.button>
            <x-admin.button href="{{ route('admin.security-events.index') }}" variant="secondary">Clear</x-admin.button>
        </div>
    </x-admin.filter-bar>

    <div class="rounded-xl shadow-lg overflow-hidden"
         style="background: linear-gradient(135deg, rgba(15, 20, 25, 0.8) 0%, rgba(26, 31, 46, 0.8) 100%);
                border: 1px solid rgba(255, 255, 255, 0.1);">
        <div class="overflow-x-auto">
            <table class="w-full">
                <thead>
                    <tr style="background: linear-gradient(135deg, #8b0000 0%, #6b0000 100%); border-bottom: 2px solid rgba(255, 255, 255, 0.1);">
                        <th class="px-6 py-4 text-left text-sm font-bold text-white">Time</th>
                        <th class="px-6 py-4 text-left text-sm font-bold text-white">IP</th>
                        <th class="px-6 py-4 text-left text-sm font-bold text-white">Email</th>
                        <th class="px-6 py-4 text-left text-sm font-bold text-white">Status</th>
                        <th class="px-6 py-4 text-left text-sm font-bold text-white">Blocked Until</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($events as $event)
                        @php
                            $isBlocked = $event->blocked_until && $event->blocked_until->isFuture();
                        @endphp
                        <tr class="transition-all duration-200"
                            style="border-bottom: 1px solid rgba(255, 255, 255, 0.05);"
                            onmouseover="this.style.background='rgba(139, 0, 0, 0.12)'"
                            onmouseout="this.style.background='transparent'">
                            <td class="px-6 py-4" style="color: rgba(255, 255, 255, 0.75);">{{ optional($event->attempted_at)->format('M d, Y H:i:s') }}</td>
                            <td class="px-6 py-4 text-white font-semibold">{{ $event->ip_address }}</td>
                            <td class="px-6 py-4" style="color: rgba(255, 255, 255, 0.82);">{{ $event->email ?: 'N/A' }}</td>
                            <td class="px-6 py-4">
                                @if($isBlocked)
                                    <span class="px-3 py-1.5 rounded-lg text-xs font-bold inline-block"
                                          style="background: linear-gradient(135deg, #ef4444 0%, #dc2626 100%); color: white;">Blocked</span>
                                @else
                                    <span class="px-3 py-1.5 rounded-lg text-xs font-bold inline-block"
                                          style="background: linear-gradient(135deg, #f59e0b 0%, #d97706 100%); color: white;">Failed</span>
                                @endif
                            </td>
                            <td class="px-6 py-4" style="color: rgba(255, 255, 255, 0.75);">{{ $event->blocked_until ? $event->blocked_until->format('M d, Y H:i:s') : '-' }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="px-6 py-12 text-center">
                                <p class="text-lg font-semibold" style="color: rgba(255, 255, 255, 0.65);">No security events found</p>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    @if($events->hasPages())
        <div class="mt-6">
            <div class="flex items-center justify-between px-6 py-4 rounded-xl"
                 style="background: linear-gradient(135deg, rgba(15, 20, 25, 0.8) 0%, rgba(26, 31, 46, 0.8) 100%); border: 1px solid rgba(255, 255, 255, 0.1);">
                <div style="color: rgba(255, 255, 255, 0.7);">
                    Showing <span class="font-semibold text-white">{{ $events->firstItem() }}</span> to
                    <span class="font-semibold text-white">{{ $events->lastItem() }}</span> of
                    <span class="font-semibold text-white">{{ $events->total() }}</span> entries
                </div>
                <div>
                    {{ $events->links() }}
                </div>
            </div>
        </div>
    @endif
</x-admin-layout>
