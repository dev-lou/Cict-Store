@props([
    'variant' => 'primary', // primary, secondary, ghost, danger
    'size' => 'md', // sm, md, lg
    'disabled' => false,
    'type' => 'button',
    'href' => null,
    'class' => '',
])

@php
    // Base classes
    $baseClasses = 'inline-flex items-center justify-center font-medium transition-all duration-200 ease-out';
    
    // Variant styles
    $variants = [
        'primary' => 'bg-blue-600 hover:bg-blue-700 text-white shadow-sm hover:shadow-md active:scale-95 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2',
        'secondary' => 'bg-gray-200 hover:bg-gray-300 text-gray-900 shadow-sm hover:shadow-md active:scale-95 focus:outline-none focus:ring-2 focus:ring-gray-400 focus:ring-offset-2',
        'ghost' => 'bg-transparent hover:bg-gray-100 text-gray-900 active:scale-95 focus:outline-none focus:ring-2 focus:ring-gray-400',
        'danger' => 'bg-red-600 hover:bg-red-700 text-white shadow-sm hover:shadow-md active:scale-95 focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-offset-2',
    ];
    
    // Size classes
    $sizes = [
        'sm' => 'px-3 py-1.5 text-sm rounded-lg',
        'md' => 'px-4 py-2.5 text-base rounded-lg',
        'lg' => 'px-6 py-3 text-lg rounded-lg',
    ];
    
    // Disabled state
    $disabledClasses = $disabled ? 'opacity-50 cursor-not-allowed' : 'cursor-pointer';
    
    $computedClass = "{$baseClasses} {$variants[$variant]} {$sizes[$size]} {$disabledClasses} {$class}";
@endphp

@if ($href)
    <a href="{{ $href }}" {{ $attributes->class($computedClass)->except(['variant', 'size', 'disabled', 'type', 'href', 'class']) }}>
        {{ $slot }}
    </a>
@else
    <button 
        type="{{ $type }}"
        {{ $disabled ? 'disabled' : '' }}
        {{ $attributes->class($computedClass)->except(['variant', 'size', 'disabled', 'type', 'href', 'class']) }}
    >
        {{ $slot }}
    </button>
@endif
