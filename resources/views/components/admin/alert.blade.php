@props(['type' => 'info', 'dismissible' => false, 'message'])

@php
$styles = [
    'success' => [
        'bg' => '#10b981',
        'border' => 'rgba(16, 185, 129, 0.3)',
        'icon' => '<svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>'
    ],
    'error' => [
        'bg' => '#ef4444',
        'border' => 'rgba(239, 68, 68, 0.3)',
        'icon' => '<svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>'
    ],
    'warning' => [
        'bg' => '#f59e0b',
        'border' => 'rgba(245, 158, 11, 0.3)',
        'icon' => '<svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path></svg>'
    ],
    'info' => [
        'bg' => '#3b82f6',
        'border' => 'rgba(59, 130, 246, 0.3)',
        'icon' => '<svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>'
    ]
];

$style = $styles[$type] ?? $styles['info'];
@endphp

<div class="rounded-xl p-4 mb-6 flex items-start gap-3" 
     style="background: {{ $style['bg'] }}; border: 1px solid {{ $style['border'] }}; box-shadow: 0 2px 8px rgba(0, 0, 0, 0.2);"
     x-data="{ show: true }" 
     x-show="show"
     x-transition>
    
    <!-- Icon -->
    <div class="flex-shrink-0 text-white">
        {!! $style['icon'] !!}
    </div>
    
    <!-- Message -->
    <div class="flex-1 text-white font-medium">
        {{ $message ?? $slot }}
    </div>
    
    <!-- Dismiss Button -->
    @if($dismissible)
        <button @click="show = false" 
                class="flex-shrink-0 text-white/80 hover:text-white transition-colors">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
            </svg>
        </button>
    @endif
</div>
