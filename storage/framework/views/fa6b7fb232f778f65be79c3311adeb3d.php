<?php if (isset($component)) { $__componentOriginal4619374cef299e94fd7263111d0abc69 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal4619374cef299e94fd7263111d0abc69 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.app-layout','data' => []] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('app-layout'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
    <?php $__env->startSection('title', $product->name . ' - ' . config('app.name', 'TheWerk')); ?>

    <style>
        /* ============ DESIGN TOKENS ============ */
        :root {
            --primary: #8B0000;
            --primary-hover: #6B0000;
            --text-primary: #111827;
            --text-secondary: #6B7280;
            --bg-primary: #FFFFFF;
            --bg-secondary: #F9FAFB;
            --border: #E5E7EB;
            --shadow-sm: 0 1px 2px rgba(0, 0, 0, 0.05);
            --shadow-md: 0 4px 6px -1px rgba(0, 0, 0, 0.1);
            --shadow-lg: 0 10px 15px -3px rgba(0, 0, 0, 0.1);
            --shadow-xl: 0 20px 25px -5px rgba(0, 0, 0, 0.1);
            --radius-sm: 8px;
            --radius-md: 12px;
            --radius-lg: 16px;
        }

        /* ============ HEADER BANNER ============ */
        .product-banner {
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 100px;
            background: linear-gradient(135deg, #8B0000 0%, #A00000 40%, #6B0000 100%);
            z-index: 0;
            overflow: hidden;
        }

        .product-banner::before {
            content: '';
            position: absolute;
            inset: 0;
            background: url('<?php echo e(asset("images/cict_hero_bg.png")); ?>') center/cover;
            opacity: 0.1;
        }

        .product-hero-banner {
            margin-top: -72px;
            height: 250px;
        }

        @media (max-width: 768px) {
            .product-hero-banner {
                height: 250px;
            }
        }

        /* ============ MAIN CONTENT ============ */
        .product-content {
            background: var(--bg-secondary);
            padding: 48px 24px 80px;
            min-height: 100vh;
            padding-top: 100px;
            margin-top: -80px;
            position: relative;
            z-index: 1;
        }

        @media (max-width: 768px) {
            .product-content {
                padding: 24px 12px 60px;
                margin-top: -40px;
            }

            .product-header {
                padding: 20px;
            }

            .product-name {
                font-size: 20px;
                margin-bottom: 12px;
            }

            .product-price {
                font-size: 26px;
                margin-bottom: 16px;
            }

            .product-description {
                font-size: 14px;
            }

            .variants-card, .cart-card, .benefits-card {
                padding: 16px;
            }

            .quantity-row {
                flex-wrap: wrap;
            }

            .add-to-cart-btn {
                padding: 14px 20px;
                font-size: 15px;
            }

            .related-section {
                margin-top: 40px;
            }

            .related-title {
                font-size: 20px;
                margin-bottom: 16px;
            }

            .related-grid {
                gap: 12px;
            }

            .related-info {
                padding: 12px;
            }

            .related-name {
                font-size: 12px;
            }

            .related-price {
                font-size: 14px;
            }

            .benefits-grid {
                grid-template-columns: 1fr;
                gap: 12px;
            }

            .variants-grid {
                grid-template-columns: repeat(3, 1fr);
                gap: 8px;
            }

            .variant-label {
                padding: 10px 8px;
                font-size: 12px;
            }

            .quantity-control {
                width: 100%;
            }

            .quantity-btn {
                width: 40px;
                height: 40px;
                font-size: 18px;
            }

            .quantity-input {
                height: 40px;
                font-size: 15px;
            }

            .product-meta {
                flex-wrap: wrap;
                gap: 8px;
            }

            .product-badge {
                padding: 5px 10px;
                font-size: 11px;
            }

            .product-details {
                gap: 16px;
            }
        }

        .product-container {
            max-width: 1200px;
            margin: 0 auto;
        }

        .product-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 48px;
            align-items: start;
        }

        @media (max-width: 900px) {
            .product-grid {
                grid-template-columns: 1fr;
                gap: 24px;
            }
        }

        /* ============ PRODUCT IMAGE ============ */
        .product-image-card {
            background: var(--bg-primary);
            border: 1px solid var(--border);
            border-radius: var(--radius-lg);
            overflow: hidden;
            aspect-ratio: 1/1;
            position: sticky;
            top: 100px;
        }

        @media (max-width: 900px) {
            .product-image-card {
                position: static;
                aspect-ratio: 1/1;
                border-radius: 12px;
            }
        }

        .product-image-card img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .product-image-placeholder {
            width: 100%;
            height: 100%;
            display: flex;
            align-items: center;
            justify-content: center;
            background: var(--bg-secondary);
            color: var(--text-secondary);
        }

        /* ============ PRODUCT DETAILS ============ */
        .product-details {
            display: flex;
            flex-direction: column;
            gap: 24px;
        }

        .product-header {
            background: var(--bg-primary);
            border: 1px solid var(--border);
            border-radius: var(--radius-lg);
            padding: 32px;
        }

        .product-name {
            font-size: 28px;
            font-weight: 700;
            color: var(--text-primary);
            margin: 0 0 16px 0;
            line-height: 1.3;
        }

        .product-meta {
            display: flex;
            align-items: center;
            gap: 12px;
            margin-bottom: 20px;
        }

        .product-badge {
            display: inline-flex;
            padding: 6px 12px;
            border-radius: var(--radius-sm);
            font-size: 12px;
            font-weight: 600;
        }

        .product-badge.in-stock {
            background: #D1FAE5;
            color: #065F46;
        }

        .product-badge.low-stock {
            background: #FEF3C7;
            color: #92400E;
        }

        .product-badge.out-of-stock {
            background: #FEE2E2;
            color: #991B1B;
        }

        .product-stock-count {
            font-size: 13px;
            color: var(--text-secondary);
        }

        .product-price {
            font-size: 36px;
            font-weight: 800;
            color: var(--primary);
            margin-bottom: 20px;
        }

        .product-description {
            font-size: 15px;
            color: var(--text-secondary);
            line-height: 1.7;
        }

        /* ============ VARIANTS SECTION ============ */
        .variants-card {
            background: var(--bg-primary);
            border: 1px solid var(--border);
            border-radius: var(--radius-lg);
            padding: 24px;
        }

        .variants-label {
            font-size: 13px;
            font-weight: 700;
            color: var(--text-primary);
            text-transform: uppercase;
            letter-spacing: 0.5px;
            margin-bottom: 12px;
        }

        .variants-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(100px, 1fr));
            gap: 10px;
        }

        .variant-radio {
            display: none;
        }

        .variant-label {
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 14px 16px;
            background: var(--bg-secondary);
            border: 2px solid var(--border);
            border-radius: var(--radius-md);
            font-size: 14px;
            font-weight: 600;
            color: var(--text-primary);
            cursor: pointer;
            transition: all 0.2s;
            text-align: center;
        }

        .variant-radio:checked+.variant-label {
            background: var(--primary);
            border-color: var(--primary);
            color: #fff;
        }

        .variant-label:hover {
            border-color: var(--primary);
        }

        /* ============ QUANTITY & CART ============ */
        .cart-card {
            background: var(--bg-primary);
            border: 1px solid var(--border);
            border-radius: var(--radius-lg);
            padding: 24px;
        }

        .quantity-row {
            display: flex;
            align-items: center;
            gap: 16px;
            margin-bottom: 20px;
        }

        .quantity-label {
            font-size: 13px;
            font-weight: 700;
            color: var(--text-primary);
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .quantity-control {
            display: flex;
            align-items: center;
            border: 1px solid var(--border);
            border-radius: var(--radius-sm);
            overflow: hidden;
        }

        .quantity-btn {
            width: 44px;
            height: 44px;
            border: none;
            background: var(--bg-secondary);
            font-size: 20px;
            font-weight: 600;
            color: var(--text-primary);
            cursor: pointer;
            transition: background 0.2s;
        }

        .quantity-btn:hover {
            background: var(--border);
        }

        .quantity-input {
            width: 60px;
            height: 44px;
            border: none;
            text-align: center;
            font-size: 16px;
            font-weight: 600;
            color: var(--text-primary);
            background: transparent;
        }

        .quantity-max {
            font-size: 13px;
            color: var(--text-secondary);
        }

        .add-to-cart-btn {
            width: 100%;
            padding: 16px 24px;
            background: var(--primary);
            color: #fff;
            border: none;
            border-radius: var(--radius-md);
            font-size: 16px;
            font-weight: 700;
            cursor: pointer;
            transition: all 0.2s;
            box-shadow: var(--shadow-md);
        }

        .add-to-cart-btn:hover {
            background: var(--primary-hover);
            transform: translateY(-2px);
            box-shadow: var(--shadow-lg);
        }

        .out-of-stock-msg {
            background: #FEE2E2;
            border: 1px solid #FECACA;
            color: #991B1B;
            padding: 16px;
            border-radius: var(--radius-md);
            text-align: center;
            font-weight: 600;
        }

        /* ============ BENEFITS ============ */
        .benefits-card {
            background: var(--bg-primary);
            border: 1px solid var(--border);
            border-radius: var(--radius-lg);
            padding: 24px;
        }

        .benefits-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 16px;
        }

        @media (max-width: 600px) {
            .benefits-grid {
                grid-template-columns: 1fr;
            }
        }

        .benefit-item {
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .benefit-icon {
            width: 40px;
            height: 40px;
            background: linear-gradient(135deg, rgba(139, 0, 0, 0.1), rgba(139, 0, 0, 0.05));
            border-radius: var(--radius-sm);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 18px;
            flex-shrink: 0;
        }

        .benefit-text {
            font-size: 13px;
            color: var(--text-secondary);
            line-height: 1.4;
        }

        .benefit-text strong {
            display: block;
            color: var(--text-primary);
            font-weight: 600;
        }

        /* ============ RELATED PRODUCTS ============ */
        .related-section {
            margin-top: 64px;
        }

        .related-title {
            font-size: 24px;
            font-weight: 700;
            color: var(--text-primary);
            margin-bottom: 24px;
        }

        .related-grid {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 20px;
        }

        @media (max-width: 900px) {
            .related-grid {
                grid-template-columns: repeat(2, 1fr);
            }
        }

        .related-card {
            background: var(--bg-primary);
            border: 1px solid var(--border);
            border-radius: var(--radius-lg);
            overflow: hidden;
            text-decoration: none;
            transition: all 0.3s;
        }

        .related-card:hover {
            transform: translateY(-6px);
            box-shadow: var(--shadow-xl);
            border-color: var(--primary);
        }

        .related-image {
            aspect-ratio: 1/1;
            background: var(--bg-secondary);
        }

        .related-image img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .related-info {
            padding: 16px;
        }

        .related-name {
            font-size: 14px;
            font-weight: 600;
            color: var(--text-primary);
            margin-bottom: 8px;
            line-height: 1.4;
        }

        .related-price {
            font-size: 16px;
            font-weight: 700;
            color: var(--primary);
        }

        /* ============ REVIEWS SECTION ============ */
        .reviews-section {
            margin-top: 48px;
            padding-top: 48px;
            border-top: 1px solid var(--border);
        }

        .reviews-header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 24px;
            flex-wrap: wrap;
            gap: 16px;
        }

        .reviews-title {
            font-size: 24px;
            font-weight: 700;
            color: var(--text-primary);
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .reviews-count {
            font-size: 14px;
            font-weight: 500;
            color: var(--text-secondary);
            background: var(--bg-secondary);
            padding: 4px 12px;
            border-radius: 999px;
        }

        .reviews-summary {
            display: flex;
            align-items: center;
            gap: 16px;
            flex-wrap: wrap;
        }

        .average-rating {
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .average-rating-number {
            font-size: 32px;
            font-weight: 800;
            color: var(--text-primary);
        }

        .average-rating-stars {
            display: flex;
            gap: 2px;
        }

        .star-icon {
            width: 20px;
            height: 20px;
            color: #FBBF24;
        }

        .star-icon.empty {
            color: #E5E7EB;
        }

        .reviews-list {
            display: flex;
            flex-direction: column;
            gap: 20px;
        }

        .review-card {
            background: var(--bg-primary);
            border: 1px solid var(--border);
            border-radius: var(--radius-lg);
            padding: 20px;
            transition: all 0.2s;
        }

        .review-card:hover {
            border-color: #D1D5DB;
            box-shadow: var(--shadow-sm);
        }

        .review-header {
            display: flex;
            align-items: flex-start;
            justify-content: space-between;
            margin-bottom: 12px;
            gap: 12px;
        }

        .review-author {
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .review-avatar {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            background: linear-gradient(135deg, var(--primary) 0%, #A00000 100%);
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-weight: 700;
            font-size: 16px;
        }

        .review-author-info {
            display: flex;
            flex-direction: column;
            gap: 2px;
        }

        .review-author-name {
            font-weight: 600;
            color: var(--text-primary);
            font-size: 15px;
        }

        .review-date {
            font-size: 13px;
            color: var(--text-secondary);
        }

        .review-stars {
            display: flex;
            gap: 2px;
        }

        .review-stars .star-icon {
            width: 16px;
            height: 16px;
        }

        .verified-badge {
            display: inline-flex;
            align-items: center;
            gap: 4px;
            font-size: 12px;
            color: #059669;
            background: #ECFDF5;
            padding: 4px 10px;
            border-radius: 999px;
            font-weight: 600;
        }

        .review-comment {
            color: var(--text-primary);
            line-height: 1.7;
            font-size: 15px;
        }

        .no-reviews {
            text-align: center;
            padding: 48px 24px;
            background: var(--bg-secondary);
            border-radius: var(--radius-lg);
        }

        .no-reviews-icon {
            width: 64px;
            height: 64px;
            margin: 0 auto 16px;
            color: #D1D5DB;
        }

        .no-reviews-text {
            font-size: 16px;
            color: var(--text-secondary);
            margin-bottom: 4px;
        }

        .no-reviews-subtext {
            font-size: 14px;
            color: #9CA3AF;
        }

        /* ============ FLOATING ADD TO CART (Mobile Only) ============ */
        .floating-cart-bar {
            display: none;
        }

        @media (max-width: 768px) {
            .floating-cart-bar {
                display: flex;
                position: fixed;
                bottom: 0;
                left: 0;
                right: 0;
                background: #fff;
                padding: 16px 16px;
                padding-bottom: calc(16px + env(safe-area-inset-bottom, 0px));
                box-shadow: 0 -4px 20px rgba(0, 0, 0, 0.15);
                z-index: 99999;
                gap: 12px;
                align-items: center;
                border-top: 1px solid var(--border);
            }

            .floating-cart-bar .floating-price {
                font-size: 22px;
                font-weight: 800;
                color: var(--primary);
                white-space: nowrap;
            }

            .floating-cart-bar .floating-add-btn {
                flex: 1;
                padding: 16px 24px;
                background: var(--primary);
                color: #fff;
                border: none;
                border-radius: 12px;
                font-size: 16px;
                font-weight: 700;
                cursor: pointer;
                text-align: center;
                text-decoration: none;
                display: flex;
                align-items: center;
                justify-content: center;
                gap: 8px;
            }

            .floating-cart-bar .floating-add-btn:active {
                transform: scale(0.98);
                background: var(--primary-hover);
            }

            /* Hide chatbot on mobile for product page */
            #cict-chatbot,
            .chatbot-widget,
            [id*="chatbot"],
            [class*="chatbot"] {
                display: none !important;
            }

            /* Add bottom padding to page content so it doesn't hide behind floating bar */
            .product-content {
                padding-bottom: 120px !important;
            }

            /* Hide the original add to cart button on mobile */
            .cart-card .add-to-cart-btn,
            .cart-card a.add-to-cart-btn {
                display: none !important;
            }

            /* Hide the product price in main content on mobile - it shows in floating bar */
            .product-header .product-price {
                display: none !important;
            }
        }
    </style>

    <!-- Decorative Red Header Banner (Behind Navbar) -->
    <div class="product-hero-banner"
        style="margin-top: -72px; height: 250px; background: linear-gradient(135deg, #8B0000 0%, #A00000 40%, #6B0000 100%); position: relative; overflow: hidden;">
        <!-- Decorative Pattern Overlay -->
        <div
            style="position: absolute; inset: 0; opacity: 0.1; background-image: url('data:image/svg+xml,%3Csvg width=\'60\' height=\'60\' viewBox=\'0 0 60 60\' xmlns=\'http://www.w3.org/2000/svg\'%3E%3Cg fill=\'none\' fill-rule=\'evenodd\'%3E%3Cg fill=\'%23ffffff\' fill-opacity=\'1\'%3E%3Cpath d=\'M36 34v-4h-2v4h-4v2h4v4h2v-4h4v-2h-4zm0-30V0h-2v4h-4v2h4v4h2V6h4V4h-4zM6 34v-4H4v4H0v2h4v4h2v-4h4v-2H6zM6 4V0H4v4H0v2h4v4h2V6h4V4H6z\'/%3E%3C/g%3E%3C/g%3E%3C/svg%3E');">
        </div>
        <!-- Decorative Circles -->
        <div
            style="position: absolute; top: -20px; right: -20px; width: 80px; height: 80px; background: rgba(255,255,255,0.05); border-radius: 50%;">
        </div>
        <div
            style="position: absolute; top: 20px; right: 80px; width: 40px; height: 40px; background: rgba(255,255,255,0.03); border-radius: 50%;">
        </div>
        <div
            style="position: absolute; top: 5px; left: 10%; width: 60px; height: 60px; background: rgba(255,255,255,0.04); border-radius: 50%;">
        </div>
    </div>

    <!-- Main Content -->
    <div class="product-content">
        <div class="product-container">
            <div class="product-grid">
                <!-- Product Image -->
                <div class="product-image-card">
                    <?php if(!empty($product->image_url)): ?>
                        <img src="<?php echo e($product->image_url); ?>" alt="<?php echo e($product->name); ?>">
                    <?php else: ?>
                        <div class="product-image-placeholder">No Image Available</div>
                    <?php endif; ?>
                </div>

                <!-- Product Details -->
                <div class="product-details">
                    <?php
                        $stock = $product->current_stock;
                        $isLowStock = $stock > 0 && $stock <= $product->low_stock_threshold;
                        $isOutOfStock = $stock == 0;
                    ?>

                    <!-- Header Card -->
                    <div class="product-header">
                        <h1 class="product-name"><?php echo e($product->name); ?></h1>

                        <div class="product-meta">
                            <?php if($isOutOfStock): ?>
                                <span class="product-badge out-of-stock">Out of Stock</span>
                            <?php elseif($isLowStock): ?>
                                <span class="product-badge low-stock">Only <?php echo e($stock); ?> left</span>
                            <?php else: ?>
                                <span class="product-badge in-stock">In Stock</span>
                            <?php endif; ?>
                            <span class="product-stock-count"><?php echo e($stock); ?> units available</span>
                        </div>

                        <div class="product-price" id="display-price">₱<?php echo e(number_format($product->base_price, 2)); ?>

                        </div>

                        <?php if($product->description): ?>
                            <p class="product-description"><?php echo e($product->description); ?></p>
                        <?php endif; ?>
                    </div>

                    <!-- Variants Card -->
                    <?php if($product->variants->count() > 0): ?>
                        <div class="variants-card">
                            <div class="variants-label">Select Variant</div>
                            <div class="variants-grid">
                                <?php $__currentLoopData = $product->variants; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $variant): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <input type="radio" name="variant_id" id="variant_<?php echo e($variant->id); ?>"
                                        value="<?php echo e($variant->id); ?>" class="variant-radio" <?php echo e($index === 0 ? 'checked' : ''); ?>

                                        data-price="<?php echo e($variant->getFinalPrice()); ?>"
                                        data-stock="<?php echo e($variant->stock_quantity); ?>">
                                    <label for="variant_<?php echo e($variant->id); ?>" class="variant-label">
                                        <?php echo e($variant->name); ?>

                                    </label>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </div>
                        </div>
                    <?php endif; ?>

                    <!-- Cart Card -->
                    <div class="cart-card">
                        <form id="add-to-cart-form" method="POST" action="<?php echo e(route('cart.store')); ?>">
                            <?php echo csrf_field(); ?>
                            <input type="hidden" name="product_id" value="<?php echo e($product->id); ?>">
                            <?php if($product->variants->count() > 0): ?>
                                <input type="hidden" name="variant_id" id="selected_variant"
                                    value="<?php echo e($product->variants->first()->id); ?>">
                            <?php endif; ?>

                            <?php if(!$isOutOfStock): ?>
                                <div class="quantity-row">
                                    <div>
                                        <div class="quantity-label">Quantity</div>
                                        <div class="quantity-control">
                                            <button type="button" class="quantity-btn" onclick="decreaseQty()">−</button>
                                            <input type="number" name="quantity" id="quantity_input" min="1" value="1"
                                                class="quantity-input" readonly>
                                            <button type="button" class="quantity-btn" onclick="increaseQty()">+</button>
                                        </div>
                                    </div>
                                    <div class="quantity-max">
                                        Max: <strong id="max_qty"><?php echo e($stock); ?></strong> available
                                    </div>
                                </div>

                                <?php if(auth()->guard()->check()): ?>
                                    <button type="submit" class="add-to-cart-btn" id="add_to_cart_btn">
                                        Add to Cart
                                    </button>
                                <?php else: ?>
                                    <a href="<?php echo e(route('login')); ?>" class="add-to-cart-btn"
                                        style="display: block; text-align: center; text-decoration: none;">
                                        Sign In to Purchase
                                    </a>
                                <?php endif; ?>
                            <?php else: ?>
                                <div class="out-of-stock-msg">
                                    This product is currently out of stock
                                </div>
                            <?php endif; ?>
                        </form>
                    </div>

                    <!-- Benefits Card -->
                    <div class="benefits-card">
                        <div class="benefits-grid">
                            <div class="benefit-item">
                                <div class="benefit-icon">📦</div>
                                <div class="benefit-text">
                                    <strong>Campus Pickup</strong>
                                    Collect at CICT office
                                </div>
                            </div>
                            <div class="benefit-item">
                                <div class="benefit-icon">💵</div>
                                <div class="benefit-text">
                                    <strong>Pay on Pickup</strong>
                                    Cash payment accepted
                                </div>
                            </div>
                            <div class="benefit-item">
                                <div class="benefit-icon">🎓</div>
                                <div class="benefit-text">
                                    <strong>Student Support</strong>
                                    Council initiatives
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Reviews Section -->
            <div class="reviews-section">
                <div class="reviews-header">
                    <h2 class="reviews-title">
                        Customer Reviews
                        <span class="reviews-count"><?php echo e($product->reviews->count()); ?> <?php echo e(Str::plural('review', $product->reviews->count())); ?></span>
                    </h2>
                    <?php if($product->reviews->count() > 0): ?>
                        <div class="reviews-summary">
                            <div class="average-rating">
                                <span class="average-rating-number"><?php echo e(number_format($product->averageRating(), 1)); ?></span>
                                <div class="average-rating-stars">
                                    <?php for($i = 1; $i <= 5; $i++): ?>
                                        <svg class="star-icon <?php echo e($i <= round($product->averageRating()) ? '' : 'empty'); ?>" viewBox="0 0 20 20" fill="currentColor">
                                            <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
                                        </svg>
                                    <?php endfor; ?>
                                </div>
                            </div>
                        </div>
                    <?php endif; ?>
                </div>

                <?php if($product->reviews->count() > 0): ?>
                    <div class="reviews-list">
                        <?php $__currentLoopData = $product->reviews()->with('user')->latest()->take(5)->get(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $review): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <div class="review-card">
                                <div class="review-header">
                                    <div class="review-author">
                                        <div class="review-avatar">
                                            <?php echo e(strtoupper(substr($review->user->name ?? 'U', 0, 1))); ?>

                                        </div>
                                        <div class="review-author-info">
                                            <div class="review-author-name"><?php echo e($review->user->name ?? 'Anonymous'); ?></div>
                                            <div class="review-date"><?php echo e($review->created_at->format('M d, Y')); ?></div>
                                        </div>
                                    </div>
                                    <div style="display: flex; align-items: center; gap: 12px; flex-wrap: wrap;">
                                        <div class="review-stars">
                                            <?php for($i = 1; $i <= 5; $i++): ?>
                                                <svg class="star-icon <?php echo e($i <= $review->rating ? '' : 'empty'); ?>" viewBox="0 0 20 20" fill="currentColor">
                                                    <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
                                                </svg>
                                            <?php endfor; ?>
                                        </div>
                                        <?php if($review->verified_purchase): ?>
                                            <span class="verified-badge">
                                                <svg style="width: 14px; height: 14px;" viewBox="0 0 20 20" fill="currentColor">
                                                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                                                </svg>
                                                Verified Purchase
                                            </span>
                                        <?php endif; ?>
                                    </div>
                                </div>
                                <?php if($review->comment): ?>
                                    <p class="review-comment"><?php echo e($review->comment); ?></p>
                                <?php endif; ?>
                            </div>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </div>
                <?php else: ?>
                    <div class="no-reviews">
                        <svg class="no-reviews-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M11.48 3.499a.562.562 0 011.04 0l2.125 5.111a.563.563 0 00.475.31l5.518.442c.499.04.701.663.321.988l-4.204 3.602a.563.563 0 00-.182.557l1.285 5.385a.562.562 0 01-.84.61l-4.725-2.885a.563.563 0 00-.586 0L6.982 20.54a.562.562 0 01-.84-.61l1.285-5.386a.562.562 0 00-.182-.557l-4.204-3.602a.563.563 0 01.321-.988l5.518-.442a.563.563 0 00.475-.31L11.48 3.5z"/>
                        </svg>
                        <div class="no-reviews-text">No reviews yet</div>
                        <div class="no-reviews-subtext">Be the first to share your experience with this product</div>
                    </div>
                <?php endif; ?>
            </div>

            <!-- Related Products -->
            <?php if($relatedProducts->count() > 0): ?>
                <div class="related-section">
                    <h2 class="related-title">You May Also Like</h2>
                    <div class="related-grid">
                        <?php $__currentLoopData = $relatedProducts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $related): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <a href="<?php echo e(route('shop.show', $related->slug)); ?>" class="related-card">
                                <div class="related-image">
                                    <?php if($related->image_path): ?>
                                        <img src="<?php echo e($related->image_url); ?>" alt="<?php echo e($related->name); ?>">
                                    <?php endif; ?>
                                </div>
                                <div class="related-info">
                                    <div class="related-name"><?php echo e($related->name); ?></div>
                                    <div class="related-price">₱<?php echo e(number_format($related->base_price, 2)); ?></div>
                                </div>
                            </a>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </div>
                </div>
            <?php endif; ?>
        </div>
    </div>

    <!-- JavaScript -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        const qtyInput = document.getElementById('quantity_input');
        const maxQtyEl = document.getElementById('max_qty');
        const priceEl = document.getElementById('display-price');
        const addToCartBtn = document.getElementById('add_to_cart_btn');
        let isSubmitting = false;

        function decreaseQty() {
            if (parseInt(qtyInput.value) > 1) qtyInput.value--;
        }

        function increaseQty() {
            const maxQty = parseInt(maxQtyEl.textContent) || 0;
            if (parseInt(qtyInput.value) < maxQty) qtyInput.value++;
        }

        function formatPrice(price) {
            return '₱' + parseFloat(price).toLocaleString('en-US', {
                minimumFractionDigits: 2,
                maximumFractionDigits: 2
            });
        }

        // Variant selection
        document.querySelectorAll('input[name="variant_id"]').forEach(radio => {
            radio.addEventListener('change', function () {
                const selectedVariant = document.getElementById('selected_variant');
                if (selectedVariant) selectedVariant.value = this.value;

                const variantStock = parseInt(this.getAttribute('data-stock')) || 0;
                const variantPrice = parseFloat(this.getAttribute('data-price'));

                // Update price with animation
                priceEl.style.opacity = '0.5';
                setTimeout(() => {
                    priceEl.textContent = formatPrice(variantPrice);
                    priceEl.style.opacity = '1';
                }, 150);

                // Update max quantity
                maxQtyEl.textContent = variantStock;
                if (parseInt(qtyInput.value) > variantStock) {
                    qtyInput.value = Math.max(1, variantStock);
                }
            });
        });

        // Form submission with loading and SweetAlert
        document.getElementById('add-to-cart-form')?.addEventListener('submit', function (e) {
            e.preventDefault();

            // Prevent double submission
            if (isSubmitting) return;
            isSubmitting = true;

            // Show loading state on button
            const originalText = addToCartBtn.innerHTML;
            addToCartBtn.innerHTML = '<span style="display:inline-flex;align-items:center;gap:8px;"><svg style="width:20px;height:20px;animation:spin 1s linear infinite;" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10" stroke-opacity="0.25"></circle><path d="M12 2a10 10 0 0 1 10 10" stroke-linecap="round"></path></svg>Adding...</span>';
            addToCartBtn.disabled = true;
            addToCartBtn.style.opacity = '0.8';

            const formData = new FormData(this);

            fetch(this.action, {
                method: 'POST',
                body: formData,
                headers: {
                    'X-Requested-With': 'XMLHttpRequest',
                }
            })
                .then(response => {
                    if (!response.ok) throw new Error('Request failed');
                    return response.json();
                })
                .then(data => {
                    // Modern centered success SweetAlert
                    Swal.fire({
                        icon: 'success',
                        title: 'Added to Cart!',
                        html: '<p style="color:#6B7280;font-size:15px;"><?php echo e($product->name); ?> has been added to your cart.</p>',
                        showConfirmButton: true,
                        confirmButtonText: 'Continue Shopping',
                        confirmButtonColor: '#8B0000',
                        timer: 3000,
                        timerProgressBar: true,
                        customClass: {
                            popup: 'swal-popup-modern',
                            title: 'swal-title-modern'
                        }
                    }).then(() => {
                        window.location.reload();
                    });
                })
                .catch(error => {
                    // Reset button and submit normally as fallback
                    addToCartBtn.innerHTML = originalText;
                    addToCartBtn.disabled = false;
                    addToCartBtn.style.opacity = '1';
                    isSubmitting = false;
                    this.submit();
                });
        });
    </script>

    <style>
        @keyframes spin {
            to {
                transform: rotate(360deg);
            }
        }

        .swal-popup-modern {
            border-radius: 16px !important;
            padding: 24px !important;
        }

        .swal-title-modern {
            font-size: 22px !important;
            font-weight: 700 !important;
            color: #111827 !important;
        }
    </style>

    <?php $__env->startPush('body-end'); ?>
        <!-- Floating Add to Cart Bar (Mobile Only) -->
        <?php if(!$isOutOfStock): ?>
        <div class="floating-cart-bar">
            <div class="floating-price" id="floating-price">₱<?php echo e(number_format($product->base_price, 2)); ?></div>
            <?php if(auth()->guard()->check()): ?>
                <button type="button" class="floating-add-btn" onclick="document.getElementById('add-to-cart-form').dispatchEvent(new Event('submit', {cancelable: true, bubbles: true}))">
                    <svg width="20" height="20" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z"/>
                    </svg>
                    Add to Cart
                </button>
            <?php else: ?>
                <a href="<?php echo e(route('login')); ?>" class="floating-add-btn">
                    Sign In to Purchase
                </a>
            <?php endif; ?>
        </div>
        <?php endif; ?>

        <script>
            // Update floating price when variant changes
            document.querySelectorAll('.variant-radio').forEach(radio => {
                radio.addEventListener('change', function() {
                    const price = this.dataset.price;
                    const floatingPrice = document.getElementById('floating-price');
                    if (floatingPrice && price) {
                        floatingPrice.textContent = '₱' + parseFloat(price).toLocaleString('en-PH', {minimumFractionDigits: 2, maximumFractionDigits: 2});
                    }
                });
            });
        </script>
    <?php $__env->stopPush(); ?>

 <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal4619374cef299e94fd7263111d0abc69)): ?>
<?php $attributes = $__attributesOriginal4619374cef299e94fd7263111d0abc69; ?>
<?php unset($__attributesOriginal4619374cef299e94fd7263111d0abc69); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal4619374cef299e94fd7263111d0abc69)): ?>
<?php $component = $__componentOriginal4619374cef299e94fd7263111d0abc69; ?>
<?php unset($__componentOriginal4619374cef299e94fd7263111d0abc69); ?>
<?php endif; ?><?php /**PATH C:\xampp\htdocs\laravel_igp\resources\views/shop/show.blade.php ENDPATH**/ ?>