<x-admin-layout>
    @section('page-title', 'Audit Log Details')

    <!-- Breadcrumb -->
    <x-admin.breadcrumb :items="[
        ['label' => 'System'],
        ['label' => 'Audit Logs', 'url' => route('admin.audit-logs.index')],
        ['label' => ucfirst($log->action) . ' - ' . $log->model]
    ]" />

    <!-- Page Header -->
    <x-admin.page-header 
        :title="ucfirst($log->action) . ' - ' . $log->model . ' #' . $log->model_id" 
        :subtitle="$log->created_at->format('F d, Y h:i:s A')">
        <x-slot:actions>
            <x-admin.button href="{{ route('admin.audit-logs.index') }}" variant="secondary">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                </svg>
                Back to Audit Logs
            </x-admin.button>
        </x-slot:actions>
    </x-admin.page-header>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
        <!-- Left Column - Log Details -->
        <div class="lg:col-span-2 space-y-6">
            <!-- Basic Information -->
            <div class="rounded-lg shadow-lg overflow-hidden" style="background-color: #1a1f2e; border: 2px solid #b0bcc4;">
                <div style="background-color: #0f6fdd; border-bottom: 2px solid #b0bcc4;" class="px-6 py-4">
                    <h3 class="text-lg font-bold" style="color: #ffffff;">Audit Information</h3>
                </div>
                <div class="p-6 space-y-4">
                    <div style="border-bottom: 2px solid #b0bcc4; padding-bottom: 12px;">
                        <p style="color: #b0bcc4; font-size: 12px;">Action</p>
                        <p style="color: #ffffff; font-weight: bold;">
                            @if($log->action === 'create')
                                <span class="px-3 py-1 rounded-full text-xs font-bold" style="background-color: #4caf50; color: white;">Create</span>
                            @elseif($log->action === 'update')
                                <span class="px-3 py-1 rounded-full text-xs font-bold" style="background-color: #ff9500; color: #0f1419;">Update</span>
                            @else
                                <span class="px-3 py-1 rounded-full text-xs font-bold" style="background-color: #f44336; color: white;">Delete</span>
                            @endif
                        </p>
                    </div>
                    <div style="border-bottom: 2px solid #b0bcc4; padding-bottom: 12px;">
                        <p style="color: #b0bcc4; font-size: 12px;">Model</p>
                        <p style="color: #ffffff; font-weight: bold;">{{ $log->model }}</p>
                    </div>
                    <div style="border-bottom: 2px solid #b0bcc4; padding-bottom: 12px;">
                        <p style="color: #b0bcc4; font-size: 12px;">Model ID</p>
                        <p style="color: #ffffff; font-weight: bold;">#{{ $log->model_id }}</p>
                    </div>
                    <div>
                        <p style="color: #b0bcc4; font-size: 12px;">IP Address</p>
                        <p style="color: #ffffff; font-weight: bold;">{{ $log->ip_address ?? 'N/A' }}</p>
                    </div>
                </div>
            </div>

            <!-- Old Values (for updates/deletes) -->
            @if($log->old_values)
                <div class="rounded-lg shadow-lg overflow-hidden" style="background-color: #1a1f2e; border: 2px solid #b0bcc4;">
                    <div style="background-color: #0f6fdd; border-bottom: 2px solid #b0bcc4;" class="px-6 py-4">
                        <h3 class="text-lg font-bold" style="color: #ffffff;">Previous Values</h3>
                    </div>
                    <div class="p-6">
                        <table class="w-full">
                            <thead>
                                <tr style="border-bottom: 2px solid #b0bcc4;">
                                    <th class="text-left pb-3" style="color: #b0bcc4; font-weight: bold;">Field</th>
                                    <th class="text-left pb-3" style="color: #b0bcc4; font-weight: bold;">Value</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($log->old_values as $key => $value)
                                    <tr style="border-bottom: 1px solid #b0bcc4;">
                                        <td class="py-2" style="color: #b0bcc4;">{{ $key }}</td>
                                        <td class="py-2" style="color: #ffffff; word-break: break-word; max-width: 300px;">
                                            @if(is_array($value))
                                                <pre style="background-color: #0f1419; padding: 8px; border-radius: 4px; border: 1px solid #b0bcc4; color: #b0bcc4; font-size: 12px; overflow-x: auto;">{{ json_encode($value, JSON_PRETTY_PRINT) }}</pre>
                                            @else
                                                {{ $value ?? 'null' }}
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            @endif

            <!-- New Values (for creates/updates) -->
            @if($log->new_values)
                <div class="rounded-lg shadow-lg overflow-hidden" style="background-color: #1a1f2e; border: 2px solid #b0bcc4;">
                    <div style="background-color: #0f6fdd; border-bottom: 2px solid #b0bcc4;" class="px-6 py-4">
                        <h3 class="text-lg font-bold" style="color: #ffffff;">{{ $log->action === 'create' ? 'Created Values' : 'New Values' }}</h3>
                    </div>
                    <div class="p-6">
                        <table class="w-full">
                            <thead>
                                <tr style="border-bottom: 2px solid #b0bcc4;">
                                    <th class="text-left pb-3" style="color: #b0bcc4; font-weight: bold;">Field</th>
                                    <th class="text-left pb-3" style="color: #b0bcc4; font-weight: bold;">Value</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($log->new_values as $key => $value)
                                    <tr style="border-bottom: 1px solid #b0bcc4;">
                                        <td class="py-2" style="color: #b0bcc4;">{{ $key }}</td>
                                        <td class="py-2" style="color: #ffffff; word-break: break-word; max-width: 300px;">
                                            @if(is_array($value))
                                                <pre style="background-color: #0f1419; padding: 8px; border-radius: 4px; border: 1px solid #b0bcc4; color: #b0bcc4; font-size: 12px; overflow-x: auto;">{{ json_encode($value, JSON_PRETTY_PRINT) }}</pre>
                                            @else
                                                {{ $value ?? 'null' }}
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            @endif
        </div>

        <!-- Right Column - User Info -->
        <div class="lg:col-span-1">
            <div class="rounded-lg shadow-lg overflow-hidden" style="background-color: #1a1f2e; border: 2px solid #b0bcc4;">
                <div style="background-color: #0f6fdd; border-bottom: 2px solid #b0bcc4;" class="px-6 py-4">
                    <h3 class="text-lg font-bold" style="color: #ffffff;">User Info</h3>
                </div>
                <div class="p-6 space-y-3">
                    <div>
                        <p style="color: #b0bcc4; font-size: 12px;">User</p>
                        <p style="color: #ffffff; font-weight: bold;">{{ $log->user?->name ?? 'System' }}</p>
                    </div>
                    @if($log->user)
                        <div style="border-top: 2px solid #b0bcc4; padding-top: 12px;">
                            <p style="color: #b0bcc4; font-size: 12px;">Email</p>
                            <p style="color: #ffffff; font-weight: bold;">{{ $log->user->email }}</p>
                        </div>
                    @endif
                    <div style="border-top: 2px solid #b0bcc4; padding-top: 12px;">
                        <p style="color: #b0bcc4; font-size: 12px;">Date/Time</p>
                        <p style="color: #ffffff; font-weight: bold;">{{ $log->created_at->format('M d, Y h:i A') }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-admin-layout>
