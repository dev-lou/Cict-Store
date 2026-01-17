<?php if (isset($component)) { $__componentOriginale0f1cdd055772eb1d4a99981c240763e = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginale0f1cdd055772eb1d4a99981c240763e = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.admin-layout','data' => []] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('admin-layout'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
    <?php $__env->startSection('page-title', 'Audit Logs'); ?>

    <!-- Breadcrumb -->
    <?php if (isset($component)) { $__componentOriginaldbbc880c47f621cda59b70d6eb356b2f = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginaldbbc880c47f621cda59b70d6eb356b2f = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.admin.breadcrumb','data' => ['items' => [
        ['label' => 'System'],
        ['label' => 'Audit Logs']
    ]]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('admin.breadcrumb'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['items' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute([
        ['label' => 'System'],
        ['label' => 'Audit Logs']
    ])]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginaldbbc880c47f621cda59b70d6eb356b2f)): ?>
<?php $attributes = $__attributesOriginaldbbc880c47f621cda59b70d6eb356b2f; ?>
<?php unset($__attributesOriginaldbbc880c47f621cda59b70d6eb356b2f); ?>
<?php endif; ?>
<?php if (isset($__componentOriginaldbbc880c47f621cda59b70d6eb356b2f)): ?>
<?php $component = $__componentOriginaldbbc880c47f621cda59b70d6eb356b2f; ?>
<?php unset($__componentOriginaldbbc880c47f621cda59b70d6eb356b2f); ?>
<?php endif; ?>

    <!-- Page Header -->
    <?php if (isset($component)) { $__componentOriginalcb19cb35a534439097b02b8af91726ee = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalcb19cb35a534439097b02b8af91726ee = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.admin.page-header','data' => ['title' => 'Audit Logs','subtitle' => 'Track all system changes, deletions, and updates']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('admin.page-header'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['title' => 'Audit Logs','subtitle' => 'Track all system changes, deletions, and updates']); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginalcb19cb35a534439097b02b8af91726ee)): ?>
<?php $attributes = $__attributesOriginalcb19cb35a534439097b02b8af91726ee; ?>
<?php unset($__attributesOriginalcb19cb35a534439097b02b8af91726ee); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalcb19cb35a534439097b02b8af91726ee)): ?>
<?php $component = $__componentOriginalcb19cb35a534439097b02b8af91726ee; ?>
<?php unset($__componentOriginalcb19cb35a534439097b02b8af91726ee); ?>
<?php endif; ?>

    <!-- Filter Section -->
    <?php if (isset($component)) { $__componentOriginal3f97fad59f1d161af1828ef2108f500f = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal3f97fad59f1d161af1828ef2108f500f = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.admin.filter-bar','data' => ['action' => ''.e(route('admin.audit-logs.index')).'']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('admin.filter-bar'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['action' => ''.e(route('admin.audit-logs.index')).'']); ?>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-4 w-full">
            <!-- Action Filter -->
            <div>
                <label class="block text-sm font-semibold mb-2" style="color: rgba(255, 255, 255, 0.6);">Action</label>
                <select name="action" class="w-full px-4 py-2.5 rounded-xl text-white focus:outline-none transition-all" 
                        style="border: 1px solid rgba(255, 255, 255, 0.1); background: rgba(15, 20, 25, 0.6);" 
                        onfocus="this.style.borderColor='#3b82f6'; this.style.background='rgba(15, 20, 25, 0.8)'" 
                        onblur="this.style.borderColor='rgba(255, 255, 255, 0.1)'; this.style.background='rgba(15, 20, 25, 0.6)'">
                    <option value="">All Actions</option>
                    <option value="create" <?php echo e(request('action') === 'create' ? 'selected' : ''); ?>>Create</option>
                    <option value="update" <?php echo e(request('action') === 'update' ? 'selected' : ''); ?>>Update</option>
                    <option value="delete" <?php echo e(request('action') === 'delete' ? 'selected' : ''); ?>>Delete</option>
                </select>
            </div>

            <!-- Model Filter -->
            <div>
                <label class="block text-sm font-semibold mb-2" style="color: rgba(255, 255, 255, 0.6);">Model</label>
                <select name="model" class="w-full px-4 py-2.5 rounded-xl text-white focus:outline-none transition-all" 
                        style="border: 1px solid rgba(255, 255, 255, 0.1); background: rgba(15, 20, 25, 0.6);" 
                        onfocus="this.style.borderColor='#3b82f6'; this.style.background='rgba(15, 20, 25, 0.8)'" 
                        onblur="this.style.borderColor='rgba(255, 255, 255, 0.1)'; this.style.background='rgba(15, 20, 25, 0.6)'">
                    <option value="">All Models</option>
                    <?php $__currentLoopData = $models; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $model): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <option value="<?php echo e($model); ?>" <?php echo e(request('model') === $model ? 'selected' : ''); ?>><?php echo e($model); ?></option>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </select>
            </div>

            <!-- Search -->
            <div>
                <label class="block text-sm font-semibold mb-2" style="color: rgba(255, 255, 255, 0.6);">User</label>
                <input type="text" name="search" value="<?php echo e(request('search')); ?>" placeholder="Search by user..." 
                       class="w-full px-4 py-2.5 rounded-xl text-white focus:outline-none transition-all"
                       style="border: 1px solid rgba(255, 255, 255, 0.1); background: rgba(15, 20, 25, 0.6);" 
                       onfocus="this.style.borderColor='#3b82f6'; this.style.background='rgba(15, 20, 25, 0.8)'" 
                       onblur="this.style.borderColor='rgba(255, 255, 255, 0.1)'; this.style.background='rgba(15, 20, 25, 0.6)'" />
            </div>
        </div>

        <div class="flex gap-2">
            <?php if (isset($component)) { $__componentOriginal60a020e5340f3f52bbc4501dc9f93102 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal60a020e5340f3f52bbc4501dc9f93102 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.admin.button','data' => ['type' => 'submit','variant' => 'primary']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('admin.button'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['type' => 'submit','variant' => 'primary']); ?>Filter <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal60a020e5340f3f52bbc4501dc9f93102)): ?>
<?php $attributes = $__attributesOriginal60a020e5340f3f52bbc4501dc9f93102; ?>
<?php unset($__attributesOriginal60a020e5340f3f52bbc4501dc9f93102); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal60a020e5340f3f52bbc4501dc9f93102)): ?>
<?php $component = $__componentOriginal60a020e5340f3f52bbc4501dc9f93102; ?>
<?php unset($__componentOriginal60a020e5340f3f52bbc4501dc9f93102); ?>
<?php endif; ?>
            <?php if (isset($component)) { $__componentOriginal60a020e5340f3f52bbc4501dc9f93102 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal60a020e5340f3f52bbc4501dc9f93102 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.admin.button','data' => ['href' => ''.e(route('admin.audit-logs.index')).'','variant' => 'secondary']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('admin.button'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['href' => ''.e(route('admin.audit-logs.index')).'','variant' => 'secondary']); ?>Clear <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal60a020e5340f3f52bbc4501dc9f93102)): ?>
<?php $attributes = $__attributesOriginal60a020e5340f3f52bbc4501dc9f93102; ?>
<?php unset($__attributesOriginal60a020e5340f3f52bbc4501dc9f93102); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal60a020e5340f3f52bbc4501dc9f93102)): ?>
<?php $component = $__componentOriginal60a020e5340f3f52bbc4501dc9f93102; ?>
<?php unset($__componentOriginal60a020e5340f3f52bbc4501dc9f93102); ?>
<?php endif; ?>
        </div>
     <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal3f97fad59f1d161af1828ef2108f500f)): ?>
<?php $attributes = $__attributesOriginal3f97fad59f1d161af1828ef2108f500f; ?>
<?php unset($__attributesOriginal3f97fad59f1d161af1828ef2108f500f); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal3f97fad59f1d161af1828ef2108f500f)): ?>
<?php $component = $__componentOriginal3f97fad59f1d161af1828ef2108f500f; ?>
<?php unset($__componentOriginal3f97fad59f1d161af1828ef2108f500f); ?>
<?php endif; ?>

    <!-- Audit Logs Table -->
    <div class="rounded-xl shadow-lg overflow-hidden" 
         style="background: linear-gradient(135deg, rgba(15, 20, 25, 0.8) 0%, rgba(26, 31, 46, 0.8) 100%); 
                border: 1px solid rgba(255, 255, 255, 0.1);">
        <div class="overflow-x-auto">
            <table class="w-full">
                <thead>
                    <tr style="background: linear-gradient(135deg, #3b82f6 0%, #2563eb 100%); border-bottom: 2px solid rgba(255, 255, 255, 0.1);">
                        <th class="px-6 py-4 text-left text-sm font-bold text-white">Date/Time</th>
                        <th class="px-6 py-4 text-left text-sm font-bold text-white">User</th>
                        <th class="px-6 py-4 text-left text-sm font-bold text-white">Action</th>
                        <th class="px-6 py-4 text-left text-sm font-bold text-white">Model</th>
                        <th class="px-6 py-4 text-left text-sm font-bold text-white">ID</th>
                        <th class="px-6 py-4 text-center text-sm font-bold text-white">Details</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $__empty_1 = true; $__currentLoopData = $logs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $log): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                        <tr class="transition-all duration-200" 
                            style="border-bottom: 1px solid rgba(255, 255, 255, 0.05);" 
                            onmouseover="this.style.background='rgba(59, 130, 246, 0.1)'" 
                            onmouseout="this.style.background='transparent'">
                            <td class="px-6 py-4" style="color: rgba(255, 255, 255, 0.6);"><?php echo e($log->created_at->format('M d, Y H:i:s')); ?></td>
                            <td class="px-6 py-4 text-white font-semibold"><?php echo e($log->user->name ?? 'System'); ?></td>
                            <td class="px-6 py-4">
                                <?php
                                    $actionStyles = match($log->action) {
                                        'create' => 'background: linear-gradient(135deg, #10b981 0%, #059669 100%); color: white;',
                                        'update' => 'background: linear-gradient(135deg, #f59e0b 0%, #d97706 100%); color: white;',
                                        'delete' => 'background: linear-gradient(135deg, #ef4444 0%, #dc2626 100%); color: white;',
                                        default => 'background: linear-gradient(135deg, #6b7280 0%, #4b5563 100%); color: white;'
                                    };
                                ?>
                                <span class="px-3 py-1.5 rounded-lg text-xs font-bold inline-block" style="<?php echo e($actionStyles); ?>">
                                    <?php echo e(ucfirst($log->action)); ?>

                                </span>
                            </td>
                            <td class="px-6 py-4 text-white font-semibold"><?php echo e($log->model); ?></td>
                            <td class="px-6 py-4" style="color: rgba(255, 255, 255, 0.6);">#<?php echo e($log->model_id); ?></td>
                            <td class="px-6 py-4 text-center">
                                <?php if (isset($component)) { $__componentOriginal60a020e5340f3f52bbc4501dc9f93102 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal60a020e5340f3f52bbc4501dc9f93102 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.admin.button','data' => ['href' => ''.e(route('admin.audit-logs.show', $log)).'','size' => 'sm','variant' => 'primary']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('admin.button'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['href' => ''.e(route('admin.audit-logs.show', $log)).'','size' => 'sm','variant' => 'primary']); ?>
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                                    </svg>
                                    View
                                 <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal60a020e5340f3f52bbc4501dc9f93102)): ?>
<?php $attributes = $__attributesOriginal60a020e5340f3f52bbc4501dc9f93102; ?>
<?php unset($__attributesOriginal60a020e5340f3f52bbc4501dc9f93102); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal60a020e5340f3f52bbc4501dc9f93102)): ?>
<?php $component = $__componentOriginal60a020e5340f3f52bbc4501dc9f93102; ?>
<?php unset($__componentOriginal60a020e5340f3f52bbc4501dc9f93102); ?>
<?php endif; ?>
                            </td>
                        </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                        <tr>
                            <td colspan="6" class="px-6 py-12 text-center">
                                <svg class="w-16 h-16 mx-auto mb-4 opacity-30" style="color: rgba(255, 255, 255, 0.3);" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                                </svg>
                                <p class="text-lg font-semibold" style="color: rgba(255, 255, 255, 0.6);">No audit logs found</p>
                            </td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>

    <!-- Pagination -->
    <?php if($logs->hasPages()): ?>
        <div class="mt-6">
            <div class="flex items-center justify-between px-6 py-4 rounded-xl" style="background: linear-gradient(135deg, rgba(15, 20, 25, 0.8) 0%, rgba(26, 31, 46, 0.8) 100%); border: 1px solid rgba(255, 255, 255, 0.1);">
                <div style="color: rgba(255, 255, 255, 0.7);">
                    Showing <span class="font-semibold text-white"><?php echo e($logs->firstItem()); ?></span> to <span class="font-semibold text-white"><?php echo e($logs->lastItem()); ?></span> of <span class="font-semibold text-white"><?php echo e($logs->total()); ?></span> entries
                </div>
                <div>
                    <?php echo e($logs->links()); ?>

                </div>
            </div>
        </div>
    <?php endif; ?>
 <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginale0f1cdd055772eb1d4a99981c240763e)): ?>
<?php $attributes = $__attributesOriginale0f1cdd055772eb1d4a99981c240763e; ?>
<?php unset($__attributesOriginale0f1cdd055772eb1d4a99981c240763e); ?>
<?php endif; ?>
<?php if (isset($__componentOriginale0f1cdd055772eb1d4a99981c240763e)): ?>
<?php $component = $__componentOriginale0f1cdd055772eb1d4a99981c240763e; ?>
<?php unset($__componentOriginale0f1cdd055772eb1d4a99981c240763e); ?>
<?php endif; ?>
<?php /**PATH C:\xampp\htdocs\laravel_igp\resources\views/admin/audit-logs/index.blade.php ENDPATH**/ ?>