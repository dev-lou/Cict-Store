<x-app-layout 
    :title="'CICT Dingle Store | ISUFST Student Council Merchandise & Services'"
    :meta_description="'Official CICT Student Council Store at ISUFST Dingle Campus, Iloilo. Shop student merchandise, access printing services, document services, and more. Serving Iloilo State University students in Dingle campus.'">
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
            background: url('{{ asset("images/cict_hero_bg.png") }}') center/cover;
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
                grid-template-columns: 1fr;
                gap: 16px;
                max-width: 500px;
                margin: 0 auto;
            }
        }

        .service-card {
            background: var(--bg-primary);
            border: 1px solid var(--border);
            border-radius: var(--radius-lg);
            padding: 32px;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            text-decoration: none;
            display: flex;
            flex-direction: column;
            align-items: center;
            text-align: center;
            position: relative;
            overflow: hidden;
        }

        .service-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 4px;
            background: linear-gradient(90deg, var(--primary), #A00000);
            transform: scaleX(0);
            transform-origin: left;
            transition: transform 0.3s ease;
        }

        .service-card:hover {
            transform: translateY(-4px);
            box-shadow: 0 12px 24px -8px rgba(139, 0, 0, 0.15), 0 4px 8px rgba(0, 0, 0, 0.06);
            border-color: rgba(139, 0, 0, 0.2);
        }

        .service-card:hover::before {
            transform: scaleX(1);
        }

        .service-card:active {
            transform: translateY(-2px);
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
            transition: transform 0.3s ease;
        }

        .service-card:hover .service-icon {
            transform: scale(1.05);
        }

        .service-title {
            font-size: 20px;
            font-weight: 600;
            color: var(--text-primary);
            margin-bottom: 12px;
            line-height: 1.3;
        }

        .service-desc {
            font-size: 14px;
            color: var(--text-secondary);
            line-height: 1.6;
            margin-bottom: 16px;
            flex-grow: 1;
        }

        .service-price {
            font-size: 16px;
            font-weight: 700;
            color: var(--primary);
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 4px;
        }

        .service-price::after {
            content: '→';
            opacity: 0;
            transform: translateX(-8px);
            transition: all 0.3s ease;
        }

        .service-card:hover .service-price::after {
            opacity: 1;
            transform: translateX(0);
        }

        /* Mobile optimization */
        @media (max-width: 768px) {
            .service-card {
                padding: 24px;
                border-radius: 16px;
            }

            .service-icon {
                width: 52px;
                height: 52px;
                font-size: 26px;
                margin-bottom: 16px;
            }

            .service-title {
                font-size: 18px;
                margin-bottom: 10px;
            }

            .service-desc {
                font-size: 14px;
                line-height: 1.5;
                margin-bottom: 14px;
            }

            .service-price {
                font-size: 15px;
            }
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

            .section-container {
                padding: 0 16px;
            }

            .about-image > div {
                max-width: 230px !important;
            }
        }

        .about-image {
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 0;
            border-radius: 0;
            overflow: visible;
            background: transparent;
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
            max-width: 1100px;
            margin: 0 auto;
            border-radius: 24px;
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
                <span>ISUFST Dingle Campus Store</span>
            </div>
            <h1 class="hero-title gsap-hero-title">CICT Dingle Store — Campus Merch & Services</h1>
            <p class="hero-subtitle gsap-hero-subtitle">
                Official CICT Student Council Store at ISUFST Dingle Campus, Iloilo. Quality merchandise and professional services for the ISUFST community.
                Every purchase supports student initiatives.
            </p>
            <div class="hero-buttons">
                <a href="{{ route('shop.index') }}" class="btn-primary">
                    <span>Shop Now</span>
                    <span>→</span>
                </a>
                <a href="{{ route('services.index') }}" class="btn-secondary">
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

                @forelse($featuredProducts as $product)
                    @php
                        // Get the first active variant to show its price
                        $firstVariant = DB::table('product_variants')
                            ->where('product_id', $product->id)
                            ->where('status', 'active')
                            ->orderBy('price_modifier', 'asc')
                            ->first();
                        
                        // Calculate display price: if variant exists, show base_price + price_modifier, else show base_price
                        $displayPrice = $firstVariant 
                            ? $product->base_price + $firstVariant->price_modifier 
                            : $product->base_price;
                    @endphp
                    <a href="{{ route('shop.show', $product->slug) }}" class="product-card reveal-on-scroll">
                        <div class="product-image">
                            @if(!empty($product->image_url))
                                <img src="{{ $product->image_url }}" 
                                     alt="{{ $product->name }}" 
                                     loading="lazy" 
                                     decoding="async"
                                     width="400"
                                     height="400">
                            @else
                                <div
                                    style="width: 100%; height: 100%; display: flex; align-items: center; justify-content: center; color: var(--text-secondary);">
                                    No Image
                                </div>
                            @endif
                        </div>
                        <div class="product-info">
                            <h3 class="product-title">{{ $product->name }}</h3>
                            <div class="product-price">₱{{ number_format($displayPrice, 0) }}</div>
                        </div>
                    </a>
                @empty
                    <p style="grid-column: 1/-1; text-align: center; color: var(--text-secondary);">
                        No products available yet.
                    </p>
                @endforelse
            </div>

            @if($featuredProducts->count() > 0)
                <div class="view-all-wrapper">
                    <a href="{{ route('shop.index') }}" class="btn-outline">
                        View All Products
                        <span>→</span>
                    </a>
                </div>
            @endif
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

                @forelse($featuredServices as $service)
                    <a href="{{ route('services.show', $service->slug) }}" class="service-card reveal-on-scroll">
                        <div class="service-icon">{{ $service->icon ?? '🖨️' }}</div>
                        <h3 class="service-title">{{ $service->title }}</h3>
                        <p class="service-desc">{{ Str::limit($service->description, 100) }}</p>
                        @if($service->price_bw || $service->price_color)
                            <div class="service-price">
                                From ₱{{ number_format($service->price_bw ?? $service->price_color, 2) }}
                            </div>
                        @endif
                    </a>
                @empty
                    <p style="grid-column: 1/-1; text-align: center; color: var(--text-secondary);">
                        No services available yet.
                    </p>
                @endforelse
            </div>

            @if($featuredServices->count() > 0)
                <div class="view-all-wrapper">
                    <a href="{{ route('services.index') }}" class="btn-outline">
                        View All Services
                        <span>→</span>
                    </a>
                </div>
            @endif
        </div>
    </section>

    <!-- About Section -->
    <section class="section section-alt">
        <div class="section-container">
            <div class="about-grid">
                <div class="about-image reveal-on-scroll">
                    <div style="width: 100%; max-width: 340px; aspect-ratio: 1; margin: 0 auto; display: flex; align-items: center; justify-content: center; border-radius: 50%; overflow: hidden; background: #f1f5f9; box-shadow: 0 18px 40px rgba(0, 0, 0, 0.12);">
                        <img src="{{ $logoUrl }}" alt="{{ config('app.name', 'CICT Dingle') }} Logo" loading="lazy" decoding="async"
                            style="width: 100%; height: 100%; object-fit: cover; object-position: center; display: block;">
                    </div>
                </div>
                <div class="about-content reveal-on-scroll">
                    <h2>About {{ config('app.name', 'CICT Dingle') }}</h2>
                    <p>
                        Your one-stop campus shop at ISUFST Dingle Campus. We're the official merchandise and services hub 
                        run by the CICT Student Council, offering quality campus merch, professional printing, and digital solutions 
                        that make student life easier.
                    </p>
                    <p>
                        Every purchase supports student programs and campus initiatives. From custom apparel to print services, 
                        we deliver excellence for the academic community.
                    </p>
                    <a href="{{ route('contact.index') }}" class="btn-outline">
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
                <a href="{{ route('shop.index') }}" class="btn-primary">
                    <span>Start Shopping</span>
                    <span>→</span>
                </a>
            </div>
        </div>
    </section>

</x-app-layout>