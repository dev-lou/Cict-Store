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
    <?php $__env->startSection('page-title', 'Create User'); ?>

    <?php if (isset($component)) { $__componentOriginaldbbc880c47f621cda59b70d6eb356b2f = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginaldbbc880c47f621cda59b70d6eb356b2f = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.admin.breadcrumb','data' => ['items' => [
        ['label' => 'System'],
        ['label' => 'Users', 'url' => route('admin.users.index')],
        ['label' => 'Create User']
    ]]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('admin.breadcrumb'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['items' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute([
        ['label' => 'System'],
        ['label' => 'Users', 'url' => route('admin.users.index')],
        ['label' => 'Create User']
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

    <?php if (isset($component)) { $__componentOriginalcb19cb35a534439097b02b8af91726ee = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalcb19cb35a534439097b02b8af91726ee = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.admin.page-header','data' => ['title' => 'Create New User','subtitle' => 'Add a new team member or customer account']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('admin.page-header'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['title' => 'Create New User','subtitle' => 'Add a new team member or customer account']); ?>
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

    <div class="px-8">
        <div class="rounded-2xl shadow-2xl overflow-hidden" style="background: linear-gradient(180deg, #1a1f2e 0%, #0f1419 100%); border: 2px solid #b0bcc4;">
            <div style="height: 3px; background: linear-gradient(90deg, #0f6fdd 0%, #b0bcc4 50%, #0f6fdd 100%);"></div>

            <div class="p-6">
                <form action="<?php echo e(route('admin.users.store')); ?>" method="POST">
                    <?php echo csrf_field(); ?>

                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
                        <!-- Name -->
                        <div>
                            <label for="name" class="block text-sm font-semibold mb-2" style="color: #b0bcc4;">
                                <svg class="w-4 h-4 inline-block mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                                </svg>
                                Full Name <span style="color: #f44336;">*</span>
                            </label>
                            <input 
                                type="text" 
                                id="name" 
                                name="name" 
                                value="<?php echo e(old('name')); ?>"
                                placeholder="John Doe"
                                class="w-full px-4 py-2.5 rounded-lg text-base transition-all"
                                style="border: 2px solid #444; background-color: #0f0707; color: #ffffff;"
                                onfocus="this.style.borderColor='#0f6fdd'; this.style.boxShadow='0 0 0 3px rgba(15, 111, 221, 0.1)'"
                                onblur="this.style.borderColor='#444'; this.style.boxShadow=''"
                                required
                            />
                            <?php $__errorArgs = ['name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                <p class="mt-1.5 text-sm" style="color: #ff6b6b;"><?php echo e($message); ?></p>
                            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                        </div>

                        <!-- Email -->
                        <div>
                            <label for="email" class="block text-sm font-semibold mb-2" style="color: #b0bcc4;">
                                <svg class="w-4 h-4 inline-block mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                                </svg>
                                Email Address <span style="color: #f44336;">*</span>
                            </label>
                            <input 
                                type="email" 
                                id="email" 
                                name="email" 
                                value="<?php echo e(old('email')); ?>"
                                placeholder="user@example.com"
                                class="w-full px-4 py-2.5 rounded-lg text-base transition-all"
                                style="border: 2px solid #444; background-color: #0f0707; color: #ffffff;"
                                onfocus="this.style.borderColor='#0f6fdd'; this.style.boxShadow='0 0 0 3px rgba(15, 111, 221, 0.1)'"
                                onblur="this.style.borderColor='#444'; this.style.boxShadow=''"
                                required
                            />
                            <?php $__errorArgs = ['email'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                <p class="mt-1.5 text-sm" style="color: #ff6b6b;"><?php echo e($message); ?></p>
                            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                        </div>

                        <!-- Password -->
                        <div>
                            <label for="password" class="block text-sm font-semibold mb-2" style="color: #b0bcc4;">
                                <svg class="w-4 h-4 inline-block mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path>
                                </svg>
                                Password <span style="color: #f44336;">*</span>
                            </label>
                            <input 
                                type="password" 
                                id="password" 
                                name="password" 
                                placeholder="••••••••"
                                class="w-full px-4 py-2.5 rounded-lg text-base transition-all"
                                style="border: 2px solid #444; background-color: #0f0707; color: #ffffff;"
                                onfocus="this.style.borderColor='#0f6fdd'; this.style.boxShadow='0 0 0 3px rgba(15, 111, 221, 0.1)'"
                                onblur="this.style.borderColor='#444'; this.style.boxShadow=''"
                                required
                            />
                            <?php $__errorArgs = ['password'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                <p class="mt-1.5 text-sm" style="color: #ff6b6b;"><?php echo e($message); ?></p>
                            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                        </div>

                        <!-- Confirm Password -->
                        <div>
                            <label for="password_confirmation" class="block text-sm font-semibold mb-2" style="color: #b0bcc4;">
                                <svg class="w-4 h-4 inline-block mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                                Confirm Password <span style="color: #f44336;">*</span>
                            </label>
                            <input 
                                type="password" 
                                id="password_confirmation" 
                                name="password_confirmation" 
                                placeholder="••••••••"
                                class="w-full px-4 py-2.5 rounded-lg text-base transition-all"
                                style="border: 2px solid #444; background-color: #0f0707; color: #ffffff;"
                                onfocus="this.style.borderColor='#0f6fdd'; this.style.boxShadow='0 0 0 3px rgba(15, 111, 221, 0.1)'"
                                onblur="this.style.borderColor='#444'; this.style.boxShadow=''"
                                required
                            />
                        </div>
                    </div>

                    <!-- Role Selection -->
                    <div class="mt-6">
                        <label class="block text-sm font-semibold mb-3" style="color: #b0bcc4;">
                            <svg class="w-4 h-4 inline-block mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"></path>
                            </svg>
                            User Role <span style="color: #f44336;">*</span>
                        </label>
                        <div class="grid grid-cols-3 gap-3">
                            <?php $__currentLoopData = ['admin' => 'Administrator', 'staff' => 'Staff Member', 'customer' => 'Customer']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $roleValue => $roleLabel): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <label class="relative cursor-pointer group">
                                    <input 
                                        type="radio" 
                                        name="roles" 
                                        value="<?php echo e($roleValue); ?>"
                                        class="peer absolute opacity-0"
                                        style="pointer-events: none;"
                                        <?php echo e(old('roles') === $roleValue ? 'checked' : ''); ?>

                                        required
                                    />
                                    <div class="p-3 rounded-lg text-center font-semibold text-sm transition-all flex items-center justify-center gap-2" style="border: 2px solid #444; background-color: #0f0707; color: #b0bcc4;">
                                        <span class="radio-circle" style="width: 18px; height: 18px; border-radius: 50%; border: 2px solid #666; display: flex; align-items: center; justify-content: center;">
                                            <span class="radio-dot" style="width: 10px; height: 10px; border-radius: 50%; background: #0f6fdd; opacity: 0; transition: opacity 0.2s;"></span>
                                        </span>
                                        <?php echo e($roleLabel); ?>

                                    </div>
                                </label>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </div>
                        <?php $__errorArgs = ['roles'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                            <p class="mt-2 text-sm" style="color: #ff6b6b;"><?php echo e($message); ?></p>
                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                    </div>

                    <!-- Form Actions -->
                    <div class="flex gap-4 mt-6 pt-6 mb-8 justify-center" style="border-top: 2px solid #444;">
                        <a 
                            href="<?php echo e(route('admin.users.index')); ?>" 
                            class="px-8 py-3 rounded-xl font-bold text-center transition-all"
                            style="background-color: #2a2f3a; color: #b0bcc4; border: 2px solid #444;"
                            onmouseover="this.style.backgroundColor='#353a47'; this.style.borderColor='#555'"
                            onmouseout="this.style.backgroundColor='#2a2f3a'; this.style.borderColor='#444'"
                        >
                            <svg class="w-5 h-5 inline-block mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                            </svg>
                            Cancel
                        </a>
                        <button 
                            type="submit" 
                            class="px-8 py-3 rounded-xl font-bold text-center transition-all"
                            style="background: linear-gradient(135deg, #4caf50 0%, #45a049 100%); color: white; border: 2px solid #4caf50; box-shadow: 0 4px 12px rgba(76, 175, 80, 0.3);"
                            onmouseover="this.style.transform='translateY(-2px)'; this.style.boxShadow='0 6px 16px rgba(76, 175, 80, 0.4)'"
                            onmouseout="this.style.transform=''; this.style.boxShadow='0 4px 12px rgba(76, 175, 80, 0.3)'"
                        >
                            <svg class="w-5 h-5 inline-block mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                            </svg>
                            Create User
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <style>
        .peer:checked ~ div {
            background: linear-gradient(135deg, #0f6fdd 0%, #1a7fff 100%) !important;
            color: #ffffff !important;
            border-color: #0f6fdd !important;
            box-shadow: 0 4px 12px rgba(15, 111, 221, 0.3) !important;
        }
        
        .peer:checked ~ div .radio-circle {
            border-color: #ffffff !important;
        }
        
        .peer:checked ~ div .radio-dot {
            opacity: 1 !important;
            background: #ffffff !important;
        }
        
        .group:hover div {
            border-color: #555 !important;
        }
    </style>
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
<?php /**PATH C:\xampp\htdocs\laravel_igp\resources\views/admin/users/create.blade.php ENDPATH**/ ?>