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
    <?php $__env->startSection('page-title', 'Audit Log Details'); ?>

    <!-- Breadcrumb -->
    <?php if (isset($component)) { $__componentOriginaldbbc880c47f621cda59b70d6eb356b2f = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginaldbbc880c47f621cda59b70d6eb356b2f = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.admin.breadcrumb','data' => ['items' => [
        ['label' => 'System'],
        ['label' => 'Audit Logs', 'url' => route('admin.audit-logs.index')],
        ['label' => 'Log #' . $log->id]
    ]]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('admin.breadcrumb'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['items' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute([
        ['label' => 'System'],
        ['label' => 'Audit Logs', 'url' => route('admin.audit-logs.index')],
        ['label' => 'Log #' . $log->id]
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
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.admin.page-header','data' => ['title' => 'Audit Log Details','subtitle' => 'View detailed information about this system event']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('admin.page-header'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['title' => 'Audit Log Details','subtitle' => 'View detailed information about this system event']); ?>
         <?php $__env->slot('actions', null, []); ?> 
            <?php if (isset($component)) { $__componentOriginal60a020e5340f3f52bbc4501dc9f93102 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal60a020e5340f3f52bbc4501dc9f93102 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.admin.button','data' => ['href' => ''.e(route('admin.audit-logs.index')).'','variant' => 'secondary']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('admin.button'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['href' => ''.e(route('admin.audit-logs.index')).'','variant' => 'secondary']); ?>
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                </svg>
                Back to Logs
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
         <?php $__env->endSlot(); ?>
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

    <div class="max-w-5xl mx-auto space-y-6">
        <!-- Overview Card -->
        <div class="rounded-2xl shadow-2xl overflow-hidden" style="background: linear-gradient(180deg, #1a1f2e 0%, #0f1419 100%); border: 2px solid #b0bcc4;">
            <!-- Card Top Border -->
            <div style="height: 3px; background: linear-gradient(90deg, #0f6fdd 0%, #b0bcc4 50%, #0f6fdd 100%);"></div>

            <div class="p-8">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <!-- Log ID -->
                    <div class="flex items-start gap-4">
                        <div class="p-3 rounded-lg" style="background-color: #0f6fdd;">
                            <svg class="w-6 h-6" style="color: #ffffff;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 20l4-16m2 16l4-16M6 9h14M4 15h14"></path>
                            </svg>
                        </div>
                        <div>
                            <p class="text-sm font-medium" style="color: #999;">Log ID</p>
                            <p class="text-lg font-bold mt-1" style="color: #ffffff;">#<?php echo e($log->id); ?></p>
                        </div>
                    </div>

                    <!-- Action Type -->
                    <div class="flex items-start gap-4">
                        <div class="p-3 rounded-lg" style="background-color: #0f6fdd;">
                            <svg class="w-6 h-6" style="color: #ffffff;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path>
                            </svg>
                        </div>
                        <div>
                            <p class="text-sm font-medium" style="color: #999;">Action</p>
                            <span class="inline-block px-3 py-1 rounded-full text-sm font-bold mt-1" 
                                  style="background-color: <?php echo e($log->action === 'create' ? '#4caf50' : ($log->action === 'update' ? '#ff9500' : '#f44336')); ?>; color: #ffffff;">
                                <?php echo e(strtoupper($log->action)); ?>

                            </span>
                        </div>
                    </div>

                    <!-- Model Type -->
                    <div class="flex items-start gap-4">
                        <div class="p-3 rounded-lg" style="background-color: #0f6fdd;">
                            <svg class="w-6 h-6" style="color: #ffffff;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                            </svg>
                        </div>
                        <div>
                            <p class="text-sm font-medium" style="color: #999;">Model Type</p>
                            <p class="text-lg font-bold mt-1" style="color: #ffffff;"><?php echo e($log->model); ?></p>
                        </div>
                    </div>

                    <!-- Model ID -->
                    <div class="flex items-start gap-4">
                        <div class="p-3 rounded-lg" style="background-color: #0f6fdd;">
                            <svg class="w-6 h-6" style="color: #ffffff;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 7a2 2 0 012 2m4 0a6 6 0 01-7.743 5.743L11 17H9v2H7v2H4a1 1 0 01-1-1v-2.586a1 1 0 01.293-.707l5.964-5.964A6 6 0 1121 9z"></path>
                            </svg>
                        </div>
                        <div>
                            <p class="text-sm font-medium" style="color: #999;">Model ID</p>
                            <p class="text-lg font-bold mt-1" style="color: #ffffff;"><?php echo e($log->model_id); ?></p>
                        </div>
                    </div>

                    <!-- User -->
                    <div class="flex items-start gap-4">
                        <div class="p-3 rounded-lg" style="background-color: #0f6fdd;">
                            <svg class="w-6 h-6" style="color: #ffffff;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                            </svg>
                        </div>
                        <div>
                            <p class="text-sm font-medium" style="color: #999;">Performed By</p>
                            <p class="text-lg font-bold mt-1" style="color: #ffffff;">
                                <?php if($log->user): ?>
                                    <?php echo e($log->user->name); ?>

                                <?php else: ?>
                                    System
                                <?php endif; ?>
                            </p>
                            <?php if($log->user): ?>
                                <p class="text-sm mt-1" style="color: #999;"><?php echo e($log->user->email); ?></p>
                            <?php endif; ?>
                        </div>
                    </div>

                    <!-- Timestamp -->
                    <div class="flex items-start gap-4">
                        <div class="p-3 rounded-lg" style="background-color: #0f6fdd;">
                            <svg class="w-6 h-6" style="color: #ffffff;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                        </div>
                        <div>
                            <p class="text-sm font-medium" style="color: #999;">Timestamp</p>
                            <p class="text-lg font-bold mt-1" style="color: #ffffff;"><?php echo e($log->created_at->format('M d, Y')); ?></p>
                            <p class="text-sm mt-1" style="color: #999;"><?php echo e($log->created_at->format('h:i A')); ?></p>
                        </div>
                    </div>

                    <!-- IP Address -->
                    <?php if($log->ip_address): ?>
                    <div class="flex items-start gap-4">
                        <div class="p-3 rounded-lg" style="background-color: #0f6fdd;">
                            <svg class="w-6 h-6" style="color: #ffffff;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 12a9 9 0 01-9 9m9-9a9 9 0 00-9-9m9 9H3m9 9a9 9 0 01-9-9m9 9c1.657 0 3-4.03 3-9s-1.343-9-3-9m0 18c-1.657 0-3-4.03-3-9s1.343-9 3-9m-9 9a9 9 0 019-9"></path>
                            </svg>
                        </div>
                        <div class="flex-1">
                            <p class="text-sm font-medium" style="color: #999;">IP Address</p>
                            <p class="text-lg font-bold mt-1" style="color: #ffffff;"><?php echo e($log->ip_address); ?></p>
                        </div>
                    </div>
                    <?php endif; ?>

                    <!-- User Agent -->
                    <?php if($log->user_agent): ?>
                    <div class="flex items-start gap-4 md:col-span-2">
                        <div class="p-3 rounded-lg" style="background-color: #0f6fdd;">
                            <svg class="w-6 h-6" style="color: #ffffff;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.75 17L9 20l-1 1h8l-1-1-.75-3M3 13h18M5 17h14a2 2 0 002-2V5a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                            </svg>
                        </div>
                        <div class="flex-1">
                            <p class="text-sm font-medium" style="color: #999;">Browser / Device</p>
                            <p class="text-sm mt-1 leading-relaxed" style="color: #b0bcc4;"><?php echo e($log->user_agent); ?></p>
                        </div>
                    </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>

        <!-- Changes Details -->
        <?php if($log->action === 'update' && (!empty($log->old_values) || !empty($log->new_values))): ?>
        <div class="rounded-2xl shadow-2xl overflow-hidden" style="background: linear-gradient(180deg, #1a1f2e 0%, #0f1419 100%); border: 2px solid #b0bcc4;">
            <!-- Card Top Border -->
            <div style="height: 3px; background: linear-gradient(90deg, #0f6fdd 0%, #b0bcc4 50%, #0f6fdd 100%);"></div>

            <div class="p-8">
                <h3 class="text-xl font-bold mb-6" style="color: #b0bcc4;">Change Details</h3>

                <div class="overflow-x-auto">
                    <table class="w-full">
                        <thead>
                            <tr style="border-bottom: 2px solid #444;">
                                <th class="text-left p-4 font-bold text-sm" style="color: #b0bcc4;">Field</th>
                                <th class="text-left p-4 font-bold text-sm" style="color: #b0bcc4;">Old Value</th>
                                <th class="text-left p-4 font-bold text-sm" style="color: #b0bcc4;">New Value</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                                $oldValues = is_string($log->old_values) ? json_decode($log->old_values, true) : $log->old_values;
                                $newValues = is_string($log->new_values) ? json_decode($log->new_values, true) : $log->new_values;
                                $allFields = array_unique(array_merge(array_keys($oldValues ?? []), array_keys($newValues ?? [])));
                            ?>

                            <?php $__empty_1 = true; $__currentLoopData = $allFields; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $field): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                                <?php
                                    $oldValue = $oldValues[$field] ?? 'N/A';
                                    $newValue = $newValues[$field] ?? 'N/A';
                                    
                                    // Format values for display
                                    if (is_bool($oldValue)) $oldValue = $oldValue ? 'true' : 'false';
                                    if (is_bool($newValue)) $newValue = $newValue ? 'true' : 'false';
                                    if (is_array($oldValue)) $oldValue = json_encode($oldValue, JSON_PRETTY_PRINT);
                                    if (is_array($newValue)) $newValue = json_encode($newValue, JSON_PRETTY_PRINT);
                                    if (is_null($oldValue)) $oldValue = 'null';
                                    if (is_null($newValue)) $newValue = 'null';
                                    
                                    // Skip password fields
                                    if (in_array(strtolower($field), ['password', 'password_hash'])) continue;
                                ?>
                                <tr style="border-bottom: 1px solid #333;">
                                    <td class="p-4 font-bold" style="color: #b0bcc4;"><?php echo e(ucfirst(str_replace('_', ' ', $field))); ?></td>
                                    <td class="p-4">
                                        <code class="px-3 py-1 rounded text-sm" style="background-color: #0f0707; color: #ff6b6b; border: 1px solid #444;">
                                            <?php echo e(Str::limit($oldValue, 50)); ?>

                                        </code>
                                    </td>
                                    <td class="p-4">
                                        <code class="px-3 py-1 rounded text-sm" style="background-color: #0f0707; color: #4caf50; border: 1px solid #444;">
                                            <?php echo e(Str::limit($newValue, 50)); ?>

                                        </code>
                                    </td>
                                </tr>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                                <tr>
                                    <td colspan="3" class="p-4 text-center" style="color: #999;">No change details available</td>
                                </tr>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <?php endif; ?>

        <!-- Creation/Deletion Data -->
        <?php if(in_array($log->action, ['create', 'delete']) && !empty($log->new_values)): ?>
        <div class="rounded-2xl shadow-2xl overflow-hidden" style="background: linear-gradient(180deg, #1a1f2e 0%, #0f1419 100%); border: 2px solid #b0bcc4;">
            <!-- Card Top Border -->
            <div style="height: 3px; background: linear-gradient(90deg, #0f6fdd 0%, #b0bcc4 50%, #0f6fdd 100%);"></div>

            <div class="p-8">
                <h3 class="text-xl font-bold mb-6" style="color: #b0bcc4;"><?php echo e($log->action === 'create' ? 'Created Data' : 'Deleted Data'); ?></h3>

                <div class="p-6 rounded-lg" style="background-color: #0f0707; border: 2px solid #444;">
                    <pre class="text-sm overflow-x-auto" style="color: #b0bcc4;"><?php echo e(json_encode(is_string($log->new_values) ? json_decode($log->new_values) : $log->new_values, JSON_PRETTY_PRINT)); ?></pre>
                </div>
            </div>
        </div>
        <?php endif; ?>
    </div>
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
<?php /**PATH C:\xampp\htdocs\laravel_igp\resources\views/admin/audit-logs/show.blade.php ENDPATH**/ ?>