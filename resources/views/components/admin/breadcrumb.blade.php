@props(['items' => []])

<nav class="mb-6 p-4 rounded-xl flex items-center gap-3 flex-wrap" 
     style="background: linear-gradient(135deg, rgba(15, 20, 25, 0.8) 0%, rgba(26, 31, 46, 0.8) 100%); 
            border: 1px solid rgba(255, 255, 255, 0.1); 
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.3);">
    
    <!-- Home Icon -->
    <a href="{{ route('admin.dashboard') }}" 
       class="flex items-center justify-center w-8 h-8 rounded-lg transition-all duration-200" 
       style="color: rgba(255, 255, 255, 0.6);"
       onmouseover="this.style.backgroundColor='rgba(255, 255, 255, 0.1)'; this.style.color='#ffffff';"
       onmouseout="this.style.backgroundColor='transparent'; this.style.color='rgba(255, 255, 255, 0.6)';">
        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-3m0 0l7-4 7 4M5 9v10a1 1 0 001 1h12a1 1 0 001-1V9m-9 4v4m4-4v4m4-12l2 3"></path>
        </svg>
    </a>

    @foreach($items as $index => $item)
        <!-- Separator -->
        <svg class="w-4 h-4" style="color: rgba(255, 255, 255, 0.3);" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
        </svg>

        <!-- Breadcrumb Item -->
        @if(isset($item['url']) && !$loop->last)
            <a href="{{ $item['url'] }}" 
               class="text-sm font-medium transition-colors duration-200" 
               style="color: rgba(255, 255, 255, 0.6);"
               onmouseover="this.style.color='#ffffff';"
               onmouseout="this.style.color='rgba(255, 255, 255, 0.6)';">
                {{ $item['label'] }}
            </a>
        @else
            <span class="text-sm font-semibold" style="color: #ffffff;">
                {{ $item['label'] }}
            </span>
        @endif
    @endforeach
</nav>
