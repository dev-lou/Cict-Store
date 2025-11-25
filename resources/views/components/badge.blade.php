@props([
    'status' => 'default', // default, pending, processing, completed, cancelled, danger, success
    'size' => 'md', // sm, md, lg
    'dot' => true,
])

@php
    $statusConfig = [
        'default' => [
            'bg' => 'bg-gray-100',
            'text' => 'text-gray-800',
            'dot' => 'bg-gray-400',
            'label' => 'Default',
        ],
        'pending' => [
            'bg' => 'bg-yellow-100',
            'text' => 'text-yellow-800',
            'dot' => 'bg-yellow-500',
            'label' => 'Pending',
        ],
        'processing' => [
            'bg' => 'bg-blue-100',
            'text' => 'text-blue-800',
            'dot' => 'bg-blue-500',
            'label' => 'Processing',
        ],
        'completed' => [
            'bg' => 'bg-green-100',
            'text' => 'text-green-800',
            'dot' => 'bg-green-500',
            'label' => 'Completed',
        ],
        'cancelled' => [
            'bg' => 'bg-gray-200',
            'text' => 'text-gray-700',
            'dot' => 'bg-gray-400',
            'label' => 'Cancelled',
        ],
        'danger' => [
            'bg' => 'bg-red-100',
            'text' => 'text-red-800',
            'dot' => 'bg-red-500',
            'label' => 'Error',
        ],
        'success' => [
            'bg' => 'bg-green-100',
            'text' => 'text-green-800',
            'dot' => 'bg-green-500',
            'label' => 'Success',
        ],
    ];

    $config = $statusConfig[$status] ?? $statusConfig['default'];

    $sizes = [
        'sm' => 'px-2.5 py-1 text-xs font-medium rounded',
        'md' => 'px-3 py-1.5 text-sm font-medium rounded-lg',
        'lg' => 'px-4 py-2 text-base font-medium rounded-lg',
    ];
@endphp

<span class="inline-flex items-center gap-2 {{ $config['bg'] }} {{ $config['text'] }} {{ $sizes[$size] }}">
    @if ($dot)
        <span class="inline-flex">
            <span class="h-1.5 w-1.5 rounded-full {{ $config['dot'] }}"></span>
        </span>
    @endif
    {{ $slot ?: $config['label'] }}
</span>
