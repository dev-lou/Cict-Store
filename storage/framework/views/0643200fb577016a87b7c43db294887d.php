<?php
    $viteManifest = public_path('build/manifest.json');
    $legacyViteManifest = public_path('build/.vite/manifest.json');
?>

<?php if(file_exists($viteManifest) || file_exists($legacyViteManifest)): ?>
    <?php echo app('Illuminate\Foundation\Vite')(['resources/css/app.css', 'resources/js/app.js']); ?>
<?php else: ?>
    <!-- Vite manifest not found; fallback to static assets -->
    <link rel="stylesheet" href="<?php echo e(asset('css/app.css')); ?>">
    <script src="<?php echo e(asset('js/app.js')); ?>" defer></script>
<?php endif; ?>
<?php /**PATH C:\xampp\htdocs\laravel_igp\resources\views/components/vite-assets.blade.php ENDPATH**/ ?>