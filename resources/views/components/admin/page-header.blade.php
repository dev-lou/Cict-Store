@props(['title', 'subtitle' => null, 'actions' => null])

<div class="mb-8 flex items-center justify-between flex-wrap gap-4">
    <div>
        <h1 class="text-3xl font-bold mb-2" style="color: #ffffff; letter-spacing: 0.5px;">{{ $title }}</h1>
        @if($subtitle)
            <p class="text-sm" style="color: rgba(255, 255, 255, 0.6);">{{ $subtitle }}</p>
        @endif
    </div>
    @if($actions)
        <div class="flex items-center gap-3">
            {{ $actions }}
        </div>
    @endif
</div>
