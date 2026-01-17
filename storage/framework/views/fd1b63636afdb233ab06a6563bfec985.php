<?php if (isset($component)) { $__componentOriginal4619374cef299e94fd7263111d0abc69 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal4619374cef299e94fd7263111d0abc69 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.app-layout','data' => ['title' => 'Checkout - CICT Merch']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('app-layout'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['title' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute('Checkout - CICT Merch')]); ?>
    <style>
        :root {
            --ink: #0f172a;
            --muted: #475569;
            --surface: #ffffff;
            --border: rgba(15,23,42,0.08);
            --accent: #8B0000;
            --accent-2: #A00000;
            --bg: #f8fafc;
        }

        body { background: var(--bg) !important; }

        .checkout-shell { max-width: 1200px; margin: 0 auto; padding: 120px 24px 80px; }
        .checkout-hero { display:flex; justify-content:space-between; gap:16px; flex-wrap:wrap; margin-bottom:24px; }
        .checkout-hero h1 { margin:0; font-size:32px; font-weight:800; letter-spacing:-0.4px; color:var(--ink); }
        .checkout-hero p { margin:6px 0 0 0; color:var(--muted); max-width:640px; line-height:1.6; }
        .eyebrow { text-transform: uppercase; letter-spacing: 0.18em; font-size: 11px; font-weight: 700; color: var(--accent); margin: 0; }
        .chip { display:inline-flex; align-items:center; gap:8px; padding:8px 12px; border-radius:999px; background: rgba(15,23,42,0.06); font-weight:700; color:var(--ink); }
        .pill-link { display:inline-flex; align-items:center; gap:8px; padding:10px 14px; border-radius:12px; text-decoration:none; font-weight:700; border:1px solid var(--border); color:var(--ink); background:#fff; }
        .pill-link:hover { border-color: var(--accent); color: var(--accent); }

        .checkout-grid { display:grid; grid-template-columns:1fr; gap:16px; }
        @media(min-width: 992px) { .checkout-grid { grid-template-columns: 2fr 1fr; } }

        .card { background: var(--surface); border:1px solid var(--border); border-radius:18px; box-shadow: 0 16px 48px rgba(15,23,42,0.06); padding:18px; }
        .section-title { margin:0 0 16px 0; font-weight:800; color:var(--ink); font-size:18px; }

        .item { display:grid; grid-template-columns: auto 1fr auto; gap:14px; padding:14px; border-bottom:1px solid var(--border); align-items:center; }
        .item:last-child { border-bottom:none; }
        .thumb { width:96px; height:96px; border-radius:12px; overflow:hidden; background:#fff; border:1px solid var(--border); display:grid; place-items:center; }
        .thumb img { width:100%; height:100%; object-fit:cover; }
        .placeholder { font-size:20px; color:var(--muted); }
        .item-head h3 { margin:0; font-size:17px; font-weight:800; color:var(--ink); }
        .item-head p { margin:4px 0 0 0; color:var(--muted); font-weight:600; font-size:13px; }
        .item-price { text-align:right; }
        .price { font-weight:800; color:var(--accent); }
        .muted { color:var(--muted); font-weight:600; font-size:13px; }

        .summary-row { display:flex; justify-content:space-between; align-items:center; margin:10px 0; color:var(--muted); font-weight:700; }
        .summary-total { display:flex; justify-content:space-between; align-items:center; margin:14px 0; font-weight:900; color:var(--ink); font-size:20px; }
        
        .primary-btn { width:100%; padding:14px; border-radius:12px; border:none; background: linear-gradient(135deg, var(--accent), var(--accent-2)); color:#fff; font-weight:800; cursor:pointer; box-shadow:0 14px 36px rgba(139,0,0,0.2); display:flex; align-items:center; justify-content:center; gap:8px; }
        .primary-btn:hover { transform: translateY(-1px); box-shadow:0 16px 40px rgba(139,0,0,0.25); }
        
        .ghost-btn { width:100%; padding:12px; border-radius:12px; border:1px solid var(--border); background:#fff; font-weight:700; cursor:pointer; color:var(--ink); text-decoration:none; display:flex; align-items:center; justify-content:center; gap:8px; }
        .ghost-btn:hover { border-color: var(--accent); color: var(--accent); }

        .note { margin-top:14px; display:flex; gap:10px; align-items:flex-start; color:var(--muted); font-weight:600; font-size:13px; }
        .tag { display:inline-flex; align-items:center; gap:6px; padding:6px 10px; border-radius:10px; background: rgba(139,0,0,0.08); color: var(--accent); font-weight:700; }

        @media(max-width: 768px) {
            .checkout-shell { padding-top: 100px; padding-left: 12px; padding-right: 12px; }
            .checkout-hero { margin-bottom: 16px; }
            .checkout-hero h1 { font-size: 26px; }
            .checkout-hero p { font-size: 13px; }
            .chip { padding: 6px 10px; font-size: 13px; }
            .pill-link { padding: 8px 12px; font-size: 13px; }
            .item { grid-template-columns: 80px 1fr; gap: 12px; padding: 12px; }
            .thumb { width: 80px; height: 80px; border-radius: 10px; }
            .item-head h3 { font-size: 14px; }
            .item-head p { font-size: 11px; }
            .price { font-size: 15px; }
            .muted { font-size: 12px; }
            .checkout-grid { gap: 12px; }
            .card { padding: 14px; }
            .section-title { font-size: 16px; }
            .summary-row { font-size: 14px; }
            .summary-total { font-size: 18px; }
            .primary-btn { padding: 12px; font-size: 15px; }
            .ghost-btn { padding: 10px; font-size: 14px; }
            .note { font-size: 12px; }
            .tag { padding: 5px 8px; font-size: 11px; }
        }

        @media(max-width: 480px) {
            .checkout-shell { padding-top: 95px; padding-left: 10px; padding-right: 10px; }
            .checkout-hero { flex-direction: column; align-items: flex-start; gap: 12px; }
            .checkout-hero h1 { font-size: 24px; }
        }
    </style>

    <div class="checkout-shell">
        <div class="checkout-hero">
            <div>
                <p class="eyebrow">Checkout</p>
                <h1>Complete your order</h1>
                <p>Review your items and checkout. Pickup at the Council office Mon-Fri, 8:00 AM - 5:00 PM.</p>
            </div>
            <div style="display:flex; gap:10px; align-items:center; flex-wrap:wrap;">
                <span class="chip"><?php echo e(count($items)); ?> <?php echo e(count($items) === 1 ? 'item' : 'items'); ?></span>
                <span class="chip">₱<?php echo e(number_format($subtotal, 2)); ?></span>
            </div>
        </div>

        <form method="POST" action="<?php echo e(route('checkout.store')); ?>">
            <?php echo csrf_field(); ?>
            <input type="hidden" name="cart_payload" value='<?php echo json_encode(session("cart"), 15, 512) ?>'>
            <input type="hidden" name="cart_count" value="<?php echo e(count(session('cart', []))); ?>">

            <div class="checkout-grid">
                <section class="card">
                    <h3 class="section-title">Order Summary</h3>
                    <?php $__currentLoopData = $items; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <div class="item">
                            <div class="thumb">
                                <?php if($item['product']->image_path): ?>
                                    <img src="<?php echo e($item['product']->image_url); ?>" alt="<?php echo e($item['product']->name); ?>">
                                <?php else: ?>
                                    <svg style="width:32px; height:32px; color:var(--muted);" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                    </svg>
                                <?php endif; ?>
                            </div>
                            <div class="item-head">
                                <h3><?php echo e($item['product']->name); ?></h3>
                                <?php if($item['variant']): ?>
                                    <p>Variant: <?php echo e($item['variant']->name); ?></p>
                                <?php endif; ?>
                                <p class="muted">Qty: <?php echo e($item['quantity']); ?> × ₱<?php echo e(number_format($item['price'], 2)); ?></p>
                            </div>
                            <div class="item-price">
                                <div class="muted" style="margin-bottom:4px;">Subtotal</div>
                                <div class="price">₱<?php echo e(number_format($item['total'], 2)); ?></div>
                            </div>
                        </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </section>

                <aside>
                    <a href="<?php echo e(route('cart.index')); ?>" class="ghost-btn" style="margin-bottom:16px;">← Back to Cart</a>

                    <div class="card" style="position:sticky; top:120px;">
                        <h3 class="section-title">Order Total</h3>
                        <div class="summary-row"><span>Subtotal</span><span class="price">₱<?php echo e(number_format($subtotal, 2)); ?></span></div>
                        <div class="summary-total"><span>Total</span><span class="price">₱<?php echo e(number_format($subtotal, 2)); ?></span></div>

                        <button type="submit" class="primary-btn">
                            <svg style="width:20px; height:20px;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                            </svg>
                            <span>Complete Purchase</span>
                        </button>

                        <div class="note">
                            <span class="tag">Pickup</span>
                            <div>CICT Student Council Office - Mon-Fri, 8:00 AM - 5:00 PM</div>
                        </div>
                    </div>
                </aside>
            </div>
        </form>
    </div>
 <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal4619374cef299e94fd7263111d0abc69)): ?>
<?php $attributes = $__attributesOriginal4619374cef299e94fd7263111d0abc69; ?>
<?php unset($__attributesOriginal4619374cef299e94fd7263111d0abc69); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal4619374cef299e94fd7263111d0abc69)): ?>
<?php $component = $__componentOriginal4619374cef299e94fd7263111d0abc69; ?>
<?php unset($__componentOriginal4619374cef299e94fd7263111d0abc69); ?>
<?php endif; ?><?php /**PATH C:\xampp\htdocs\laravel_igp\resources\views/checkout/index.blade.php ENDPATH**/ ?>