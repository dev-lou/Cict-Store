<?php $attributes ??= new \Illuminate\View\ComponentAttributeBag;

$__newAttributes = [];
$__propNames = \Illuminate\View\ComponentAttributeBag::extractPropNames(([
    'title', 
    'value', 
    'iconBg' => 'linear-gradient(135deg, #3b82f6 0%, #2563eb 100%)',
    'cardBg' => 'linear-gradient(135deg, #3b82f6 0%, #2563eb 100%)',
    'borderColor' => '#60a5fa',
    'subtitle' => null,
    'trend' => null
]));

foreach ($attributes->all() as $__key => $__value) {
    if (in_array($__key, $__propNames)) {
        $$__key = $$__key ?? $__value;
    } else {
        $__newAttributes[$__key] = $__value;
    }
}

$attributes = new \Illuminate\View\ComponentAttributeBag($__newAttributes);

unset($__propNames);
unset($__newAttributes);

foreach (array_filter(([
    'title', 
    'value', 
    'iconBg' => 'linear-gradient(135deg, #3b82f6 0%, #2563eb 100%)',
    'cardBg' => 'linear-gradient(135deg, #3b82f6 0%, #2563eb 100%)',
    'borderColor' => '#60a5fa',
    'subtitle' => null,
    'trend' => null
]), 'is_string', ARRAY_FILTER_USE_KEY) as $__key => $__value) {
    $$__key = $$__key ?? $__value;
}

$__defined_vars = get_defined_vars();

foreach ($attributes->all() as $__key => $__value) {
    if (array_key_exists($__key, $__defined_vars)) unset($$__key);
}

unset($__defined_vars); ?>

<div class="rounded-xl shadow-lg transition-all duration-300 p-6 relative overflow-hidden" 
     style="background: <?php echo e($cardBg); ?>; border: 2px solid <?php echo e($borderColor); ?>;"
     onmouseover="this.style.transform='translateY(-4px)'; this.style.boxShadow='0 12px 24px rgba(59, 130, 246, 0.4)';" 
     onmouseout="this.style.transform='translateY(0)'; this.style.boxShadow='0 4px 12px rgba(0, 0, 0, 0.3)';">
    
    <!-- Header -->
    <div class="flex items-center justify-between mb-4">
        <h3 class="text-sm font-semibold text-white uppercase tracking-wider"><?php echo e($title); ?></h3>
        <?php if(isset($icon)): ?>
            <div class="w-12 h-12 rounded-lg flex items-center justify-center" 
                 style="background: rgba(255, 255, 255, 0.2); border: 2px solid rgba(255, 255, 255, 0.3);">
                <div class="w-6 h-6 text-white">
                    <?php echo e($icon); ?>

                </div>
            </div>
        <?php endif; ?>
    </div>
    
    <!-- Value -->
    <p class="text-3xl font-bold text-white mb-2" style="text-shadow: 0 2px 4px rgba(0,0,0,0.2);">
        <?php echo e($value); ?>

    </p>
    
    <!-- Footer -->
    <?php if($subtitle || $trend): ?>
        <div class="mt-3 pt-3 border-t border-white/20">
            <?php if($subtitle): ?>
                <p class="text-sm font-semibold text-white/90"><?php echo e($subtitle); ?></p>
            <?php endif; ?>
            <?php if($trend): ?>
                <div class="text-sm font-semibold mt-1">
                    <?php echo e($trend); ?>

                </div>
            <?php endif; ?>
        </div>
    <?php endif; ?>
</div>
<?php /**PATH C:\xampp\htdocs\laravel_igp\resources\views/components/admin/stats-card.blade.php ENDPATH**/ ?>