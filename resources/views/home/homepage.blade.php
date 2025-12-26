<x-app-layout :title="'Ctrl+P — Merchandise & Services'">
    <!-- SweetAlert2 for notifications -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    
    <style>
        :root {
            --primary-blue: #8B0000;
            --primary-blue-light: #A00000;
            --primary-text: #1F1F1F;
            --secondary-text: #555555;
            --light-bg: #F7F8FB;
            --white: #FFFFFF;
            --border-light: #E8DCC8;
            --shadow-light: 0 2px 8px rgba(0, 0, 0, 0.06);
            --shadow-medium: 0 4px 16px rgba(0, 0, 0, 0.08);
        }

        /* ============ HERO SECTION ============ */
        .hero-section {
            position: relative;
            min-height: 86vh;
            padding: 200px 20px 150px;
            background: linear-gradient(135deg, rgba(139, 0, 0, 0.88) 0%, rgba(160, 0, 0, 0.86) 100%),
                        url('https://wallpapers.com/images/hd/school-background-oxlcd9ghmwrsup8l.jpg') center/cover;
            color: #FFFFFF;
            text-align: center;
            margin-top: -70px;
            border-radius: 0 0 32px 32px;
            box-shadow: inset 0 -90px 160px rgba(0,0,0,0.18);
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .hero-content {
            max-width: 960px;
            margin: 0 auto;
            padding: 24px;
        }

        .hero-title {
            font-size: 58px;
            font-weight: 900;
            margin-bottom: 14px;
            line-height: 1.15;
            letter-spacing: -1.6px;
            text-shadow: 0 4px 16px rgba(0, 0, 0, 0.6);
        }

        .hero-subtitle {
            font-size: 19px;
            color: rgba(255, 255, 255, 0.94);
            margin-bottom: 32px;
            font-weight: 600;
            letter-spacing: 0.2px;
            line-height: 1.65;
            text-shadow: 0 3px 8px rgba(0, 0, 0, 0.5);
            max-width: 760px;
            margin-left: auto;
            margin-right: auto;
        }

        .hero-kicker {
            display: inline-flex;
            align-items: center;
            gap: 10px;
            padding: 8px 14px;
            border-radius: 999px;
            background: rgba(255,255,255,0.12);
            color: #fff;
            font-weight: 700;
            letter-spacing: 0.35px;
            margin-bottom: 16px;
            font-size: 13px;
        }

        .hero-button {
            display: inline-block;
            background: linear-gradient(135deg, #fbbf24 0%, #f59e0b 100%);
            color: #111827;
            padding: 16px 40px;
            border-radius: 12px;
            text-decoration: none;
            font-weight: 800;
            font-size: 16px;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            box-shadow: 0 10px 30px rgba(251, 191, 36, 0.35);
            border: none;
            cursor: pointer;
            letter-spacing: 0.5px;
        }

        .hero-button:hover {
            transform: translateY(-3px);
            box-shadow: 0 14px 36px rgba(251, 191, 36, 0.45);
        }

        .hero-button.secondary {
            background: rgba(255, 255, 255, 0.14);
            border: 1.5px solid rgba(255, 255, 255, 0.7);
            color: #FFFFFF;
            box-shadow: inset 0 1px 0 rgba(255,255,255,0.18), 0 8px 24px rgba(0, 0, 0, 0.25);
        }

        .hero-button.secondary:hover {
            background: rgba(255, 255, 255, 0.22);
            transform: translateY(-3px);
            box-shadow: inset 0 1px 0 rgba(255,255,255,0.24), 0 12px 28px rgba(0, 0, 0, 0.3);
        }

        /* ============ FEATURED PRODUCTS SECTION ============ */
        .featured-section {
            padding: 80px 20px;
            background: var(--light-bg);
        }

        .section-container {
            max-width: 1200px;
            margin: 0 auto;
        }

        .section-heading {
            font-size: 42px;
            font-weight: 800;
            color: var(--primary-text);
            margin-bottom: 60px;
            text-align: center;
            letter-spacing: -0.5px;
        }

        .products-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
            gap: 28px;
            margin-bottom: 60px;
        }

        .product-card {
            background: var(--white);
            border: 1px solid var(--border-light);
            border-radius: 14px;
            overflow: hidden;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            box-shadow: var(--shadow-light);
            display: flex;
            flex-direction: column;
            cursor: pointer;
        }

        .product-card:hover {
            transform: translateY(-6px);
            box-shadow: var(--shadow-medium);
            border-color: var(--primary-blue);
        }

        .product-image {
            width: 100%;
            height: 260px;
            background: linear-gradient(135deg, #F0F0F0 0%, #E8E8E8 100%);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 14px;
            color: #999999;
            font-weight: 500;
            overflow: hidden;
        }

        .product-image img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .product-info {
            padding: 24px;
            flex-grow: 1;
            display: flex;
            flex-direction: column;
        }

        .product-title {
            font-size: 18px;
            font-weight: 700;
            color: var(--primary-text);
            margin-bottom: 8px;
            line-height: 1.4;
        }

        .product-price {
            font-size: 20px;
            font-weight: 800;
            color: var(--primary-blue);
            margin-bottom: 12px;
        }

        .product-description {
            font-size: 14px;
            color: var(--secondary-text);
            margin-bottom: 16px;
            flex-grow: 1;
        }

        .product-link {
            display: inline-block;
            color: var(--primary-blue);
            text-decoration: none;
            font-weight: 700;
            font-size: 14px;
            transition: all 0.3s;
            letter-spacing: 0.3px;
        }

        .product-link:hover {
            color: var(--primary-blue-light);
            transform: translateX(4px);
        }

        .view-all-btn {
            display: inline-block;
            margin: 0 auto;
            background: transparent;
            border: 2px solid var(--primary-blue);
            color: var(--primary-blue);
            padding: 14px 36px;
            border-radius: 12px;
            text-decoration: none;
            font-weight: 700;
            font-size: 16px;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            cursor: pointer;
            letter-spacing: 0.5px;
        }

        .view-all-btn:hover {
            background: var(--primary-blue);
            color: white;
            transform: translateY(-2px);
            box-shadow: 0 4px 16px rgba(0, 58, 150, 0.2);
        }

        /* ============ SERVICES SECTION ============ */
        .services-section {
            padding: 80px 20px;
            background: #F7F8FB;
        }

        .services-bento-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(260px, 1fr));
            gap: 18px;
            margin-top: 48px;
            grid-auto-rows: 1fr;
        }

        .service-bento-card {
            background: #FFFFFF;
            border: 1px solid #E5E7EB;
            border-radius: 16px;
            padding: 20px;
            display: flex;
            flex-direction: column;
            gap: 10px;
            min-height: 190px;
            box-shadow: 0 12px 30px rgba(15, 23, 42, 0.06);
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }

        .service-bento-card:hover {
            transform: translateY(-3px);
            box-shadow: 0 16px 36px rgba(15, 23, 42, 0.08);
            border-color: #8B0000;
        }

        .service-bento-header {
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .service-badge {
            width: 44px;
            height: 44px;
            border-radius: 12px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            font-weight: 800;
            color: #FFFFFF;
            font-size: 18px;
            box-shadow: 0 8px 18px rgba(0,0,0,0.08);
        }

        .service-bento-card h3 {
            margin: 0;
            font-size: 18px;
            font-weight: 800;
            color: #0F172A;
            letter-spacing: -0.2px;
        }

        .service-bento-card p {
            margin: 0;
            color: #4B5563;
            font-size: 14px;
            line-height: 1.6;
        }

        .service-link {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            color: #8B0000;
            font-weight: 800;
            text-decoration: none;
            margin-top: auto;
        }

        .service-link:hover {
            text-decoration: underline;
        }

        .service-title {
            font-size: 22px;
            font-weight: 800;
            color: var(--primary-text);
            margin-bottom: 12px;
            letter-spacing: -0.3px;
        }

        .service-description {
            font-size: 15px;
            color: var(--secondary-text);
            line-height: 1.8;
        }

        /* ============ ABOUT SECTION ============ */
        .about-section {
            padding: 80px 20px;
            background: var(--light-bg);
        }

        .about-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 60px;
            align-items: center;
            margin-top: 40px;
        }

        .about-content h3 {
            font-size: 28px;
            font-weight: 800;
            color: var(--primary-text);
            margin-bottom: 24px;
            letter-spacing: -0.5px;
        }

        .about-text {
            font-size: 16px;
            color: var(--secondary-text);
            line-height: 1.9;
            margin-bottom: 32px;
        }

        .about-button {
            display: inline-block;
            background: transparent;
            border: 2px solid var(--primary-blue);
            color: var(--primary-blue);
            padding: 14px 32px;
            border-radius: 12px;
            text-decoration: none;
            font-weight: 700;
            font-size: 16px;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            cursor: pointer;
            letter-spacing: 0.5px;
        }

        .about-button:hover {
            background: var(--primary-blue);
            color: white;
            transform: translateY(-2px);
            box-shadow: 0 4px 16px rgba(0, 58, 150, 0.2);
        }

        .about-image {
            width: 100%;
            aspect-ratio: 1;
            background: linear-gradient(135deg, #F0F0F0 0%, #E8E8E8 100%);
            border-radius: 14px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 14px;
            color: #999999;
            font-weight: 500;
            overflow: hidden;
            box-shadow: var(--shadow-light);
        }

        .about-image img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        /* ============ CONTACT SECTION ============ */
        .contact-section {
            padding: 80px 20px;
            background: #FFFAF1;
        }

        .contact-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 60px;
            margin-top: 40px;
            align-items: start;
        }

        .contact-info {
            display: flex;
            flex-direction: column;
            gap: 32px;
        }

        .contact-block {
            display: flex;
            flex-direction: column;
            gap: 8px;
        }

        .contact-label {
            font-size: 13px;
            font-weight: 800;
            text-transform: uppercase;
            color: var(--secondary-text);
            letter-spacing: 1px;
        }

        .contact-value {
            font-size: 18px;
            font-weight: 700;
            color: var(--primary-text);
            line-height: 1.6;
        }

        .contact-links {
            display: flex;
            gap: 16px;
            flex-wrap: wrap;
        }

        .contact-link {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            color: var(--primary-blue);
            text-decoration: none;
            font-weight: 700;
            font-size: 14px;
            transition: all 0.3s;
            letter-spacing: 0.3px;
        }

        .contact-link:hover {
            color: var(--primary-blue-light);
            transform: translateX(4px);
        }

        .map-container {
            width: 100%;
            height: 500px;
            border-radius: 14px;
            overflow: hidden;
            box-shadow: var(--shadow-light);
            border: 1px solid var(--border-light);
            display: block;
            position: relative;
            margin: 0;
            padding: 0;
        }

        .map-link {
            display: block;
            width: 100%;
            height: 100%;
            position: relative;
            text-decoration: none;
        }

        .map-link img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            display: block;
        }

        .map-overlay {
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: rgba(0, 0, 0, 0);
            display: flex;
            align-items: center;
            justify-content: center;
            transition: background 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }

        .map-link:hover .map-overlay {
            background: rgba(0, 0, 0, 0.4);
        }

        .map-text {
            color: white;
            font-size: 16px;
            font-weight: 600;
            opacity: 0;
            transition: opacity 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }

        .map-link:hover .map-text {
            opacity: 1;
        }

        .map-container iframe {
            width: 100% !important;
            height: 100% !important;
            border: none !important;
            display: block !important;
            margin: 0 !important;
            padding: 0 !important;
        }

        /* ============ RESPONSIVE ============ */
        @media (max-width: 768px) {
            .hero-title {
                font-size: 36px;
            }

            .hero-subtitle {
                font-size: 16px;
                margin-bottom: 32px;
            }

            .section-heading {
                font-size: 32px;
                margin-bottom: 40px;
            }

            .about-grid,
            .contact-grid {
                grid-template-columns: 1fr;
                gap: 40px;
            }

            .products-grid {
                grid-template-columns: repeat(2, 1fr);
                gap: 16px;
            }

            .services-grid {
                grid-template-columns: 1fr;
            }

            .hero-section {
                padding: 80px 20px 60px;
            }

            .featured-section,
            .services-section,
            .about-section,
            .contact-section {
                padding: 60px 20px;
            }

            .contact-grid {
                gap: 40px;
            }

            .map-container {
                height: 350px;
            }
        }

        @media (max-width: 480px) {
            .hero-title {
                font-size: 1.5rem !important;
                margin-bottom: 8px !important;
                letter-spacing: -0.5px !important;
            }
            
            .hero-section h2 {
                font-size: 1.125rem !important;
                margin-bottom: 12px !important;
            }

            .hero-subtitle {
                font-size: 0.8125rem !important;
                margin-bottom: 24px !important;
                line-height: 1.5 !important;
            }

            .section-heading {
                font-size: 24px;
                margin-bottom: 32px;
            }

            .hero-button {
                padding: 12px 28px;
                font-size: 14px;
            }

            .product-card {
                margin: 0;
            }

            .product-image {
                height: 180px;
            }

            .product-info {
                padding: 16px;
            }

            .contact-value {
                font-size: 14px;
            }

            .map-container {
                height: 250px;
            }
        }

        /* ============ SMOOTH SCROLL ============ */
        html {
            scroll-behavior: smooth;
        }

        /* ============ ANIMATIONS ============ */
        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(20px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .section-container {
            animation: fadeInUp 0.6s ease-out;
        }

        /* Logo swap control */
        .logo-swap-btn {
            position: absolute;
            top: 6px;
            right: 6px;
            padding: 6px 10px;
            border-radius: 10px;
            border: 1px solid rgba(0,0,0,0.08);
            background: rgba(255,255,255,0.9);
            color: #8B0000;
            font-weight: 800;
            font-size: 12px;
            box-shadow: 0 6px 18px rgba(0,0,0,0.12);
            cursor: pointer;
            transition: transform 0.15s ease, box-shadow 0.2s ease;
        }

        .logo-swap-btn:hover { transform: translateY(-1px); box-shadow: 0 10px 24px rgba(0,0,0,0.16); }
    </style>

    <div style="background: #F7F8FB; min-height: 100vh; width: 100%; padding-top: 0;">

    <!-- ============ HERO SECTION ============ -->
        <section class="hero-section">
            <div class="hero-content">
                <div class="hero-kicker">The Official CICT Merchandise &amp; Services Hub.</div>
                <h1 class="hero-title">Ctrl+P: Your Shortcut to Campus Essentials.</h1>
                <p class="hero-subtitle">We’ve streamlined student life at ISUFST Dingle Campus. Access official merch, fast printing, and essential student services in one seamless digital command center.</p>
                <div style="display:flex; gap:12px; justify-content:center; flex-wrap:wrap;">
                    <a href="{{ route('shop.index') }}" class="hero-button">Shop Merch</a>
                    <a href="{{ route('services.index') }}" class="hero-button secondary">Browse Services</a>
                </div>
            </div>
        </section>

    <!-- ============ FEATURED PRODUCTS SECTION ============ -->
    <section class="featured-section">
        <div class="section-container">
            <h2 class="section-heading">Popular Merchandise</h2>
            
            <div class="products-grid">
                @php /** @var \App\Models\Product[]|\Illuminate\Support\Collection $featuredProducts */ @endphp
                @forelse($featuredProducts ?? [] as $product)
                    @if($product)
                        <a href="{{ route('shop.show', $product) }}" class="product-card reveal-on-scroll" data-reveal-delay="{{ ($loop->index % 4) * 100 }}">
                    @else
                        <div class="product-card disabled reveal-on-scroll" data-reveal-delay="{{ ($loop->index % 4) * 100 }}">
                    @endif
                        <div class="product-image">
                            @if(!empty($product?->image_url))
                                <img src="{{ $product->image_url }}" alt="{{ $product->name ?? 'Product' }}">
                            @elseif(!empty($product?->image_path))
                                <img src="{{ $product->image_url }}" alt="{{ $product?->name ?? 'Product' }}">
                            @else
                                <span>No Image</span>
                            @endif
                        </div>
                        <div class="product-info">
                            <h3 class="product-title">{{ $product?->name ?? 'Unknown Product' }}</h3>
                            <p class="product-price">₱{{ number_format($product?->base_price ?? 0, 2) }}</p>
                            <p class="product-description">{{ Str::limit($product?->description ?? '', 80) }}</p>
                            <span class="product-link">View Details →</span>
                        </div>
                    @if($product)
                    </a>
                    @else
                        </div>
                    @endif
                @empty
                    <div style="grid-column: 1 / -1; text-align: center; padding: 40px; color: #999;">
                        <p style="font-size: 16px;">No featured products available yet.</p>
                    </div>
                @endforelse
            </div>

            <a href="{{ route('shop.index') }}" class="view-all-btn">View All Products</a>
        </div>
    </section>

    <!-- ============ SERVICES SECTION ============ -->
    <section class="services-section">
        <div class="section-container">
            <h2 class="section-heading">Our Services</h2>
            
            <div class="services-bento-grid">
                @forelse($serviceCategories ?? [] as $category)
                    @php
                        $label = $category['name'] ?? 'General';
                        $count = $category['count'] ?? 0;
                        $palette = [
                            ['#8B0000', '#A00000'],
                            ['#0EA5E9', '#0284C7'],
                            ['#10B981', '#059669'],
                            ['#F59E0B', '#D97706'],
                            ['#8B5CF6', '#7C3AED'],
                        ];
                        $swatch = $palette[$loop->index % count($palette)];
                        $initial = Str::upper(Str::substr($label, 0, 1));
                    @endphp
                    <div class="service-bento-card reveal-on-scroll" data-reveal-delay="{{ ($loop->index % 4) * 100 }}">
                        <div class="service-bento-header">
                            <div class="service-badge" style="background: linear-gradient(135deg, {{ $swatch[0] }} 0%, {{ $swatch[1] }} 100%);">{{ $initial }}</div>
                            <div>
                                <h3>{{ $label }}</h3>
                                <p style="font-size: 12.5px; color: #6B7280; margin-top: 4px;">{{ $count }} service{{ $count === 1 ? '' : 's' }} available</p>
                            </div>
                        </div>
                        <p>{{ $category['description'] ?? 'Explore options for ' . Str::lower($label) . ' and get fast support tailored to students and orgs.' }}</p>
                        <a href="{{ route('services.index') }}" class="service-link">View services →</a>
                    </div>
                @empty
                    <div class="service-bento-card" style="grid-column: 1 / -1; text-align: center;">
                        <div class="service-badge" style="background: linear-gradient(135deg, #8B0000 0%, #A00000 100%); margin: 0 auto 8px;">!</div>
                        <h3 style="margin: 0 0 6px 0;">Services coming soon</h3>
                        <p style="margin: 0;">We’re updating categories. Please check back shortly.</p>
                    </div>
                @endforelse
            </div>
        </div>
    </section>

    <!-- ============ ABOUT SECTION ============ -->
    <section class="about-section">
        <div class="section-container">
            <h2 class="section-heading">About CICT Council</h2>
            
            <div class="about-grid">
                <div class="about-content reveal-on-scroll" data-reveal-delay="0">
                    <h3>Your Student-Run Enterprise</h3>
                    <p class="about-text">
                        The CICT (College of Information and Communication Technology) Student Council operates this enterprise to serve the entire ISUFST Dingle Campus community. We are dedicated to providing high-quality merchandise and professional printing services at student-friendly prices, supporting both campus needs and student organization fundraising efforts.
                    </p>
                    
                    <h4 style="margin-top: 24px; margin-bottom: 12px; font-size: 16px; font-weight: 600; color: #333;">Our Mission</h4>
                    <p class="about-text" style="margin-bottom: 24px;">
                        To support CICT students by providing high-quality merchandise and professional printing services at affordable prices, generating sustainable revenue for student programs and activities.
                    </p>
                    
                    <p class="about-text" style="font-size: 14px; color: #666; margin-bottom: 24px;">
                        Since our establishment, the CICT Student Council has been a trusted partner for quality merchandise in the ISUFST Dingle Campus. Every purchase directly supports student welfare programs, cultural events, and academic initiatives.
                    </p>
                    
                </div>
                <div class="about-image reveal-on-scroll" data-reveal-delay="150">
                    <div style="display: flex; align-items: center; justify-content: center; min-height: 400px; position: relative;">
                        <button type="button" class="logo-swap-btn" id="logo-swap-btn" aria-label="Swap logo">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" style="width:16px; height:16px;">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M4 7h13l-3-3m3 13H4l3 3" />
                            </svg>
                        </button>
                        <img
                            id="about-logo-img"
                            src="{{ asset('images/cict-logo.png') }}"
                            data-primary="{{ asset('images/cict-logo.png') }}"
                            data-alt="{{ asset('images/ctrlp-logo.png') }}"
                            alt="CICT Student Council Logo"
                            style="width: 420px; height: 420px; object-fit: cover; border-radius: 50%; box-shadow: 0 12px 32px rgba(0, 0, 0, 0.18);">
                    </div>
                </div>
            </div>
        </div>
    </section>

    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Map is now embedded as iframe
            const logoImg = document.getElementById('about-logo-img');
            const swapBtn = document.getElementById('logo-swap-btn');
            if (logoImg && swapBtn) {
                swapBtn.addEventListener('click', () => {
                    const primary = logoImg.getAttribute('data-primary');
                    const alt = logoImg.getAttribute('data-alt');
                    const current = logoImg.getAttribute('src');
                    const next = current === primary ? alt : primary;
                    logoImg.setAttribute('src', next || primary);
                    logoImg.setAttribute('alt', next === primary ? 'CICT Student Council Logo' : 'Ctrl+P Logo');
                });
            }
        });
    </script>
</x-app-layout>
