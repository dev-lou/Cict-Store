<?php $attributes ??= new \Illuminate\View\ComponentAttributeBag;

$__newAttributes = [];
$__propNames = \Illuminate\View\ComponentAttributeBag::extractPropNames((['title', 'subtitle' => null, 'actions' => null]));

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

foreach (array_filter((['title', 'subtitle' => null, 'actions' => null]), 'is_string', ARRAY_FILTER_USE_KEY) as $__key => $__value) {
    $$__key = $$__key ?? $__value;
}

$__defined_vars = get_defined_vars();

foreach ($attributes->all() as $__key => $__value) {
    if (array_key_exists($__key, $__defined_vars)) unset($$__key);
}

unset($__defined_vars); ?>

<div class="mb-8 flex items-center justify-between flex-wrap gap-4">
    <div>
        <h1 class="text-3xl font-bold mb-2" style="color: #ffffff; letter-spacing: 0.5px;"><?php echo e($title); ?></h1>
        <?php if($subtitle): ?>
            <p class="text-sm" style="color: rgba(255, 255, 255, 0.6);"><?php echo e($subtitle); ?></p>
        <?php endif; ?>
    </div>
    <?php if($actions): ?>
        <div class="flex items-center gap-3">
            <?php echo e($actions); ?>

        </div>
    <?php endif; ?>
</div>
<?php /**PATH C:\xampp\htdocs\laravel_igp\resources\views/components/admin/page-header.blade.php ENDPATH**/ ?>