@props([
    'title', 
    'value', 
    'iconBg' => 'linear-gradient(135deg, #3b82f6 0%, #2563eb 100%)',
    'cardBg' => 'linear-gradient(135deg, #3b82f6 0%, #2563eb 100%)',
    'borderColor' => '#60a5fa',
    'subtitle' => null,
    'trend' => null
])

<div class="rounded-xl shadow-lg transition-all duration-300 p-6 relative overflow-hidden" 
     style="background: {{ $cardBg }}; border: 2px solid {{ $borderColor }};"
     onmouseover="this.style.transform='translateY(-4px)'; this.style.boxShadow='0 12px 24px rgba(59, 130, 246, 0.4)';" 
     onmouseout="this.style.transform='translateY(0)'; this.style.boxShadow='0 4px 12px rgba(0, 0, 0, 0.3)';">
    
    <!-- Header -->
    <div class="flex items-center justify-between mb-4">
        <h3 class="text-sm font-semibold text-white uppercase tracking-wider">{{ $title }}</h3>
        @isset($icon)
            <div class="w-12 h-12 rounded-lg flex items-center justify-center" 
                 style="background: rgba(255, 255, 255, 0.2); border: 2px solid rgba(255, 255, 255, 0.3);">
                <div class="w-6 h-6 text-white">
                    {{ $icon }}
                </div>
            </div>
        @endisset
    </div>
    
    <!-- Value -->
    <p class="text-3xl font-bold text-white mb-2" style="text-shadow: 0 2px 4px rgba(0,0,0,0.2);">
        {{ $value }}
    </p>
    
    <!-- Footer -->
    @if($subtitle || $trend)
        <div class="mt-3 pt-3 border-t border-white/20">
            @if($subtitle)
                <p class="text-sm font-semibold text-white/90">{{ $subtitle }}</p>
            @endif
            @if($trend)
                <div class="text-sm font-semibold mt-1">
                    {{ $trend }}
                </div>
            @endif
        </div>
    @endif
</div>
