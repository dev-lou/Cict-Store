<?php if (isset($component)) { $__componentOriginal4619374cef299e94fd7263111d0abc69 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal4619374cef299e94fd7263111d0abc69 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.app-layout','data' => ['title' => 'CICT-DG — Merchandise & Services']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('app-layout'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['title' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute('CICT-DG — Merchandise & Services')]); ?>
    <style>
        /* ============ DESIGN TOKENS ============ */
        :root {
            --primary: #8B0000;
            --primary-hover: #6B0000;
            --accent: #D97706;
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
            --radius-xl: 24px;
        }

        /* ============ HERO SECTION ============ */
        .hero {
            min-height: 70vh;
            padding: 180px 24px 80px;
            background: linear-gradient(135deg, #8B0000 0%, #5C0000 100%);
            display: flex;
            align-items: center;
            justify-content: center;
            text-align: center;
            margin-top: -72px;
            position: relative;
            overflow: hidden;
        }

        @media (max-width: 768px) {
            .hero {
                min-height: 60vh;
                padding: 160px 20px 60px;
            }
        }

        @media (max-width: 480px) {
            .hero {
                padding-top: 180px;
            }
        }

        .hero::before {
            content: '';
            position: absolute;
            inset: 0;
            background: url('<?php echo e(asset("images/cict_hero_bg.png")); ?>') center/cover;
            opacity: 0.15;
        }

        .hero-content {
            position: relative;
            z-index: 10;
            max-width: 800px;
            margin: 0 auto;
        }

        .hero-badge {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            padding: 8px 16px;
            background: rgba(255, 255, 255, 0.15);
            border-radius: 999px;
            color: #fff;
            font-size: 14px;
            font-weight: 600;
            margin-bottom: 24px;
            backdrop-filter: blur(4px);
        }

        .hero-title {
            font-size: clamp(36px, 6vw, 56px);
            font-weight: 800;
            color: #fff;
            line-height: 1.1;
            margin-bottom: 20px;
            letter-spacing: -1px;
        }

        .hero-subtitle {
            font-size: clamp(16px, 2vw, 20px);
            color: rgba(255, 255, 255, 0.9);
            line-height: 1.6;
            margin-bottom: 32px;
            max-width: 600px;
            margin-left: auto;
            margin-right: auto;
        }

        .hero-buttons {
            display: flex;
            gap: 16px;
            justify-content: center;
            flex-wrap: wrap;
        }

        .btn-primary {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            padding: 16px 32px;
            background: #fff;
            color: var(--primary);
            font-size: 16px;
            font-weight: 700;
            border-radius: var(--radius-md);
            text-decoration: none;
            transition: all 0.2s ease;
            box-shadow: var(--shadow-lg);
        }

        .btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: var(--shadow-xl);
        }

        .btn-secondary {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            padding: 16px 32px;
            background: transparent;
            color: #fff;
            font-size: 16px;
            font-weight: 600;
            border: 2px solid rgba(255, 255, 255, 0.5);
            border-radius: var(--radius-md);
            text-decoration: none;
            transition: all 0.2s ease;
        }

        .btn-secondary:hover {
            background: rgba(255, 255, 255, 0.1);
            border-color: #fff;
        }

        /* ============ SECTIONS ============ */
        .section {
            padding: 80px 24px;
            background: var(--bg-secondary);
        }

        .section-alt {
            background: var(--bg-primary);
        }

        .section-container {
            max-width: 1200px;
            margin: 0 auto;
        }

        .section-header {
            text-align: center;
            margin-bottom: 48px;
        }

        .section-title {
            font-size: clamp(28px, 4vw, 36px);
            font-weight: 700;
            color: var(--text-primary);
            margin-bottom: 12px;
            letter-spacing: -0.5px;
        }

        .section-subtitle {
            font-size: 16px;
            color: var(--text-secondary);
            max-width: 600px;
            margin: 0 auto;
            line-height: 1.6;
        }

        /* ============ PRODUCT CARDS ============ */
        .products-grid {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 24px;
        }

        @media (max-width: 1024px) {
            .products-grid {
                grid-template-columns: repeat(3, 1fr);
            }
        }

        @media (max-width: 768px) {
            .products-grid {
                grid-template-columns: repeat(2, 1fr);
                gap: 16px;
            }
        }

        @media (max-width: 480px) {
            .products-grid {
                grid-template-columns: repeat(2, 1fr);
                gap: 12px;
            }

            .product-card {
                border-radius: 12px;
            }

            .product-card:hover {
                transform: translateY(-4px);
            }

            .product-image {
                aspect-ratio: 1/1;
            }

            .product-info {
                padding: 12px;
            }

            .product-title {
                font-size: 13px;
                margin-bottom: 4px;
                display: -webkit-box;
                -webkit-line-clamp: 2;
                -webkit-box-orient: vertical;
                overflow: hidden;
            }

            .product-price {
                font-size: 15px;
            }
        }

        .product-card {
            background: var(--bg-primary);
            border: 1px solid var(--border);
            border-radius: var(--radius-lg);
            overflow: hidden;
            transition: all 0.3s ease;
            display: flex;
            flex-direction: column;
            text-decoration: none;
        }

        .product-card:hover {
            transform: translateY(-8px);
            box-shadow: var(--shadow-xl);
        }

        .product-image {
            aspect-ratio: 4/3;
            background: var(--bg-secondary);
            overflow: hidden;
        }

        .product-image img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: transform 0.3s ease;
        }

        .product-card:hover .product-image img {
            transform: scale(1.05);
        }

        .product-info {
            padding: 20px;
            flex: 1;
            display: flex;
            flex-direction: column;
        }

        .product-title {
            font-size: 16px;
            font-weight: 600;
            color: var(--text-primary);
            margin-bottom: 8px;
            line-height: 1.4;
        }

        .product-price {
            font-size: 20px;
            font-weight: 700;
            color: var(--primary);
            margin-top: auto;
        }

        .product-badge {
            position: absolute;
            top: 12px;
            left: 12px;
            padding: 6px 12px;
            background: var(--primary);
            color: #fff;
            font-size: 12px;
            font-weight: 600;
            border-radius: var(--radius-sm);
        }

        /* ============ SERVICE CARDS ============ */
        .services-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 24px;
        }

        @media (max-width: 768px) {
            .services-grid {
                grid-template-columns: repeat(2, 1fr);
                gap: 16px;
            }
        }

        @media (max-width: 480px) {
            .services-grid {
                grid-template-columns: repeat(2, 1fr);
                gap: 12px;
            }

            .service-card {
                padding: 20px;
            }

            .service-icon {
                width: 44px;
                height: 44px;
                font-size: 22px;
                margin-bottom: 14px;
            }

            .service-title {
                font-size: 15px;
                margin-bottom: 8px;
            }

            .service-desc {
                font-size: 12px;
                margin-bottom: 12px;
                display: -webkit-box;
                -webkit-line-clamp: 2;
                -webkit-box-orient: vertical;
                overflow: hidden;
            }

            .service-price {
                font-size: 14px;
            }
        }

        .service-card {
            background: var(--bg-primary);
            border: 1px solid var(--border);
            border-radius: var(--radius-lg);
            padding: 32px;
            transition: all 0.3s ease;
            text-decoration: none;
            display: block;
        }

        .service-card:hover {
            transform: translateY(-4px);
            box-shadow: var(--shadow-lg);
        }

        .service-icon {
            width: 56px;
            height: 56px;
            background: linear-gradient(135deg, rgba(139, 0, 0, 0.1), rgba(139, 0, 0, 0.05));
            border-radius: var(--radius-md);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 28px;
            margin-bottom: 20px;
        }

        .service-title {
            font-size: 20px;
            font-weight: 600;
            color: var(--text-primary);
            margin-bottom: 12px;
        }

        .service-desc {
            font-size: 14px;
            color: var(--text-secondary);
            line-height: 1.6;
            margin-bottom: 16px;
        }

        .service-price {
            font-size: 16px;
            font-weight: 700;
            color: var(--primary);
        }

        /* ============ ABOUT SECTION ============ */
        .about-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 64px;
            align-items: center;
        }

        @media (max-width: 768px) {
            .about-grid {
                grid-template-columns: 1fr;
                gap: 40px;
            }
        }

        .about-image {
            border-radius: var(--radius-xl);
            overflow: hidden;
            aspect-ratio: 4/3;
            background: var(--bg-secondary);
        }

        .about-image img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .about-content h2 {
            font-size: clamp(28px, 4vw, 36px);
            font-weight: 700;
            color: var(--text-primary);
            margin-bottom: 20px;
            letter-spacing: -0.5px;
        }

        .about-content p {
            font-size: 16px;
            color: var(--text-secondary);
            line-height: 1.8;
            margin-bottom: 24px;
        }

        .btn-outline {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            padding: 14px 28px;
            background: transparent;
            color: var(--primary);
            font-size: 15px;
            font-weight: 600;
            border: 2px solid var(--primary);
            border-radius: var(--radius-md);
            text-decoration: none;
            transition: all 0.2s ease;
        }

        .btn-outline:hover {
            background: var(--primary);
            color: #fff;
        }

        /* ============ VIEW ALL BUTTON ============ */
        .view-all-wrapper {
            text-align: center;
            margin-top: 48px;
        }

        /* ============ STATS SECTION ============ */
        .stats-grid {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 32px;
            text-align: center;
        }

        @media (max-width: 768px) {
            .stats-grid {
                grid-template-columns: repeat(2, 1fr);
            }
        }

        .stat-item {
            padding: 24px;
        }

        .stat-number {
            font-size: 48px;
            font-weight: 800;
            color: var(--primary);
            line-height: 1;
            margin-bottom: 8px;
        }

        .stat-label {
            font-size: 14px;
            color: var(--text-secondary);
            font-weight: 500;
        }

        /* ============ CTA SECTION ============ */
        .cta-section {
            background: linear-gradient(135deg, var(--primary) 0%, #5C0000 100%);
            padding: 80px 24px;
            text-align: center;
        }

        .cta-title {
            font-size: clamp(28px, 4vw, 40px);
            font-weight: 700;
            color: #fff;
            margin-bottom: 16px;
        }

        .cta-subtitle {
            font-size: 18px;
            color: rgba(255, 255, 255, 0.9);
            margin-bottom: 32px;
            max-width: 600px;
            margin-left: auto;
            margin-right: auto;
        }
    </style>

    <!-- Hero Section -->
    <section class="hero">
        <div class="hero-content">
            <div class="hero-badge">
                <span>🎓</span>
                <span>CICT Student Council Store</span>
            </div>
            <h1 class="hero-title gsap-hero-title">Campus Merch & Services</h1>
            <p class="hero-subtitle gsap-hero-subtitle">
                Quality merchandise and professional services for the ISUFST community.
                Every purchase supports student initiatives.
            </p>
            <div class="hero-buttons">
                <a href="<?php echo e(route('shop.index')); ?>" class="btn-primary">
                    <span>Shop Now</span>
                    <span>→</span>
                </a>
                <a href="<?php echo e(route('services.index')); ?>" class="btn-secondary">
                    View Services
                </a>
            </div>
        </div>
    </section>

    <!-- Featured Products Section -->
    <section class="section">
        <div class="section-container">
            <div class="section-header">
                <h2 class="section-title">Featured Products</h2>
                <p class="section-subtitle">Our most popular campus merchandise</p>
            </div>

            <div class="products-grid">
                <?php
                    $featuredProducts = \App\Models\Product::where('status', 'active')
                        ->orderByDesc('created_at')
                        ->take(4)
                        ->get();
                ?>

                <?php $__empty_1 = true; $__currentLoopData = $featuredProducts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                    <a href="<?php echo e(route('shop.show', $product->slug)); ?>" class="product-card reveal-on-scroll">
                        <div class="product-image">
                            <?php if(!empty($product->image_url)): ?>
                                <img src="<?php echo e($product->image_url); ?>" alt="<?php echo e($product->name); ?>">
                            <?php else: ?>
                                <div
                                    style="width: 100%; height: 100%; display: flex; align-items: center; justify-content: center; color: var(--text-secondary);">
                                    No Image
                                </div>
                            <?php endif; ?>
                        </div>
                        <div class="product-info">
                            <h3 class="product-title"><?php echo e($product->name); ?></h3>
                            <div class="product-price">₱<?php echo e(number_format($product->base_price, 0)); ?></div>
                        </div>
                    </a>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                    <p style="grid-column: 1/-1; text-align: center; color: var(--text-secondary);">
                        No products available yet.
                    </p>
                <?php endif; ?>
            </div>

            <?php if($featuredProducts->count() > 0): ?>
                <div class="view-all-wrapper">
                    <a href="<?php echo e(route('shop.index')); ?>" class="btn-outline">
                        View All Products
                        <span>→</span>
                    </a>
                </div>
            <?php endif; ?>
        </div>
    </section>

    <!-- Services Section -->
    <section class="section section-alt">
        <div class="section-container">
            <div class="section-header">
                <h2 class="section-title">Our Services</h2>
                <p class="section-subtitle">Professional printing and digital solutions for students and organizations
                </p>
            </div>

            <div class="services-grid">
                <?php
                    $featuredServices = \App\Models\Service::where('is_active', true)
                        ->orderByDesc('created_at')
                        ->take(3)
                        ->get();
                ?>

                <?php $__empty_1 = true; $__currentLoopData = $featuredServices; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $service): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                    <a href="<?php echo e(route('services.show', $service->slug)); ?>" class="service-card reveal-on-scroll">
                        <div class="service-icon"><?php echo e($service->icon ?? '🖨️'); ?></div>
                        <h3 class="service-title"><?php echo e($service->title); ?></h3>
                        <p class="service-desc"><?php echo e(Str::limit($service->description, 100)); ?></p>
                        <?php if($service->price_bw || $service->price_color): ?>
                            <div class="service-price">
                                From ₱<?php echo e(number_format($service->price_bw ?? $service->price_color, 2)); ?>

                            </div>
                        <?php endif; ?>
                    </a>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                    <p style="grid-column: 1/-1; text-align: center; color: var(--text-secondary);">
                        No services available yet.
                    </p>
                <?php endif; ?>
            </div>

            <?php if($featuredServices->count() > 0): ?>
                <div class="view-all-wrapper">
                    <a href="<?php echo e(route('services.index')); ?>" class="btn-outline">
                        View All Services
                        <span>→</span>
                    </a>
                </div>
            <?php endif; ?>
        </div>
    </section>

    <!-- About Section -->
    <section class="section section-alt">
        <div class="section-container">
            <div class="about-grid">
                <div class="about-image reveal-on-scroll">
                    <?php
                        $logoSetting = \App\Models\Setting::where('key', 'site_logo')->first();
                        $logoUrl = $logoSetting && $logoSetting->value 
                            ? \Storage::disk('supabase')->url($logoSetting->value) 
                            : asset('images/ctrlp-logo.png');
                    ?>
                    <div style="width: 100%; max-width: 400px; aspect-ratio: 1; margin: 0 auto; border-radius: 50%; overflow: hidden; background: linear-gradient(135deg, #8B0000 0%, #6B0000 100%); box-shadow: 0 20px 60px rgba(139, 0, 0, 0.4); border: 4px solid rgba(255, 255, 255, 0.1); display: flex; align-items: center; justify-content: center;">
                        <img src="<?php echo e($logoUrl); ?>" alt="CICT-DG Logo" style="width: 80%; height: 80%; object-fit: cover; border-radius: 50%;">
                    </div>
                </div>
                <div class="about-content reveal-on-scroll">
                    <h2>About CICT-DG</h2>
                    <p>
                        CICT-DG is the official merchandise and services platform of the CICT Student Council
                        at ISUFST Dingle Campus. We provide quality products and professional services
                        to support student needs and fund campus initiatives.
                    </p>
                    <p>
                        From printed materials to custom merchandise, we're here to serve the academic community
                        with reliability and excellence.
                    </p>
                    <a href="<?php echo e(route('contact.index')); ?>" class="btn-outline">
                        Get in Touch
                        <span>→</span>
                    </a>
                </div>
            </div>
        </div>
    </section>

    <!-- CTA Section -->
    <section class="cta-section">
        <div class="section-container">
            <h2 class="cta-title">Ready to Order?</h2>
            <p class="cta-subtitle">
                Browse our collection of campus merchandise or request a service today.
            </p>
            <div class="hero-buttons">
                <a href="<?php echo e(route('shop.index')); ?>" class="btn-primary">
                    <span>Start Shopping</span>
                    <span>→</span>
                </a>
            </div>
        </div>
    </section>

 <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal4619374cef299e94fd7263111d0abc69)): ?>
<?php $attributes = $__attributesOriginal4619374cef299e94fd7263111d0abc69; ?>
<?php unset($__attributesOriginal4619374cef299e94fd7263111d0abc69); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal4619374cef299e94fd7263111d0abc69)): ?>
<?php $component = $__componentOriginal4619374cef299e94fd7263111d0abc69; ?>
<?php unset($__componentOriginal4619374cef299e94fd7263111d0abc69); ?>
<?php endif; ?><?php /**PATH C:\xampp\htdocs\laravel_igp\resources\views/home/homepage.blade.php ENDPATH**/ ?>