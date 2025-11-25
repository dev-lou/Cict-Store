@props([
    'title' => '',
    'size' => 'md', // sm, md, lg, xl
    'closeButton' => true,
])

@php
    $sizes = [
        'sm' => 'max-w-sm',
        'md' => 'max-w-md',
        'lg' => 'max-w-lg',
        'xl' => 'max-w-xl',
    ];
@endphp

<div
    x-data="{ open: false }"
    @keydown.escape.window="open = false"
    {{ $attributes }}
>
    <!-- Modal Trigger (slot for button or other trigger element) -->
    <div @click="open = true">
        {{ $trigger ?? '' }}
    </div>

    <!-- Modal Overlay -->
    <div
        x-show="open"
        x-transition:enter="transition ease-out duration-200"
        x-transition:enter-start="opacity-0"
        x-transition:enter-end="opacity-100"
        x-transition:leave="transition ease-in duration-150"
        x-transition:leave-start="opacity-100"
        x-transition:leave-end="opacity-0"
        @click="open = false"
        class="fixed inset-0 z-40 bg-black/60 backdrop-blur-sm"
        style="display: none;"
    ></div>

    <!-- Modal Content -->
    <div
        x-show="open"
        x-transition:enter="transition ease-out duration-200"
        x-transition:enter-start="opacity-0 scale-95"
        x-transition:enter-end="opacity-100 scale-100"
        x-transition:leave="transition ease-in duration-150"
        x-transition:leave-start="opacity-100 scale-100"
        x-transition:leave-end="opacity-0 scale-95"
        @click.stop
        class="fixed inset-0 z-50 flex items-center justify-center p-4"
        style="display: none;"
    >
        <div class="{{ $sizes[$size] }} w-full max-h-[90vh] overflow-y-auto rounded-xl shadow-2xl" style="background-color: #1a0f0f; border: 2px solid #daa520; border-radius: 16px;">
            <!-- Header -->
            <div class="flex items-center justify-between px-6 py-4" style="background-color: #8b0000; border-bottom: 2px solid #daa520; border-radius: 14px 14px 0 0;">
                <h2 class="text-lg font-semibold font-bold" style="color: #ffd700; letter-spacing: 0.5px;">{{ $title }}</h2>
                @if ($closeButton)
                    <button
                        @click="open = false"
                        class="transition-colors duration-150 p-1"
                        style="color: #daa520;"
                        onmouseover="this.style.color='#ffd700';"
                        onmouseout="this.style.color='#daa520';"
                    >
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                        </svg>
                    </button>
                @endif
            </div>

            <!-- Body -->
            <div class="px-6 py-6" style="background-color: #1a0f0f;">
                {{ $slot }}
            </div>

            <!-- Footer (optional) -->
            @isset($footer)
                <div style="border-top: 2px solid #daa520;">
                    {{ $footer }}
                </div>
            @endisset
        </div>
    </div>
</div>
