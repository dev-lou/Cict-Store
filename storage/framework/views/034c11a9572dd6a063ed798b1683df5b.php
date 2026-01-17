<?php $attributes ??= new \Illuminate\View\ComponentAttributeBag;

$__newAttributes = [];
$__propNames = \Illuminate\View\ComponentAttributeBag::extractPropNames((['action' => '', 'method' => 'GET']));

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

foreach (array_filter((['action' => '', 'method' => 'GET']), 'is_string', ARRAY_FILTER_USE_KEY) as $__key => $__value) {
    $$__key = $$__key ?? $__value;
}

$__defined_vars = get_defined_vars();

foreach ($attributes->all() as $__key => $__value) {
    if (array_key_exists($__key, $__defined_vars)) unset($$__key);
}

unset($__defined_vars); ?>

<div class="rounded-xl shadow-lg p-6 mb-6" 
     style="background: linear-gradient(135deg, rgba(15, 20, 25, 0.8) 0%, rgba(26, 31, 46, 0.8) 100%); 
            border: 1px solid rgba(255, 255, 255, 0.1);">
    <form method="<?php echo e($method); ?>" action="<?php echo e($action); ?>" class="flex gap-4 flex-wrap items-end">
        <?php if($method !== 'GET'): ?>
            <?php echo csrf_field(); ?>
            <?php echo method_field($method); ?>
        <?php endif; ?>
        <?php echo e($slot); ?>

    </form>
</div>
<?php /**PATH C:\xampp\htdocs\laravel_igp\resources\views/components/admin/filter-bar.blade.php ENDPATH**/ ?>