<?php $attributes ??= new \Illuminate\View\ComponentAttributeBag;

$__newAttributes = [];
$__propNames = \Illuminate\View\ComponentAttributeBag::extractPropNames(([
    'variant' => 'primary',
    'size' => 'md',
    'icon' => null,
    'href' => null,
    'type' => 'button'
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
    'variant' => 'primary',
    'size' => 'md',
    'icon' => null,
    'href' => null,
    'type' => 'button'
]), 'is_string', ARRAY_FILTER_USE_KEY) as $__key => $__value) {
    $$__key = $$__key ?? $__value;
}

$__defined_vars = get_defined_vars();

foreach ($attributes->all() as $__key => $__value) {
    if (array_key_exists($__key, $__defined_vars)) unset($$__key);
}

unset($__defined_vars); ?>

<?php
$variants = [
    'primary' => 'background: linear-gradient(135deg, #3b82f6 0%, #2563eb 100%); border: 1px solid #60a5fa; color: #ffffff;',
    'success' => 'background: linear-gradient(135deg, #10b981 0%, #059669 100%); border: 1px solid #34d399; color: #ffffff;',
    'danger' => 'background: linear-gradient(135deg, #ef4444 0%, #dc2626 100%); border: 1px solid #f87171; color: #ffffff;',
    'secondary' => 'background: linear-gradient(135deg, #6b7280 0%, #4b5563 100%); border: 1px solid #9ca3af; color: #ffffff;',
    'outline' => 'background: transparent; border: 2px solid rgba(255, 255, 255, 0.3); color: rgba(255, 255, 255, 0.9);'
];

$sizes = [
    'sm' => 'px-3 py-1.5 text-sm',
    'md' => 'px-4 py-2 text-base',
    'lg' => 'px-6 py-3 text-base'
];

$baseStyle = $variants[$variant] ?? $variants['primary'];
$sizeClass = $sizes[$size] ?? $sizes['md'];
?>

<?php if($href): ?>
    <a href="<?php echo e($href); ?>" 
       class="inline-flex items-center gap-2 <?php echo e($sizeClass); ?> rounded-xl font-semibold transition-all duration-300 shadow-md"
       style="<?php echo e($baseStyle); ?>"
       onmouseover="this.style.transform='translateY(-2px)'; this.style.boxShadow='0 8px 16px rgba(0, 0, 0, 0.3)';"
       onmouseout="this.style.transform='translateY(0)'; this.style.boxShadow='0 2px 8px rgba(0, 0, 0, 0.2)';">
        <?php if($icon): ?>
            <?php echo $icon; ?>

        <?php endif; ?>
        <?php echo e($slot); ?>

    </a>
<?php else: ?>
    <button type="<?php echo e($type); ?>" 
            <?php echo e($attributes->merge(['class' => "inline-flex items-center gap-2 {$sizeClass} rounded-xl font-semibold transition-all duration-300 shadow-md"])); ?>

            style="<?php echo e($baseStyle); ?>"
            onmouseover="this.style.transform='translateY(-2px)'; this.style.boxShadow='0 8px 16px rgba(0, 0, 0, 0.3)';"
            onmouseout="this.style.transform='translateY(0)'; this.style.boxShadow='0 2px 8px rgba(0, 0, 0, 0.2)';">
        <?php if($icon): ?>
            <?php echo $icon; ?>

        <?php endif; ?>
        <?php echo e($slot); ?>

    </button>
<?php endif; ?>
<?php /**PATH C:\xampp\htdocs\laravel_igp\resources\views/components/admin/button.blade.php ENDPATH**/ ?>