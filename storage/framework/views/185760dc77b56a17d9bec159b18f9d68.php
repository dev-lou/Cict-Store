<?php $attributes ??= new \Illuminate\View\ComponentAttributeBag;

$__newAttributes = [];
$__propNames = \Illuminate\View\ComponentAttributeBag::extractPropNames((['items' => []]));

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

foreach (array_filter((['items' => []]), 'is_string', ARRAY_FILTER_USE_KEY) as $__key => $__value) {
    $$__key = $$__key ?? $__value;
}

$__defined_vars = get_defined_vars();

foreach ($attributes->all() as $__key => $__value) {
    if (array_key_exists($__key, $__defined_vars)) unset($$__key);
}

unset($__defined_vars); ?>

<nav class="mb-6 p-4 rounded-xl flex items-center gap-3 flex-wrap" 
     style="background: linear-gradient(135deg, rgba(15, 20, 25, 0.8) 0%, rgba(26, 31, 46, 0.8) 100%); 
            border: 1px solid rgba(255, 255, 255, 0.1); 
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.3);">
    
    <!-- Home Icon -->
    <a href="<?php echo e(route('admin.dashboard')); ?>" 
       class="flex items-center justify-center w-8 h-8 rounded-lg transition-all duration-200" 
       style="color: rgba(255, 255, 255, 0.6);"
       onmouseover="this.style.backgroundColor='rgba(255, 255, 255, 0.1)'; this.style.color='#ffffff';"
       onmouseout="this.style.backgroundColor='transparent'; this.style.color='rgba(255, 255, 255, 0.6)';">
        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-3m0 0l7-4 7 4M5 9v10a1 1 0 001 1h12a1 1 0 001-1V9m-9 4v4m4-4v4m4-12l2 3"></path>
        </svg>
    </a>

    <?php $__currentLoopData = $items; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <!-- Separator -->
        <svg class="w-4 h-4" style="color: rgba(255, 255, 255, 0.3);" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
        </svg>

        <!-- Breadcrumb Item -->
        <?php if(isset($item['url']) && !$loop->last): ?>
            <a href="<?php echo e($item['url']); ?>" 
               class="text-sm font-medium transition-colors duration-200" 
               style="color: rgba(255, 255, 255, 0.6);"
               onmouseover="this.style.color='#ffffff';"
               onmouseout="this.style.color='rgba(255, 255, 255, 0.6)';">
                <?php echo e($item['label']); ?>

            </a>
        <?php else: ?>
            <span class="text-sm font-semibold" style="color: #ffffff;">
                <?php echo e($item['label']); ?>

            </span>
        <?php endif; ?>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
</nav>
<?php /**PATH C:\xampp\htdocs\laravel_igp\resources\views/components/admin/breadcrumb.blade.php ENDPATH**/ ?>