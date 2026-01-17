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
    <?php $__env->startSection('page-title', 'Edit Product'); ?>

    <!-- Flash Messages -->
    <?php if(session('success')): ?>
        <?php if (isset($component)) { $__componentOriginald888329b8246e32afd68d2decbd25cf1 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginald888329b8246e32afd68d2decbd25cf1 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.admin.alert','data' => ['type' => 'success','message' => session('success'),'dismissible' => true]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('admin.alert'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['type' => 'success','message' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(session('success')),'dismissible' => true]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginald888329b8246e32afd68d2decbd25cf1)): ?>
<?php $attributes = $__attributesOriginald888329b8246e32afd68d2decbd25cf1; ?>
<?php unset($__attributesOriginald888329b8246e32afd68d2decbd25cf1); ?>
<?php endif; ?>
<?php if (isset($__componentOriginald888329b8246e32afd68d2decbd25cf1)): ?>
<?php $component = $__componentOriginald888329b8246e32afd68d2decbd25cf1; ?>
<?php unset($__componentOriginald888329b8246e32afd68d2decbd25cf1); ?>
<?php endif; ?>
    <?php endif; ?>
    
    <?php if(session('warning')): ?>
        <?php if (isset($component)) { $__componentOriginald888329b8246e32afd68d2decbd25cf1 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginald888329b8246e32afd68d2decbd25cf1 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.admin.alert','data' => ['type' => 'warning','message' => session('warning'),'dismissible' => true]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('admin.alert'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['type' => 'warning','message' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(session('warning')),'dismissible' => true]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginald888329b8246e32afd68d2decbd25cf1)): ?>
<?php $attributes = $__attributesOriginald888329b8246e32afd68d2decbd25cf1; ?>
<?php unset($__attributesOriginald888329b8246e32afd68d2decbd25cf1); ?>
<?php endif; ?>
<?php if (isset($__componentOriginald888329b8246e32afd68d2decbd25cf1)): ?>
<?php $component = $__componentOriginald888329b8246e32afd68d2decbd25cf1; ?>
<?php unset($__componentOriginald888329b8246e32afd68d2decbd25cf1); ?>
<?php endif; ?>
    <?php endif; ?>
    
    <?php if(session('error')): ?>
        <?php if (isset($component)) { $__componentOriginald888329b8246e32afd68d2decbd25cf1 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginald888329b8246e32afd68d2decbd25cf1 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.admin.alert','data' => ['type' => 'error','message' => session('error'),'dismissible' => true]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('admin.alert'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['type' => 'error','message' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(session('error')),'dismissible' => true]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginald888329b8246e32afd68d2decbd25cf1)): ?>
<?php $attributes = $__attributesOriginald888329b8246e32afd68d2decbd25cf1; ?>
<?php unset($__attributesOriginald888329b8246e32afd68d2decbd25cf1); ?>
<?php endif; ?>
<?php if (isset($__componentOriginald888329b8246e32afd68d2decbd25cf1)): ?>
<?php $component = $__componentOriginald888329b8246e32afd68d2decbd25cf1; ?>
<?php unset($__componentOriginald888329b8246e32afd68d2decbd25cf1); ?>
<?php endif; ?>
    <?php endif; ?>

    <!-- Breadcrumb -->
    <?php if (isset($component)) { $__componentOriginaldbbc880c47f621cda59b70d6eb356b2f = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginaldbbc880c47f621cda59b70d6eb356b2f = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.admin.breadcrumb','data' => ['items' => [
        ['label' => 'Catalog'],
        ['label' => 'Inventory', 'url' => route('admin.inventory.index')],
        ['label' => 'Edit Product']
    ]]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('admin.breadcrumb'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['items' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute([
        ['label' => 'Catalog'],
        ['label' => 'Inventory', 'url' => route('admin.inventory.index')],
        ['label' => 'Edit Product']
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
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.admin.page-header','data' => ['title' => 'Edit Product','subtitle' => 'Update product information and inventory details']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('admin.page-header'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['title' => 'Edit Product','subtitle' => 'Update product information and inventory details']); ?>
         <?php $__env->slot('actions', null, []); ?> 
            <?php if($product->slug): ?>
                <?php if (isset($component)) { $__componentOriginal60a020e5340f3f52bbc4501dc9f93102 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal60a020e5340f3f52bbc4501dc9f93102 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.admin.button','data' => ['href' => ''.e(route('shop.show', $product->slug)).'','variant' => 'success','target' => '_blank']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('admin.button'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['href' => ''.e(route('shop.show', $product->slug)).'','variant' => 'success','target' => '_blank']); ?>
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                    </svg>
                    Preview
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
            <?php endif; ?>
            <?php if (isset($component)) { $__componentOriginal60a020e5340f3f52bbc4501dc9f93102 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal60a020e5340f3f52bbc4501dc9f93102 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.admin.button','data' => ['href' => ''.e(route('admin.inventory.index')).'','variant' => 'secondary']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('admin.button'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['href' => ''.e(route('admin.inventory.index')).'','variant' => 'secondary']); ?>
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                </svg>
                Back to Inventory
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

    <style>
        body {
            font-size: 16px;
            line-height: 1.6;
        }
        .page-header {
            margin-bottom: 32px;
            position: relative;
        }
        .page-header::after {
            content: '';
            position: absolute;
            bottom: -10px;
            left: 0;
            width: 80px;
            height: 3px;
            background: linear-gradient(90deg, #3b82f6 0%, transparent 100%);
            border-radius: 2px;
        }
        .form-group {
            margin-bottom: 24px;
        }
        .form-label {
            display: block;
            color: #cbd5e1;
            font-weight: 600;
            margin-bottom: 8px;
            font-size: 0.85rem;
            letter-spacing: 0.3px;
        }
        .form-input {
            width: 100%;
            padding: 12px 16px;
            background: rgba(15, 23, 42, 0.6);
            border: 1px solid rgba(59, 130, 246, 0.3);
            color: #e2e8f0;
            border-radius: 6px;
            font-weight: 500;
            font-size: 0.95rem;
            line-height: 1.6;
            transition: all 0.25s cubic-bezier(0.4, 0, 0.2, 1);
        }
        .form-input::placeholder {
            color: #64748b;
            font-weight: 400;
        }
        .form-input:hover {
            border-color: rgba(59, 130, 246, 0.5);
            background: rgba(15, 23, 42, 0.8);
        }
        .form-input:focus {
            outline: none;
            border-color: #3b82f6;
            background: rgba(15, 23, 42, 0.95);
            box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.15);
        }
        .section-header {
            color: #f1f5f9;
            font-weight: 600;
            font-size: 1.1rem;
            margin-bottom: 24px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            letter-spacing: 0.3px;
            padding-bottom: 12px;
            border-bottom: 1px solid rgba(59, 130, 246, 0.3);
            position: relative;
        }
        .section-header::after {
            content: '';
            position: absolute;
            bottom: -1px;
            left: 0;
            width: 60px;
            height: 2px;
            background: #3b82f6;
        }
        .variant-card {
            background: rgba(15, 23, 42, 0.6);
            border: 1px solid rgba(59, 130, 246, 0.3);
            border-radius: 6px;
            padding: 20px;
            position: relative;
            transition: all 0.25s ease;
        }
        .variant-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 3px;
            height: 100%;
            background: linear-gradient(180deg, #3b82f6 0%, transparent 100%);
            border-radius: 6px 0 0 6px;
            opacity: 0;
            transition: opacity 0.25s ease;
        }
        .variant-card:hover {
            border-color: rgba(59, 130, 246, 0.5);
            background: rgba(15, 23, 42, 0.8);
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.2);
        }
        .variant-card:hover::before {
            opacity: 1;
        }
        .variant-card.deleted {
            opacity: 0.5;
            pointer-events: none;
            text-decoration: line-through;
        }
        .variant-row.deleted {
            opacity: 0.5;
            pointer-events: none;
            background: rgba(239, 68, 68, 0.1) !important;
        }
        .variant-row.deleted td {
            text-decoration: line-through;
        }
        .floating-save-bar {
            position: fixed;
            bottom: -100px;
            left: 0;
            right: 0;
            background: linear-gradient(135deg, rgba(15, 23, 42, 0.98) 0%, rgba(30, 41, 59, 0.98) 100%);
            backdrop-filter: blur(20px);
            border-top: 2px solid rgba(59, 130, 246, 0.4);
            padding: 16px 32px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            box-shadow: 0 -8px 32px rgba(0, 0, 0, 0.4);
            z-index: 9998;
            transition: bottom 0.3s ease;
        }
        .floating-save-bar.visible {
            bottom: 0;
        }
        .btn-primary {
            padding: 10px 20px;
            background: linear-gradient(135deg, #3b82f6 0%, #2563eb 100%);
            color: #ffffff;
            border: none;
            border-radius: 6px;
            font-weight: 600;
            cursor: pointer;
            font-size: 0.9rem;
            transition: all 0.2s ease;
            box-shadow: 0 2px 8px rgba(59, 130, 246, 0.25);
        }
        .btn-primary:hover {
            background: linear-gradient(135deg, #2563eb 0%, #1d4ed8 100%);
            transform: translateY(-1px);
            box-shadow: 0 4px 12px rgba(59, 130, 246, 0.4);
        }
        .btn-primary:active {
            transform: translateY(0);
            box-shadow: 0 1px 4px rgba(59, 130, 246, 0.3);
        }
        .btn-cancel {
            background: rgba(30, 41, 59, 0.6);
            color: #94a3b8;
            border: 1px solid rgba(71, 85, 105, 0.4);
            padding: 10px 20px;
            border-radius: 6px;
            font-weight: 600;
            cursor: pointer;
            font-size: 0.9rem;
            transition: all 0.2s ease;
        }
        .btn-cancel:hover {
            background: rgba(51, 65, 85, 0.8);
            color: #e2e8f0;
            border-color: rgba(100, 116, 139, 0.6);
        }
        .btn-cancel:active {
            transform: scale(0.98);
        }
        .section-container {
            background: rgba(30, 41, 59, 0.4);
            backdrop-filter: blur(10px);
            border: 1px solid rgba(71, 85, 105, 0.3);
            border-radius: 8px;
            padding: 24px;
            margin-bottom: 24px;
            transition: all 0.3s ease;
        }
        .section-container:hover {
            border-color: rgba(59, 130, 246, 0.4);
            background: rgba(30, 41, 59, 0.5);
        }
        .btn-danger {
            background: linear-gradient(135deg, #ef4444 0%, #dc2626 100%);
            color: white;
            border: none;
            padding: 8px 14px;
            border-radius: 6px;
            cursor: pointer;
            font-weight: 600;
            font-size: 0.85rem;
            transition: all 0.2s ease;
            box-shadow: 0 2px 6px rgba(239, 68, 68, 0.25);
        }
        .btn-danger:hover {
            background: linear-gradient(135deg, #dc2626 0%, #b91c1c 100%);
            transform: translateY(-1px);
            box-shadow: 0 4px 10px rgba(239, 68, 68, 0.35);
        }
        .btn-danger:active {
            transform: translateY(0);
        }
        .btn-secondary {
            background: rgba(30, 41, 59, 0.8);
            color: #e2e8f0;
            border: 1px solid rgba(71, 85, 105, 0.4);
            padding: 10px;
            border-radius: 6px;
            font-weight: 600;
            cursor: pointer;
            font-size: 0.9rem;
            transition: all 0.2s ease;
        }
        .btn-secondary:hover {
            background: rgba(51, 65, 85, 0.9);
            border-color: rgba(100, 116, 139, 0.6);
        }
        .info-box {
            background: rgba(59, 130, 246, 0.08);
            border-left: 3px solid #3b82f6;
            border-radius: 4px;
            padding: 12px 16px;
            margin-top: 12px;
            font-size: 0.85rem;
            color: #94a3b8;
            display: flex;
            align-items: flex-start;
            gap: 10px;
        }
        .info-box::before {
            content: '💡';
            font-size: 1.1rem;
            flex-shrink: 0;
        }
        .variant-grid {
            display: grid;
            gap: 20px;
            margin-bottom: 24px;
        }
        .input-group {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 16px;
        }
        textarea.form-input {
            font-family: inherit;
        }
        select.form-input {
            cursor: pointer;
            appearance: none;
            background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='12' height='12' viewBox='0 0 12 12'%3E%3Cpath fill='%233b82f6' d='M6 9L1 4h10z'/%3E%3C/svg%3E");
            background-repeat: no-repeat;
            background-position: right 12px center;
            padding-right: 40px;
        }
        select.form-input:hover {
            background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='12' height='12' viewBox='0 0 12 12'%3E%3Cpath fill='%2360a5fa' d='M6 9L1 4h10z'/%3E%3C/svg%3E");
        }
        .modal-overlay {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: rgba(0, 0, 0, 0.7);
            z-index: 9999;
            justify-content: center;
            align-items: center;
            animation: fadeIn 0.3s ease;
            padding: 20px;
            overflow-y: auto;
        }
        .modal-overlay.active {
            display: flex;
            align-items: center;
            justify-content: center;
        }
        @keyframes fadeIn {
            from { opacity: 0; }
            to { opacity: 1; }
        }
        .modal-content {
            background: linear-gradient(135deg, rgba(15, 23, 42, 0.98) 0%, rgba(30, 41, 59, 0.98) 100%);
            backdrop-filter: blur(20px);
            border: 1px solid rgba(59, 130, 246, 0.4);
            border-radius: 12px;
            padding: 28px;
            max-width: 700px;
            width: 100%;
            max-height: 85vh;
            margin: auto;
            display: flex;
            flex-direction: column;
            animation: slideUp 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            box-shadow: 0 20px 60px rgba(0, 0, 0, 0.6), 0 0 100px rgba(59, 130, 246, 0.1);
        }
        @keyframes slideUp {
            from { transform: translateY(20px); opacity: 0; }
            to { transform: translateY(0); opacity: 1; }
        }
        .modal-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
            padding-bottom: 16px;
            border-bottom: 1px solid rgba(59, 130, 246, 0.3);
            flex-shrink: 0;
        }
        .modal-header h2 {
            color: #f1f5f9;
            font-weight: 600;
            margin: 0;
            font-size: 1.2rem;
            display: flex;
            align-items: center;
            gap: 10px;
        }
        .modal-close-btn {
            background: rgba(30, 41, 59, 0.8);
            color: #94a3b8;
            border: 1px solid rgba(71, 85, 105, 0.4);
            padding: 8px 14px;
            border-radius: 6px;
            font-weight: 600;
            cursor: pointer;
            font-size: 0.85rem;
            transition: all 0.2s ease;
            white-space: nowrap;
        }
        .modal-close-btn:hover {
            background: rgba(51, 65, 85, 0.9);
            color: #e2e8f0;
            border-color: rgba(100, 116, 139, 0.6);
        }
        
        /* Responsive Design */
        @media (max-width: 1024px) {
            .section-container {
                padding: 20px;
            }
            .input-group {
                grid-template-columns: 1fr;
            }
            .page-header {
                margin-bottom: 20px;
            }
            .section-header {
                flex-direction: column;
                align-items: flex-start;
                gap: 12px;
            }
        }

        @media (max-width: 768px) {
            .main-container {
                grid-template-columns: 1fr !important;
            }
            .section-container {
                padding: 16px;
                margin-bottom: 20px;
            }
            .section-header {
                font-size: 1.1rem;
                margin-bottom: 16px;
            }
            .form-label {
                font-size: 0.9rem;
            }
            .form-input {
                font-size: 0.95rem;
                padding: 10px 12px;
            }
            h1 {
                font-size: 2rem !important;
            }
            .btn-primary, .btn-cancel {
                padding: 10px 16px;
                font-size: 0.95rem;
            }
        }
    </style>

    <!-- Main Container -->
    <div style="display: grid; grid-template-columns: 1fr 360px; gap: 28px; margin-bottom: 40px;" class="main-container">
        <!-- Left Panel: Form -->
        <div style="min-width: 0;">
            <!-- Errors -->
            <?php if($errors->any()): ?>
                <div style="background: rgba(239, 68, 68, 0.1); border: 1px solid rgba(239, 68, 68, 0.3); border-left: 3px solid #ef4444; border-radius: 8px; padding: 20px; margin-bottom: 24px;">
                    <p style="color: #ef4444; font-weight: 600; margin: 0 0 12px 0; font-size: 1rem; display: flex; align-items: center; gap: 8px;">
                        <span style="font-size: 1.2rem;">⚠️</span> Validation Errors
                    </p>
                    <ul style="color: #fca5a5; margin: 0; padding-left: 24px; line-height: 1.8; font-size: 0.9rem;">
                        <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <li><?php echo e($error); ?></li>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </ul>
                </div>
            <?php endif; ?>

            <form id="productForm" action="<?php echo e(route('admin.inventory.update', $product)); ?>" method="POST" enctype="multipart/form-data">
                <?php echo csrf_field(); ?>
                <?php echo method_field('PATCH'); ?>

                <!-- Product Details Section -->
                <div class="section-container">
                    <div class="section-header">
                        <span style="display: flex; align-items: center; gap: 10px;">
                            <span style="font-size: 1.3rem;">📝</span>
                            <span>Product Information</span>
                        </span>
                    </div>

                    <div class="form-group">
                        <label class="form-label">Product Name *</label>
                        <input type="text" name="name" value="<?php echo e($product->name); ?>" required class="form-input" placeholder="Enter product name" />
                        <?php $__errorArgs = ['name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><span style="color: #ff9500; font-size: 0.95rem; font-weight: 600; margin-top: 6px; display: block;">❌ <?php echo e($message); ?></span><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                    </div>

                    <div class="form-group">
                        <label class="form-label">Description</label>
                        <textarea name="description" rows="5" class="form-input" style="resize: none; font-size: 1rem;" placeholder="Add product description..."><?php echo e($product->description); ?></textarea>
                        <?php $__errorArgs = ['description'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><span style="color: #ff9500; font-size: 0.95rem; font-weight: 600; margin-top: 6px; display: block;">❌ <?php echo e($message); ?></span><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                    </div>

                    <div class="input-group">
                        <div class="form-group" style="margin-bottom: 0;">
                            <label class="form-label">Base Price (₱) *</label>
                            <input type="number" name="base_price" value="<?php echo e($product->base_price); ?>" step="0.01" required class="form-input" placeholder="0.00" />
                            <?php $__errorArgs = ['base_price'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><span style="color: #ff9500; font-size: 0.95rem; font-weight: 600; margin-top: 6px; display: block;">❌ <?php echo e($message); ?></span><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                        </div>

                        <div class="form-group" style="margin-bottom: 0;">
                            <label class="form-label">Status *</label>
                            <select name="status" class="form-input" style="cursor: pointer; appearance: none; background-image: url('data:image/svg+xml;charset=UTF-8,%3csvg xmlns=%27http://www.w3.org/2000/svg%27 width=%2712%27 height=%278%27 viewBox=%270 0 12 8%27%3e%3cpath fill=%27%2394a3b8%27 d=%27M6 8L0 0h12z%27/%3e%3c/svg%3e'); background-repeat: no-repeat; background-position: right 16px center; background-size: 12px; padding-right: 40px;">
                                <option value="active" <?php echo e($product->status === 'active' ? 'selected' : ''); ?>>🟢 Active</option>
                                <option value="inactive" <?php echo e($product->status === 'inactive' ? 'selected' : ''); ?>>🔴 Inactive</option>
                            </select>
                            <?php $__errorArgs = ['status'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><span style="color: #ff9500; font-size: 0.95rem; font-weight: 600; margin-top: 6px; display: block;">❌ <?php echo e($message); ?></span><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="form-label">Low Stock Threshold</label>
                        <input type="number" name="low_stock_threshold" value="<?php echo e($product->low_stock_threshold); ?>" class="form-input" min="1" required>
                        <div class="info-box" style="margin-top: 8px;">
                            <span style="color: #cbd5e1;">Receive alerts when stock falls below this level</span>
                        </div>
                        <?php $__errorArgs = ['low_stock_threshold'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><span style="color: #ff9500; font-size: 0.95rem; font-weight: 600; margin-top: 6px; display: block;">❌ <?php echo e($message); ?></span><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                    </div>
                </div>

                <!-- Stock/Variants Section -->
                <?php if($product->variants->count() > 0): ?>
                    <!-- Variants Exist -->
                    <div class="section-container">
                        <div class="section-header">
                            <span style="display: flex; align-items: center; gap: 10px;">
                                <span style="font-size: 1.3rem;">📦</span>
                                <span>Manage Variants</span>
                            </span>
                            <span style="color: #94a3b8; font-size: 0.85rem; font-weight: 500;">Must keep 2+ or remove all</span>
                        </div>

                        <!-- Variants Summary Card -->
                        <div style="background: rgba(59, 130, 246, 0.1); border: 1px solid rgba(59, 130, 246, 0.3); border-radius: 8px; padding: 20px; margin-bottom: 24px; backdrop-filter: blur(10px);">
                            <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(200px, 1fr)); gap: 20px;">
                                <div style="text-align: center;">
                                    <p style="color: #94a3b8; font-size: 0.85rem; margin: 0 0 6px 0;">Total Stock</p>
                                    <span style="color: #3b82f6; font-weight: 700; font-size: 2rem;"><?php echo e($product->variants->sum('stock_quantity')); ?></span>
                                    <span style="color: #94a3b8; font-size: 0.85rem; margin-left: 6px;">units</span>
                                </div>
                                <div style="text-align: center;">
                                    <p style="color: #94a3b8; font-size: 0.85rem; margin: 0 0 6px 0;">Low Stock Variants</p>
                                    <span style="color: #ff9500; font-weight: 700; font-size: 2rem;"><?php echo e($product->variants->where('stock_quantity', '<=', 20)->count()); ?></span>
                                </div>
                                <div style="text-align: center;">
                                    <p style="color: #94a3b8; font-size: 0.85rem; margin: 0 0 6px 0;">Avg. Price Modifier</p>
                                    <span style="color: #22c55e; font-weight: 700; font-size: 2rem;">₱<?php echo e(number_format($product->variants->avg('price_modifier') ?? 0, 2)); ?></span>
                                </div>
                            </div>
                        </div>

                        <!-- Variants Table View -->
                        <div style="background: rgba(15, 23, 42, 0.6); border: 1px solid rgba(59, 130, 246, 0.3); border-radius: 8px; overflow: hidden; margin-bottom: 24px;">
                            <table style="width: 100%; border-collapse: collapse;">
                                <thead>
                                    <tr style="background: linear-gradient(135deg, #3b82f6 0%, #2563eb 100%); border-bottom: 1px solid rgba(59, 130, 246, 0.3);">
                                        <th style="padding: 14px 16px; text-align: left; color: #ffffff; font-weight: 600; font-size: 0.85rem; letter-spacing: 0.3px;">Variant Name</th>
                                        <th style="padding: 14px 16px; text-align: center; color: #ffffff; font-weight: 600; font-size: 0.85rem; letter-spacing: 0.3px;">Stock</th>
                                        <th style="padding: 14px 16px; text-align: center; color: #ffffff; font-weight: 600; font-size: 0.85rem; letter-spacing: 0.3px;">Price Modifier</th>
                                        <th style="padding: 14px 16px; text-align: center; color: #ffffff; font-weight: 600; font-size: 0.85rem; letter-spacing: 0.3px;">Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $__currentLoopData = $product->variants; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $variant): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <tr class="variant-row" data-variant-id="<?php echo e($variant->id); ?>" style="border-bottom: 1px solid rgba(71, 85, 105, 0.2); transition: all 0.25s cubic-bezier(0.4, 0, 0.2, 1);" onmouseover="this.style.backgroundColor='rgba(59, 130, 246, 0.08)';" onmouseout="this.style.backgroundColor='transparent';">
                                            <td style="padding: 14px 16px;">
                                                <input type="text" class="variantName form-input variant-input" name="variants[<?php echo e($index); ?>][name]" value="<?php echo e($variant->name); ?>" placeholder="Variant name" style="padding: 10px 12px; font-size: 0.95rem;" />
                                            </td>
                                            <td style="padding: 14px 16px; text-align: center;">
                                                <input type="number" class="variantStock form-input variant-input" name="variants[<?php echo e($index); ?>][stock_quantity]" value="<?php echo e($variant->stock_quantity); ?>" min="0" placeholder="0" style="padding: 10px 12px; font-size: 0.95rem; text-align: center; width: 100px; margin: 0 auto;" />
                                                <?php if($variant->stock_quantity <= 20): ?>
                                                    <span style="display: block; color: #ff9500; font-size: 0.75rem; margin-top: 4px; font-weight: 600;">⚠️ Low Stock</span>
                                                <?php endif; ?>
                                            </td>
                                            <td style="padding: 14px 16px; text-align: center;">
                                                <input type="number" class="variantPriceModifier form-input variant-input" name="variants[<?php echo e($index); ?>][price_modifier]" value="<?php echo e($variant->price_modifier); ?>" step="0.01" placeholder="0.00" style="padding: 10px 12px; font-size: 0.95rem; text-align: center; width: 120px; margin: 0 auto;" />
                                            </td>
                                            <td style="padding: 14px 16px; text-align: center;">
                                                <button type="button" class="deleteVariantBtn btn-danger" data-variant-id="<?php echo e($variant->id); ?>" onclick="deleteVariant(this, event);" style="padding: 8px 14px; font-size: 0.9rem; white-space: nowrap;">
                                                    🗑️
                                                </button>
                                            </td>
                                            <input type="hidden" class="variantDeletedFlag" name="variants[<?php echo e($index); ?>][delete]" value="0" />
                                            <input type="hidden" class="variantIdField" name="variants[<?php echo e($index); ?>][id]" value="<?php echo e($variant->id); ?>" />
                                        </tr>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </tbody>
                            </table>
                        </div>

                        <!-- Add New Variants Section (Inline) -->
                        <div style="margin-top: 24px;">
                            <div id="newVariantsList" style="display: grid; gap: 16px; margin-bottom: 20px;"></div>
                            
                            <!-- Add Variant Button -->
                            <button type="button" id="addNewVariantBtn" class="btn-primary" style="width: 100%; padding: 14px; font-size: 0.95rem; display: flex; align-items: center; justify-content: center; gap: 8px;">
                                <span style="font-size: 1.2rem;">+</span>
                                <span>Add New Variant</span>
                            </button>

                            <!-- Validation Warning -->
                            <div id="variantWarningEdit" style="display: none; background: rgba(239, 68, 68, 0.1); border: 1px solid rgba(239, 68, 68, 0.3); border-radius: 8px; padding: 12px 16px; margin-top: 16px;">
                                <div style="display: flex; align-items: center; gap: 10px;">
                                    <span style="font-size: 1.2rem;">⚠️</span>
                                    <p style="color: #fca5a5; font-size: 0.85rem; margin: 0; font-weight: 600;">
                                        After deletion, you'll have only 1 variant. Add at least one more, or delete all variants.
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php else: ?>
                    <!-- Legacy Product - Stock Input -->
                    <div class="section-container">
                        <div class="section-header">📊 Stock Management</div>

                        <div style="background: rgba(30, 41, 59, 0.4); backdrop-filter: blur(10px); border: 1px solid rgba(59, 130, 246, 0.3); border-radius: 8px; padding: 24px; margin-bottom: 24px;">
                            <label class="form-label" style="font-size: 1rem; margin-bottom: 12px;">Current Stock *</label>
                            <input type="number" name="current_stock" value="<?php echo e($product->current_stock); ?>" min="0" required class="form-input" placeholder="0" />
                            <?php $__errorArgs = ['current_stock'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><span style="color: #ff9500; font-size: 0.95rem; font-weight: 600; margin-top: 6px; display: block;">❌ <?php echo e($message); ?></span><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>

                            <div class="info-box" style="margin-top: 16px;">
                                <div style="display: flex; justify-content: space-between; align-items: center; gap: 16px;">
                                    <div>
                                        <p style="color: #94a3b8; font-size: 0.85rem; margin: 0 0 6px 0;">Total Available</p>
                                        <span style="color: #e2e8f0; font-weight: 700; font-size: 1.5rem;"><?php echo e($product->current_stock); ?></span>
                                        <span style="color: #b0bcc4; font-size: 0.95rem; margin-left: 8px;">units</span>
                                    </div>
                                    <span style="background: <?php echo e($product->current_stock <= $product->low_stock_threshold ? '#1a7fff' : '#4caf50'); ?>; color: white; padding: 14px 18px; border-radius: 10px; font-weight: 700; font-size: 1.1rem; white-space: nowrap; text-align: center;">
                                        <?php echo e($product->current_stock <= $product->low_stock_threshold ? '⚠️ Low Stock' : '✓ Adequate'); ?>

                                    </span>
                                </div>
                            </div>
                        </div>

                        <!-- Variants Option -->
                        <div style="background: rgba(30, 41, 59, 0.4); backdrop-filter: blur(10px); border: 1px solid rgba(59, 130, 246, 0.3); border-radius: 8px; padding: 32px; text-align: center; margin-bottom: 24px;">
                            <div style="font-size: 3.5rem; margin-bottom: 12px; line-height: 1;">💎</div>
                            <p style="color: #e2e8f0; font-weight: 600; margin: 0 0 8px 0; font-size: 1.1rem;">Upgrade to Variants</p>
                            <p style="color: #94a3b8; font-size: 0.95rem; margin: 0 0 20px 0; line-height: 1.6;">Organize inventory with variants for different sizes, colors, and weights.</p>
                            <button type="button" id="toggleVariantsBtn" class="btn-primary" style="width: 100%; padding: 14px; font-size: 1rem;">
                                ✚ Create Variants
                            </button>
                        </div>

                        <!-- Variants Form -->
                        <div id="variantsFormSection" style="display: none; padding: 32px; background: rgba(30, 41, 59, 0.4); backdrop-filter: blur(10px); border: 1px solid rgba(59, 130, 246, 0.3); border-radius: 8px;">
                            <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 24px; padding-bottom: 16px; border-bottom: 1px solid rgba(71, 85, 105, 0.3);">
                                <h4 style="color: #e2e8f0; font-weight: 600; margin: 0; font-size: 1.1rem; display: flex; align-items: center; gap: 8px;"><span>➕</span><span>Create Variants</span></h4>
                                <button type="button" id="closeVariantsBtn" class="btn-danger" style="padding: 8px 14px; font-size: 0.95rem;">✕ Close</button>
                            </div>

                            <div id="variantsContainer" style="display: grid; gap: 20px; margin-bottom: 24px;"></div>

                            <button type="button" id="addVariantBtn" class="btn-secondary" style="width: 100%; padding: 12px; font-size: 1rem;">
                                ✚ Add Another Variant
                            </button>
                        </div>
                    </div>
                <?php endif; ?>

                <!-- Action Buttons -->
                <div style="display: flex; gap: 12px; margin-top: 32px; padding-top: 20px; border-top: 1px solid rgba(71, 85, 105, 0.3); flex-wrap: wrap;">
                    <button type="button" id="saveBtn" style="flex: 1; min-width: 140px; padding: 12px 20px; background: linear-gradient(135deg, #3b82f6 0%, #2563eb 100%); color: white; border: none; border-radius: 6px; font-weight: 600; cursor: pointer; font-size: 1rem; transition: all 0.2s ease; letter-spacing: 0.3px; box-shadow: 0 2px 8px rgba(59, 130, 246, 0.3); display: flex; align-items: center; justify-content: center; gap: 8px;" onmouseover="this.style.boxShadow='0 4px 16px rgba(59, 130, 246, 0.4)'; this.style.transform='translateY(-1px)';" onmouseout="this.style.boxShadow='0 2px 8px rgba(59, 130, 246, 0.3)'; this.style.transform='translateY(0)';">
                        <span style="font-size: 1.1rem;">✓</span>
                        <span>Save Changes</span>
                    </button>
                    <a href="<?php echo e(route('admin.inventory.index')); ?>" class="btn-cancel" style="flex: 1; min-width: 140px; padding: 12px 20px; font-size: 1rem; font-weight: 600; letter-spacing: 0.3px; text-align: center; text-decoration: none; display: flex; align-items: center; justify-content: center; gap: 8px;">
                        <span style="font-size: 1.1rem;">✕</span>
                        <span>Cancel</span>
                    </a>
                </div>
                
                <!-- Hidden Image Input - Inside Form for Submission -->
                <input type="file" id="imageInput" name="image" accept="image/*" style="display: none;" />
                <!-- Hidden flag used when removing an existing image from edit page -->
                <input type="hidden" name="remove_existing_image" value="0" />
            </form>

            <!-- floating save bar removed on edit page as requested -->
        </div>

        <!-- Right Panel: Image -->
        <div style="background: rgba(30, 41, 59, 0.4); backdrop-filter: blur(10px); border: 1px solid rgba(71, 85, 105, 0.3); border-radius: 8px; padding: 20px; height: fit-content; position: sticky; top: 20px; z-index: 1; transition: all 0.3s ease;" onmouseover="this.style.borderColor='rgba(59, 130, 246, 0.4)'; this.style.background='rgba(30, 41, 59, 0.5)';" onmouseout="this.style.borderColor='rgba(71, 85, 105, 0.3)'; this.style.background='rgba(30, 41, 59, 0.4)';">
            <h3 style="color: #cbd5e1; font-weight: 600; margin: 0 0 16px 0; font-size: 0.95rem; letter-spacing: 0.3px; display: flex; align-items: center; gap: 8px;">
                <span style="font-size: 1.2rem;">🖼️</span>
                <span>Product Image</span>
            </h3>

            <label for="imageInput" id="imagePreview" style="width: 100%; aspect-ratio: 1; background: rgba(15, 23, 42, 0.6); border: 2px dashed rgba(100, 116, 139, 0.5); border-radius: 6px; display: flex; align-items: center; justify-content: center; cursor: pointer; margin-bottom: 16px; overflow: hidden; transition: all 0.25s ease;" onmouseover="this.style.borderColor='#3b82f6'; this.style.backgroundColor='rgba(59, 130, 246, 0.05)'; this.style.boxShadow='0 0 20px rgba(59, 130, 246, 0.15)'; this.style.transform='scale(1.01)';" onmouseout="this.style.borderColor='rgba(100, 116, 139, 0.5)'; this.style.backgroundColor='rgba(15, 23, 42, 0.6)'; this.style.boxShadow='none'; this.style.transform='scale(1)';">
                <?php if($product->image_path): ?>
                    <img src="<?php echo e($product->image_url); ?>" alt="<?php echo e($product->name); ?>" style="width: 100%; height: 100%; object-fit: cover;" />
                <?php else: ?>
                    <div style="text-align: center;">
                        <div style="font-size: 56px; margin-bottom: 12px; opacity: 0.7;">📸</div>
                        <p style="color: #cbd5e1; font-weight: 600; margin: 0; font-size: 1rem;">Click to Upload</p>
                        <p style="color: #64748b; font-size: 0.85rem; margin: 6px 0 0 0;">or drag & drop</p>
                    </div>
                <?php endif; ?>
            </label>

            <div id="imageStatus" style="display:none; color: #94a3b8; font-size: 0.85rem; margin-bottom: 8px; text-align:center"></div>
            <!-- Visible debug log pane for image events (helps when devtools are closed) -->
            <div id="imageDebug" style="display:none; color:#94a3b8; font-size:0.8rem; margin-top:6px; padding:8px; background: rgba(2,6,23,0.3); border-radius:6px; max-height:120px; overflow:auto; white-space:pre-wrap; font-family: monospace;">Debug log (events will appear here)</div>

            <div style="background: rgba(59, 130, 246, 0.08); border: 1px solid rgba(59, 130, 246, 0.2); border-radius: 6px; padding: 12px; text-align: center; margin-bottom: 16px;">
                <p style="color: #cbd5e1; font-weight: 600; margin: 0 0 4px 0; font-size: 0.85rem; display: flex; align-items: center; justify-content: center; gap: 6px;">
                    <span>📋</span>
                    <span>Image Guidelines</span>
                </p>
                <p style="color: #94a3b8; font-size: 0.8rem; margin: 0; line-height: 1.5;">JPG, PNG, GIF, WebP • Max 5MB</p>
            </div>

            <?php if($product->image_path): ?>
                <button type="button" id="removeImageBtn" class="btn-danger" style="width: 100%; padding: 14px; font-size: 1.1rem; font-weight: 700;">
                    🗑️ Remove Image
                </button>
            <?php endif; ?>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        console.log('Edit page JavaScript loaded - Version 2.0');
        
        // Variant Management for Edit Page
        let newVariantIndex = 0;

        // Create new variant card
        window.createNewVariantCard = function(index, data = {}) {
            const card = document.createElement('div');
            card.className = 'new-variant-card';
            card.dataset.newVariantIndex = index;
            card.style.cssText = 'background: linear-gradient(135deg, rgba(34, 197, 94, 0.1) 0%, rgba(21, 128, 61, 0.05) 100%); border: 2px solid rgba(34, 197, 94, 0.3); border-radius: 10px; padding: 20px; position: relative;';
            
            card.innerHTML = `
                <div style="position: absolute; top: -10px; left: 20px; background: rgba(34, 197, 94, 0.9); color: white; padding: 4px 12px; border-radius: 20px; font-size: 0.75rem; font-weight: 700; letter-spacing: 0.5px;">NEW</div>
                <div style="position: absolute; top: 12px; right: 12px;">
                    <button type="button" onclick="window.removeNewVariant(${index})" style="background: rgba(239, 68, 68, 0.2); border: 1px solid rgba(239, 68, 68, 0.4); color: #fca5a5; padding: 6px 12px; border-radius: 6px; cursor: pointer; font-size: 0.8rem; font-weight: 600; transition: all 0.2s;" onmouseover="this.style.background='rgba(239, 68, 68, 0.3)';" onmouseout="this.style.background='rgba(239, 68, 68, 0.2)';">
                        🗑️ Remove
                    </button>
                </div>

                <div style="margin-bottom: 16px; margin-top: 10px;">
                    <label style="display: block; color: #e2e8f0; font-weight: 600; margin-bottom: 8px; font-size: 0.9rem;">Variant Name *</label>
                    <input type="text" name="new_variants[${index}][name]" value="${data.name || ''}" class="form-input" placeholder="e.g., Red - Large, Blue - Medium" required style="font-size: 0.95rem;" />
                </div>

                <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 16px;">
                    <div>
                        <label style="display: block; color: #e2e8f0; font-weight: 600; margin-bottom: 8px; font-size: 0.9rem;">Stock Quantity *</label>
                        <input type="number" name="new_variants[${index}][stock_quantity]" value="${data.stock_quantity || ''}" class="form-input" min="0" placeholder="0" required style="font-size: 0.95rem;" />
                    </div>
                    <div>
                        <label style="display: block; color: #e2e8f0; font-weight: 600; margin-bottom: 8px; font-size: 0.9rem;">Price Change (₱)</label>
                        <input type="number" name="new_variants[${index}][price_modifier]" value="${data.price_modifier || ''}" class="form-input" step="0.01" placeholder="0.00" style="font-size: 0.95rem;" />
                    </div>
                </div>
            `;
            
            return card;
        }

        // Add new variant
        const addNewVariantBtn = document.getElementById('addNewVariantBtn');
        if (addNewVariantBtn) {
            addNewVariantBtn.addEventListener('click', function() {
                const container = document.getElementById('newVariantsList');
                const card = window.createNewVariantCard(newVariantIndex++);
                container.appendChild(card);
                
                // Scroll to new variant
                setTimeout(() => {
                    card.scrollIntoView({ behavior: 'smooth', block: 'nearest' });
                }, 100);
            });
        }

        // Remove new variant
        window.removeNewVariant = function(index) {
            const card = document.querySelector(`[data-new-variant-index="${index}"]`);
            if (card) {
                card.style.opacity = '0';
                card.style.transform = 'translateX(-20px)';
                setTimeout(() => {
                    card.remove();
                    window.reindexNewVariants();
                }, 300);
            }
        }

        // Reindex new variants
        window.reindexNewVariants = function() {
            const cards = document.querySelectorAll('.new-variant-card');
            cards.forEach((card, newIndex) => {
                card.dataset.newVariantIndex = newIndex;
                card.querySelectorAll('input').forEach(input => {
                    const name = input.getAttribute('name');
                    if (name) {
                        input.setAttribute('name', name.replace(/\[\d+\]/, `[${newIndex}]`));
                    }
                });
                const removeBtn = card.querySelector('button[onclick^="window.removeNewVariant"]');
                if (removeBtn) {
                    removeBtn.setAttribute('onclick', `window.removeNewVariant(${newIndex})`);
                }
            });
            newVariantIndex = cards.length;
        }

        // Mark existing variant for deletion (toggle)
        window.deleteVariant = function(button, event) {
            event.preventDefault();
            const row = button.closest('tr');
            const deleteField = row.querySelector('input[name*="[delete]"]');
            
            if (deleteField.value === '1') {
                // Restore
                deleteField.value = '0';
                row.style.opacity = '1';
                row.style.background = 'transparent';
                button.textContent = '🗑️';
                button.style.background = 'linear-gradient(135deg, #ef4444 0%, #dc2626 100%)';
            } else {
                // Mark for deletion
                deleteField.value = '1';
                row.style.opacity = '0.5';
                row.style.background = 'rgba(239, 68, 68, 0.1)';
                button.textContent = '↶';
                button.style.background = 'linear-gradient(135deg, #22c55e 0%, #16a34a 100%)';
            }
        }

        // For products without variants (legacy) - Create legacy variant card
        window.createLegacyVariantCard = function() {
            const card = document.createElement('div');
            card.style.cssText = 'background: linear-gradient(135deg, rgba(234, 179, 8, 0.1) 0%, rgba(202, 138, 4, 0.05) 100%); border: 2px solid rgba(234, 179, 8, 0.3); border-radius: 10px; padding: 20px; position: relative;';
            
            card.innerHTML = `
                <div style="position: absolute; top: -10px; left: 20px; background: rgba(234, 179, 8, 0.9); color: white; padding: 4px 12px; border-radius: 20px; font-size: 0.75rem; font-weight: 700; letter-spacing: 0.5px;">LEGACY</div>
                <p style="color: #cbd5e1; margin-bottom: 16px; font-size: 0.95rem;">This product was created before variants. Add variants below:</p>
                
                <div style="margin-bottom: 16px;">
                    <label style="display: block; color: #e2e8f0; font-weight: 600; margin-bottom: 8px; font-size: 0.9rem;">Variant Name *</label>
                    <input type="text" name="legacy_variant_name" class="form-input" placeholder="e.g., Default" required style="font-size: 0.95rem;" />
                </div>

                <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 16px;">
                    <div>
                        <label style="display: block; color: #e2e8f0; font-weight: 600; margin-bottom: 8px; font-size: 0.9rem;">Stock Quantity *</label>
                        <input type="number" name="legacy_variant_stock" class="form-input" min="0" value="<?php echo e($product->stock_quantity ?? 0); ?>" required style="font-size: 0.95rem;" />
                    </div>
                    <div>
                        <label style="display: block; color: #e2e8f0; font-weight: 600; margin-bottom: 8px; font-size: 0.9rem;">Price Change (₱)</label>
                        <input type="number" name="legacy_variant_price" class="form-input" step="0.01" value="0.00" style="font-size: 0.95rem;" />
                    </div>
                </div>
            `;
            
            return card;
        }

        // Initialize legacy variant card if no variants exist
        const hasVariants = <?php echo e($product->variants->count() > 0 ? 'true' : 'false'); ?>;
        if (!hasVariants) {
            const existingVariantsSection = document.querySelector('.variant-grid')?.closest('.bg-gray-800');
            if (existingVariantsSection) {
                existingVariantsSection.style.display = 'none';
            }
            
            // Show helpful message for legacy products
            const newVariantsSection = document.getElementById('newVariantsList')?.closest('.bg-gray-800');
            if (newVariantsSection) {
                const notice = document.createElement('div');
                notice.style.cssText = 'background: rgba(234, 179, 8, 0.1); border: 2px solid rgba(234, 179, 8, 0.3); border-radius: 10px; padding: 16px; margin-bottom: 16px; color: #fef08a; font-size: 0.9rem;';
                notice.innerHTML = '<strong>ℹ️ Note:</strong> This product was created before variants. Click "Add New Variant" to add variant options.';
                newVariantsSection.insertBefore(notice, newVariantsSection.firstChild.nextSibling);
            }
        }

        // Form submission validation
        const productForm = document.querySelector('#productForm');
        console.log('Form found:', productForm);
        
        if (productForm) {
            productForm.addEventListener('submit', function(e) {
                console.log('Form submit triggered!');
                
                // Debug: Check what data will be submitted
                const formData = new FormData(productForm);
                console.log('Form data entries:');
                for (let [key, value] of formData.entries()) {
                    if (key.includes('variant')) {
                        console.log(key, '=', value);
                    }
                }
                
                const existingVariants = document.querySelectorAll('.variant-row');
                const newVariants = document.querySelectorAll('.new-variant-card');
                const deletedVariants = Array.from(document.querySelectorAll('input[name*="[delete]"]'))
                    .filter(input => input.value === '1').length;
                
                const remainingExisting = existingVariants.length - deletedVariants;
                const totalVariants = remainingExisting + newVariants.length;
                
                console.log('Validation Check:', {
                    existingVariants: existingVariants.length,
                    newVariants: newVariants.length,
                    deletedVariants: deletedVariants,
                    remainingExisting: remainingExisting,
                    totalVariants: totalVariants
                });
                
                // No validation - allow any number of variants
                console.log('Submitting form...');
            });
        } else {
            console.error('Form #productForm not found!');
        }

        // Show warning message if it exists
        <?php if(session('warning')): ?>
            Swal.fire({
                title: 'Warning',
                text: '<?php echo e(session('warning')); ?>',
                icon: 'warning',
                iconColor: '#f59e0b',
                background: 'rgba(15, 23, 42, 0.98)',
                color: '#e2e8f0',
                confirmButtonColor: '#3b82f6',
                backdrop: 'rgba(0, 0, 0, 0.7)'
            });
        <?php endif; ?>

        // Image upload (robust + debug)
        const imageInput = document.getElementById('imageInput');
        const imagePreview = document.getElementById('imagePreview');
        let removeImageBtn = document.getElementById('removeImageBtn');

        function ensureRemoveBtnEdit() {
            const imagePanel = imagePreview.parentElement;

            if (!removeImageBtn) {
                removeImageBtn = document.createElement('button');
                removeImageBtn.id = 'removeImageBtn';
                removeImageBtn.type = 'button';
                removeImageBtn.className = 'btn-danger';
                removeImageBtn.style.cssText = 'width: 100%; padding: 14px; font-size: 1.1rem; font-weight: 700; margin-top: 28px; display: none;';
                removeImageBtn.innerHTML = '🗑️ Remove Image';
                imagePanel.appendChild(removeImageBtn);
            }

            if (!removeImageBtn.dataset.listenerAttached) {
                removeImageBtn.addEventListener('click', function(e) {
                    e.preventDefault();
                    e.stopPropagation();
                    try { imageInput.value = ''; } catch (err) { /* suppressed in production */ }
                    const statusEl = document.getElementById('imageStatus');
                    if (statusEl) { statusEl.style.display = 'none'; }
                    imagePreview.innerHTML = `<div style="text-align: center;">
                        <div style="font-size: 64px; margin-bottom: 12px; animation: pulse 2s infinite;">📸</div>
                        <p style="color: #ffffff; font-weight: 700; margin: 0; font-size: 1.1rem;">Click to Upload</p>
                        <p style="color: #b0bcc4; font-size: 0.95rem; margin: 8px 0 0 0;">or drag & drop</p>
                    </div>`;
                    this.style.display = 'none';

                    // mark hidden flag for backend to remove existing stored image
                    const removeExisting = document.querySelector('input[name="remove_existing_image"]');
                    if (removeExisting) removeExisting.value = '1';

                    appendImageDebug('remove clicked - cleared input/preview');
                });
                removeImageBtn.dataset.listenerAttached = '1';
            }

            return removeImageBtn;
        }

        let pickerRequested = false;
        let imagePickerInProgress = false;

        function appendImageDebug(msg) {
            try {
                // suppressed debug logging
                const el = document.getElementById('imageDebug');
                if (!el) return;
                const time = new Date().toLocaleTimeString();
                el.textContent = `[${time}] ${msg}\n` + el.textContent;
            } catch (err) {
                // suppressed debug logging
            }
        }

        // indicate the image handlers are ready
        try { appendImageDebug('edit image-js ready'); } catch (err) { /* suppressed in production */ }

        imageInput.addEventListener('change', function(e) {
                // suppressed debug logging
                appendImageDebug('change: files=' + (this.files && this.files.length ? Array.from(this.files).map(f => f.name).join(',') : 'none'));
                // If change fired but no file is present (race), re-check shortly to allow browser to populate files
                if (!(this.files && this.files.length)) {
                    appendImageDebug('change event had no files, scheduling quick re-check');
                    setTimeout(() => {
                        appendImageDebug('re-check files=' + (this.files && this.files.length ? Array.from(this.files).map(f=>f.name).join(',') : 'none'));
                        if (this.files && this.files.length) {
                            // manually trigger handler logic by reusing same reader code
                            const file = this.files[0];
                            const reader = new FileReader();
                            reader.onload = (event) => {
                                appendImageDebug('re-check reader.onload: ' + (file && file.name));
                                imagePreview.innerHTML = `<img src="${event.target.result}" style="width: 100%; height: 100%; object-fit: cover;" />`;
                                const btn = ensureRemoveBtnEdit();
                                if (btn) btn.style.display = 'block';
                                const statusEl = document.getElementById('imageStatus');
                                if (statusEl) {
                                    statusEl.textContent = 'Selected: ' + (file.name || 'image');
                                    statusEl.style.display = 'block';
                                    setTimeout(() => { statusEl.style.display = 'none'; }, 2000);
                                }
                                pickerRequested = false;
                                imageInput.dataset.opening = '';
                                imagePickerInProgress = false;
                            };
                            reader.readAsDataURL(file);
                        }
                    }, 120);
                }
            const file = this.files && this.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = (event) => {
                    // suppressed debug logging
                    appendImageDebug('reader.onload: ' + (file && file.name));
                    imagePreview.innerHTML = `<img src="${event.target.result}" style="width: 100%; height: 100%; object-fit: cover;" />`;
                    const btn = ensureRemoveBtnEdit();
                    if (btn) btn.style.display = 'block';
                    const statusEl = document.getElementById('imageStatus');
                    if (statusEl) {
                        statusEl.textContent = 'Selected: ' + (file.name || 'image');
                        statusEl.style.display = 'block';
                        setTimeout(() => { statusEl.style.display = 'none'; }, 2000);
                    }
                    // Picker has returned with a file, clear any requested/opening flags
                    pickerRequested = false;
                    imageInput.dataset.opening = '';
                    imagePickerInProgress = false;
                };
                reader.readAsDataURL(file);
            } else {
                // suppressed debug logging
                appendImageDebug('no file selected');
            }
        });

        // If there's already a remove button rendered from server, attach safe handler
        const existingRemoveBtn = document.getElementById('removeImageBtn');
        if (existingRemoveBtn && !existingRemoveBtn.dataset.listenerAttached) {
            existingRemoveBtn.addEventListener('click', function(e) {
                e.preventDefault();
                e.stopPropagation();
                try { imageInput.value = ''; } catch (err) { /* suppressed in production */ }
                const statusEl = document.getElementById('imageStatus');
                if (statusEl) { statusEl.style.display = 'none'; }
                imagePreview.innerHTML = `<div style="text-align: center;">
                    <div style="font-size: 64px; margin-bottom: 12px; animation: pulse 2s infinite;">📸</div>
                    <p style="color: #ffffff; font-weight: 700; margin: 0; font-size: 1.1rem;">Click to Upload</p>
                    <p style="color: #b0bcc4; font-size: 0.95rem; margin: 8px 0 0 0;">or drag & drop</p>
                </div>`;
                this.style.display = 'none';

                // set hidden flag to let backend know existing image should be removed
                const removeExisting = document.querySelector('input[name="remove_existing_image"]');
                if (removeExisting) removeExisting.value = '1';

                this.dataset.listenerAttached = '1';
                appendImageDebug('existing remove clicked - cleared input/preview');
            });
        }

        // Make click/open handling robust for browsers (avoid double re-open)
        // Clear the input on pointerdown so selecting the same file still fires change
        imagePreview.addEventListener('pointerdown', function(e) {
            // Always clear previous selection so choosing the same file triggers change
            // But if user clicked the remove button, don't clear here
            if (!e.target.closest('#removeImageBtn')) {
                try { imageInput.value = ''; } catch (err) { /* suppressed in production */ }
                appendImageDebug('pointerdown: cleared input.value');
            } else {
                appendImageDebug('pointerdown: remove button targeted');
            }
        });

        // Helpful click trace to verify label/open flow
        imagePreview.addEventListener('click', function(e) {
            appendImageDebug('imagePreview.click event, target=' + (e.target.tagName || e.target.nodeName));
        });

        // Trace actual input click as well
        imageInput.addEventListener('click', function(e) {
            appendImageDebug('input.click event');
            // suppressed debug logging
            // Mark dataset.opening (used for focus cleanup) so we can detect picker lifecycle
            try { imageInput.dataset.opening = '1'; } catch (err) { /* ignore */ }
        });

        // Using native label behaviour to open file picker; pointerdown handles clearing selection

        // When the window regains focus after the file picker, clear opening state
        window.addEventListener('focus', function() {
            if (imageInput && imageInput.dataset && imageInput.dataset.opening) {
                // suppressed debug logging
                appendImageDebug('focus detected - clearing opening flag');
                imageInput.dataset.opening = '';
            }
            // clear progress flag on focus to avoid stuck state
            imagePickerInProgress = false;
            // Show debug area only in debug mode
            try {
                if (window.APP_DEBUG) {
                    const debugEl = document.getElementById('imageDebug');
                    if (debugEl) debugEl.style.display = 'block';
                }
            } catch (e) { /* silent */ }
        });

        // Save button
        document.getElementById('saveBtn').addEventListener('click', function(e) {
            e.preventDefault();
            
            // Remove empty legacy variant cards before validation
            const legacyCards = document.querySelectorAll('.legacy-variant-card');
            legacyCards.forEach(card => {
                const nameInput = card.querySelector('input[name*="[name]"]');
                const stockInput = card.querySelector('input[name*="[stock_quantity]"]');
                const isEmpty = (!nameInput || !nameInput.value.trim()) && (!stockInput || !stockInput.value.trim());
                if (isEmpty) {
                    card.remove();
                }
            });
            
            // No validation - allow any number of variants
            
            Swal.fire({
                title: 'Save Changes?',
                text: 'Are you sure you want to save all changes?',
                icon: 'question',
                iconColor: '#3b82f6',
                background: 'rgba(15, 23, 42, 0.98)',
                color: '#e2e8f0',
                showCancelButton: true,
                confirmButtonColor: '#3b82f6',
                cancelButtonColor: 'rgba(148, 163, 184, 0.2)',
                confirmButtonText: 'Yes, Save',
                backdrop: 'rgba(0, 0, 0, 0.7)'
            }).then(result => {
                if (result.isConfirmed) {
                    // Show loading alert
                    Swal.fire({
                        title: 'Saving Changes...',
                        html: 'Please wait while we save your changes.',
                        icon: 'info',
                        iconColor: '#3b82f6',
                        background: 'rgba(15, 23, 42, 0.98)',
                        color: '#e2e8f0',
                        allowOutsideClick: false,
                        allowEscapeKey: false,
                        didOpen: (modal) => {
                            Swal.showLoading();
                        }
                    });
                    
                    // Submit form
                    setTimeout(() => {
                        // suppressed debug logging
                        appendImageDebug('before submit files=' + (document.getElementById('imageInput').files && document.getElementById('imageInput').files.length));
                        document.getElementById('productForm').submit();
                    }, 500);
                }
            });
        });

        // Cancel button - Note: Cancel is an <a> tag, no JS needed as it navigates directly

        // Show success/error alerts after page load
        window.addEventListener('load', function() {
            <?php if(session('success')): ?>
                Swal.fire({
                    title: 'Success!',
                    text: '<?php echo e(session("success")); ?>',
                    icon: 'success',
                    iconColor: '#22c55e',
                    background: 'rgba(15, 23, 42, 0.98)',
                    color: '#e2e8f0',
                    confirmButtonColor: '#3b82f6',
                    backdrop: 'rgba(0, 0, 0, 0.7)',
                    didOpen: (modal) => {
                        setTimeout(() => {
                            window.location.href = '<?php echo e(route("admin.inventory.index")); ?>';
                        }, 2500);
                    }
                });
            <?php endif; ?>
            
            <?php if(session('warning')): ?>
                Swal.fire({
                    title: 'Invalid Variants',
                    html: '<?php echo e(session("warning")); ?>',
                    icon: 'warning',
                    iconColor: '#f59e0b',
                    background: 'rgba(15, 23, 42, 0.98)',
                    color: '#e2e8f0',
                    confirmButtonColor: '#3b82f6',
                    backdrop: 'rgba(0, 0, 0, 0.7)'
                });
            <?php endif; ?>
            
            <?php if(session('error')): ?>
                Swal.fire({
                    title: 'Error!',
                    text: '<?php echo e(session("error")); ?>',
                    icon: 'error',
                    iconColor: '#ef4444',
                    background: 'rgba(15, 23, 42, 0.98)',
                    color: '#e2e8f0',
                    confirmButtonColor: '#3b82f6',
                    backdrop: 'rgba(0, 0, 0, 0.7)'
                });
            <?php endif; ?>
        });
    </script>
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
<?php /**PATH C:\xampp\htdocs\laravel_igp\resources\views/admin/inventory/edit.blade.php ENDPATH**/ ?>