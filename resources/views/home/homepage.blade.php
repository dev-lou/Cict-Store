<x-app-layout :title="'ISUFST CICT | Dingle Campus'"
    :meta_description="'Official ISUFST CICT Student Council Store at Dingle Campus. Shop quality merchandise, access services, and digital solutions. Supporting student programs.'">

    @php
        $faviconUrl = Cache::remember('site.favicon_url', 3600, function () {
            $faviconSetting = \App\Models\Setting::where('key', 'site_favicon')->first();
            /** @var \Illuminate\Filesystem\FilesystemAdapter $faviconDisk */
            $faviconDisk = \Storage::disk('supabase');
            return ($faviconSetting && $faviconSetting->value)
                ? $faviconDisk->url($faviconSetting->value)
                : asset('images/cict-logo.webp');
        });
    @endphp

    <style>
        .hero-section--home {
            padding: clamp(4.5rem, 6vw, 5.5rem) 1.5rem 2rem;
            position: relative;
        }

        .home-section {
            padding: 5rem 1.5rem;
        }

        .home-section--cta {
            padding: 0 1.5rem 3rem;
        }

        .home-section--quick {
            padding: 0 1.5rem 4rem;
        }

        .home-hero-grid {
            display: block;
        }



        .home-sale-ticker {
            background: #f2f2f2;
            border-top: 1px solid #e1e1e1;
            border-bottom: 1px solid #e1e1e1;
            overflow: hidden;
            padding: 0.95rem 0;
        }

        .home-sale-ticker-track {
            display: flex;
            width: max-content;
            align-items: center;
            animation: homeTicker 22s linear infinite;
            will-change: transform;
        }

        .home-sale-ticker-group {
            display: flex;
            align-items: center;
            flex-shrink: 0;
            white-space: nowrap;
        }

        .home-sale-ticker-text {
            display: inline-flex;
            align-items: center;
            gap: 1.1rem;
            font-family: var(--font-heading);
            font-size: clamp(1.85rem, 4vw, 2.35rem);
            font-weight: 800;
            letter-spacing: 0.03em;
            text-transform: uppercase;
            color: transparent;
            -webkit-text-stroke: 1px #606a74;
            text-stroke: 1px #606a74;
            margin-right: 1.9rem;
            line-height: 1;
        }

        .home-sale-ticker-text .accent {
            color: #c93434;
            -webkit-text-stroke: 0;
            text-stroke: 0;
        }

        @keyframes homeTicker {
            from { transform: translateX(0); }
            to { transform: translateX(-50%); }
        }

        .home-product-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 1.25rem;
            margin-bottom: 3rem;
        }

        .home-product-card {
            border: 1px solid transparent;
            border-radius: 0.65rem;
            background: #ffffff;
            padding: 0.8rem;
            text-decoration: none;
            color: inherit;
            display: flex;
            flex-direction: column;
            min-height: 100%;
            transition: transform 0.22s ease, box-shadow 0.22s ease, border-color 0.22s ease;
            position: relative;
            box-shadow: 0 8px 18px rgba(15, 23, 42, 0.08);
        }

        .home-product-card:hover {
            transform: translateY(-3px);
            box-shadow: 0 0 0 2px rgba(139, 0, 0, 0.14), 0 12px 24px rgba(15, 23, 42, 0.12);
            border-color: rgba(139, 0, 0, 0.6);
        }

        .home-product-media {
            position: relative;
            border-radius: 0.55rem;
            background: #ffffff;
            aspect-ratio: 3 / 4;
            min-height: 240px;
            padding: 0.5rem;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-bottom: 0.8rem;
            overflow: hidden;
        }

        .home-product-media img {
            position: relative;
            z-index: 1;
            width: auto;
            height: 100%;
            max-width: 100%;
            max-height: 100%;
            object-fit: contain;
            object-position: center;
        }

        .home-product-tag {
            position: absolute;
            top: 0.65rem;
            left: 0.65rem;
            font-size: 0.65rem;
            font-weight: 700;
            background: #c93434;
            color: #fff;
            padding: 0.25rem 0.3rem;
            border-radius: 0.2rem;
            z-index: 20;
        }

        .home-product-badge {
            position: absolute;
            top: 0.65rem;
            right: 0.65rem;
            font-size: 0.7rem;
            color: #fff;
            background: #5b9cf6;
            border: 0;
            padding: 0.22rem 0.38rem;
            border-radius: 0.22rem;
            z-index: 20;
            font-weight: 600;
        }

        .home-product-name {
            margin: 0 0 0.5rem 0;
            font-size: 0.95rem;
            font-weight: 500;
            color: #2d3748;
            line-height: 1.3;
            display: -webkit-box;
            -webkit-line-clamp: 2;
            -webkit-box-orient: vertical;
            overflow: hidden;
        }

        .home-product-price {
            margin: 0 0 0.85rem 0;
            font-size: 1.25rem;
            font-weight: 700;
            color: #1f2937;
            line-height: 1;
        }

        .home-product-footer {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 0.8rem;
            margin-top: auto;
            padding-top: 0.85rem;
            border-top: 1px solid #e5e7eb;
        }

        .home-product-action {
            display: inline-flex;
            align-items: center;
            gap: 0.35rem;
            font-size: 0.85rem;
            font-weight: 600;
            color: #2d3748;
            text-decoration: none;
        }

        .home-product-action svg {
            width: 1rem;
            height: 1rem;
        }

        .home-services-grid {
            display: grid;
            grid-template-columns: minmax(280px, 0.9fr) minmax(0, 1.1fr);
            gap: 2rem;
            align-items: start;
        }

        .home-services-cards {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(260px, 1fr));
            gap: 1rem;
        }

        .home-service-card {
            text-decoration: none;
            display: flex;
            flex-direction: column;
            gap: 0.8rem;
            padding: 1rem;
            border: 1px solid #e5e7eb;
            border-radius: 0.75rem;
            background: #fff;
            min-height: 100%;
            transition: transform 0.2s ease, box-shadow 0.2s ease;
        }

        .home-service-card:hover {
            transform: translateY(-4px);
            box-shadow: 0 10px 20px rgba(15, 23, 42, 0.08);
        }

        .home-service-top {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 0.8rem;
        }

        .home-service-price {
            font-size: 0.76rem;
            font-weight: 800;
            text-transform: uppercase;
            letter-spacing: 0.11em;
            color: #8b0000;
            white-space: nowrap;
        }

        .home-service-title {
            margin: 0;
            font-size: 1.04rem;
            font-weight: 700;
            color: #111827;
            line-height: 1.35;
        }

        .home-service-desc {
            margin: 0;
            font-size: 0.92rem;
            color: #4b5563;
            line-height: 1.62;
            display: -webkit-box;
            -webkit-line-clamp: 3;
            -webkit-box-orient: vertical;
            overflow: hidden;
        }

        .home-service-footer {
            margin-top: auto;
            display: flex;
            align-items: center;
            justify-content: space-between;
            border-top: 1px solid #e5e7eb;
            padding-top: 0.65rem;
        }

        .home-service-link-label {
            font-size: 0.78rem;
            font-weight: 700;
            letter-spacing: 0.09em;
            text-transform: uppercase;
            color: #6b7280;
        }

        .home-service-arrow {
            width: 1.45rem;
            height: 1.45rem;
            border-radius: 9999px;
            border: 1px solid #d1d5db;
            color: #374151;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            font-size: 0.9rem;
            line-height: 1;
        }

        .home-about-grid {
            display: grid;
            grid-template-columns: minmax(0, 0.85fr) minmax(0, 1.15fr);
            gap: 2rem;
            align-items: center;
        }

        .home-services-title-keep {
            white-space: nowrap;
        }

        .home-quick-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(220px, 1fr));
            gap: 1rem;
        }

        .home-services-cta-wrap {
            display: flex;
        }

        .home-hero-actions .btn-secondary {
            background: #ffffff;
            border: 1px solid rgba(255,255,255,0.78);
            color: #7a0e0e;
            box-shadow: 0 10px 22px rgba(8, 15, 35, 0.16), 0 0 0 1px rgba(255,255,255,0.6) inset;
        }

        .home-hero-actions .btn-secondary:hover {
            background: #ffffff;
            border-color: rgba(244,193,90,0.9);
            box-shadow: 0 0 0 2px rgba(244,193,90,0.34), 0 14px 28px rgba(8, 15, 35, 0.2);
            color: #7a0e0e;
        }

        .home-hero-actions .btn-secondary:active {
            background: #fff7e8;
        }

        .home-about-actions .btn-secondary {
            background: #ffffff;
            border: 1px solid #d5deea;
            color: #7a0e0e;
            box-shadow: 0 8px 18px rgba(15, 23, 42, 0.09);
        }

        .home-about-actions .btn-secondary:hover {
            background: #ffffff;
            border-color: rgba(244,193,90,0.85);
            box-shadow: 0 0 0 2px rgba(244,193,90,0.3), 0 12px 24px rgba(15, 23, 42, 0.12);
            color: #7a0e0e;
        }

        .home-about-actions .btn-secondary:active {
            background: #fff7e8;
        }

        .home-products-viewall.btn-secondary {
            background: #ffffff;
            border: 1px solid #d5deea;
            color: #7a0e0e;
            box-shadow: 0 8px 18px rgba(15, 23, 42, 0.09);
        }

        .home-products-viewall.btn-secondary:hover {
            background: #ffffff;
            border-color: rgba(244,193,90,0.85);
            box-shadow: 0 0 0 2px rgba(244,193,90,0.3), 0 12px 24px rgba(15, 23, 42, 0.12);
            color: #7a0e0e;
        }

        .home-products-viewall.btn-secondary:active {
            background: #fff7e8;
        }

        .home-wave-section {
            position: relative;
            padding: 1.55rem 0 2.1rem;
            background: linear-gradient(180deg, #f7f8fb 0%, #edf1f7 100%);
            border-top: 1px solid #d7dee9;
            border-bottom: 1px solid #d7dee9;
            overflow: hidden;
        }

        .home-wave-shell {
            max-width: none;
            margin: 0 auto;
            padding: 0;
        }

        .home-wave-track {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: clamp(0.38rem, 1.2vw, 1rem);
            width: 100%;
            will-change: transform;
            padding: 0 0.2rem;
        }

        .home-wave-item {
            width: clamp(3.65rem, 5.8vw, 4.8rem);
            height: clamp(3.65rem, 5.8vw, 4.8rem);
            flex: 0 0 auto;
            border-radius: 9999px;
            border: 1px solid #cfd8e6;
            background: linear-gradient(145deg, #ffffff 0%, #f2f5fa 100%);
            color: #7a0e0e;
            box-shadow: 0 10px 22px rgba(15, 23, 42, 0.12);
            display: inline-flex;
            align-items: center;
            justify-content: center;
            animation: homeWaveFloat 3.2s ease-in-out infinite;
            animation-delay: calc(var(--wave-delay, 0) * 0.11s);
            transform: translateY(var(--wave-shift, 0px));
            transition: transform 0.24s ease, box-shadow 0.24s ease, border-color 0.24s ease;
        }

        .home-wave-item svg {
            width: clamp(1.3rem, 2vw, 1.55rem);
            height: clamp(1.3rem, 2vw, 1.55rem);
            stroke: currentColor;
            fill: none;
            stroke-width: 2;
            stroke-linecap: round;
            stroke-linejoin: round;
        }

        .home-wave-item:hover {
            transform: translateY(calc(var(--wave-shift, 0px) - 3px));
            border-color: rgba(139, 0, 0, 0.45);
            box-shadow: 0 12px 22px rgba(15, 23, 42, 0.12);
            color: #8b0000;
        }

        .home-wave-item:nth-child(4n + 1) { --wave-shift: -5px; }
        .home-wave-item:nth-child(4n + 2) { --wave-shift: 2px; }
        .home-wave-item:nth-child(4n + 3) { --wave-shift: -2px; }
        .home-wave-item:nth-child(4n + 4) { --wave-shift: 5px; }

        @keyframes homeWaveFloat {
            0%, 100% { transform: translateY(var(--wave-shift, 0px)); }
            50% { transform: translateY(calc(var(--wave-shift, 0px) - 7px)); }
        }

        @media (max-width: 1024px) {
            .hero-section--home {
                padding-top: 6.35rem;
            }

            .home-hero-layout {
                grid-template-columns: 1fr !important;
                gap: 1.25rem !important;
            }

            .home-hero-visual {
                order: 2;
            }

            .home-hero-copy {
                order: 1;
            }

            .home-cta-panel {
                grid-template-columns: 1fr !important;
                align-items: start !important;
                padding: 3.25rem 2rem !important;
            }

            .home-cta-panel a {
                width: fit-content;
            }

            .home-services-grid,
            .home-about-grid {
                grid-template-columns: 1fr;
            }
        }

        @media (max-width: 768px) {
            .hero-section--home {
                padding: 6.25rem 1rem 2.5rem;
            }

            .home-section {
                padding: 3.2rem 1rem;
            }

            .home-section--cta {
                padding: 0 1rem 2rem;
            }

            .home-section--quick {
                padding: 0 1rem 3rem;
            }

            .home-hero-panel {
                border-radius: 1.25rem !important;
                padding: 1.15rem !important;
            }

            .home-hero-title {
                font-size: clamp(2rem, 11vw, 2.7rem) !important;
                line-height: 0.98 !important;
                max-width: 11ch !important;
            }

            .home-hero-subtitle {
                font-size: 0.96rem !important;
                line-height: 1.58 !important;
            }

            .home-hero-feature-card {
                padding: 1rem !important;
                border-radius: 1rem !important;
            }

            .home-hero-stats {
                grid-template-columns: repeat(3, minmax(0, 1fr)) !important;
                gap: 0.45rem !important;
            }

            .home-hero-stat-card {
                padding: 0.62rem !important;
                border-radius: 0.8rem !important;
            }

            .home-hero-stat-value {
                font-size: 1.08rem !important;
            }

            .home-hero-stat-label {
                margin-top: 0.2rem !important;
                font-size: 0.62rem !important;
                letter-spacing: 0.07em !important;
            }

            .home-hero-trust {
                align-items: flex-start !important;
                padding: 0.9rem !important;
                border-radius: 1rem !important;
            }

            .home-hero-actions .btn,
            .home-hero-actions a {
                width: 100%;
                justify-content: center;
            }

            .home-hero-tags {
                display: grid !important;
                grid-template-columns: repeat(3, minmax(0, 1fr));
                gap: 0.42rem !important;
            }

            .home-hero-tag {
                text-align: center;
                padding: 0.42rem 0.24rem !important;
                font-size: 0.62rem !important;
                letter-spacing: 0.01em;
                border-radius: 0.75rem !important;
            }

            .home-sale-ticker {
                padding: 0.7rem 0;
            }

            .home-sale-ticker-text {
                font-size: clamp(1.15rem, 7vw, 1.5rem);
                gap: 0.7rem;
                margin-right: 1rem;
            }

            .home-services-cards {
                gap: 0.9rem;
            }

            .home-wave-section {
                padding: 1.05rem 0 1.45rem;
            }

            .home-wave-shell {
                padding: 0;
            }

            .home-wave-track {
                justify-content: flex-start;
                gap: 0.42rem;
                padding: 0 0.2rem;
            }

            .home-wave-item {
                width: 3.5rem;
                height: 3.5rem;
            }

            .home-services-cta-wrap {
                justify-content: center;
            }

            .home-services-cta {
                width: auto !important;
            }

            .home-hero-visual {
                display: none !important;
            }

            .home-product-grid {
                grid-template-columns: repeat(2, minmax(0, 1fr));
                gap: 0.75rem;
                margin-bottom: 2rem;
            }

            .home-product-card {
                padding: 0.65rem;
            }

            .home-product-media {
                min-height: 180px;
                margin-bottom: 0.6rem;
            }

            .home-product-name {
                font-size: 0.85rem;
            }

            .home-product-price {
                font-size: 1rem;
            }

            .home-product-footer {
                padding-top: 0.65rem;
            }

            .home-about-grid {
                gap: 1.15rem;
            }

            .home-about-kicker,
            .home-about-title {
                text-align: center;
            }

            .home-about-actions {
                justify-content: center;
            }

            .home-about-grid > div:first-child > div {
                width: min(80vw, 260px) !important;
            }

            .home-cta-panel {
                border-radius: 1rem !important;
                padding: 2rem 1.1rem !important;
                gap: 1rem !important;
            }

            .home-cta-panel h2 {
                max-width: 100% !important;
            }

            .home-cta-panel a {
                width: 100%;
                justify-content: center;
            }

            .home-quick-grid {
                grid-template-columns: 1fr;
            }
        }

        @media (max-width: 560px) {
            .home-hero-tag {
                font-size: 0.58rem !important;
                padding: 0.38rem 0.2rem !important;
            }

            .home-hero-stats {
                gap: 0.36rem !important;
            }

            .home-hero-stat-card {
                padding: 0.5rem !important;
            }

            .home-hero-stat-value {
                font-size: 0.96rem !important;
            }

            .home-hero-stat-label {
                font-size: 0.57rem !important;
            }

            .home-product-grid {
                grid-template-columns: repeat(2, minmax(0, 1fr));
                gap: 0.6rem;
            }

            .home-product-media {
                min-height: 160px;
            }

            .home-service-top {
                align-items: flex-start;
                flex-direction: column;
                gap: 0.55rem;
            }

            .home-service-price {
                white-space: normal;
            }
        }

        @media (prefers-reduced-motion: reduce) {
            .home-biometric-trace {
                animation: none;
            }

            .home-wave-item {
                animation: none;
            }
        }
    </style>

            <section class="hero-section hero-section--home">
        <div class="home-hero-panel" style="max-width: 1200px; margin: 0 auto;">
            <div class="home-hero-panel-glow" aria-hidden="true"></div>

            <div class="home-hero-layout" style="display: grid; grid-template-columns: minmax(0, 1.12fr) minmax(280px, 0.88fr); gap: 1.5rem; align-items: center; position: relative; z-index: 1;">
                <div class="home-hero-copy" style="display: grid; gap: 1.25rem;">
                    <div class="home-hero-kicker" style="display: inline-flex; align-items: center; gap: 0.55rem; width: fit-content; padding: 0.55rem 0.95rem; border-radius: 9999px; background: rgba(255,255,255,0.12); border: 1px solid rgba(255,255,255,0.18); color: white; font-size: 0.76rem; font-weight: 800; letter-spacing: 0.12em; text-transform: uppercase;">
                        <span style="width: 0.45rem; height: 0.45rem; border-radius: 9999px; background: #f4c15a; box-shadow: 0 0 0 4px rgba(244,193,90,0.18);"></span>
                        ISUFST Dingle Campus
                    </div>

                    <div style="display: grid; gap: 0.85rem;">
                        <h1 class="home-hero-title" style="color: white; text-shadow: 0 4px 14px rgba(0, 0, 0, 0.14); font-size: clamp(3rem, 7vw, 6rem); line-height: 0.93; letter-spacing: -0.06em; margin: 0; max-width: 12ch;">
                            ISUFST CICT Store.
                        </h1>
                        <p class="home-hero-subtitle" style="margin: 0; color: rgba(255,255,255,0.95); font-size: clamp(1.1rem, 2.6vw, 1.4rem); line-height: 1.6; max-width: 34rem; font-weight: 500;">
                            Official campus merchandise, services, and student support with a cleaner storefront experience.
                        </p>
                    </div>

                    <div class="home-hero-actions" style="display: flex; flex-wrap: wrap; gap: 0.85rem;">
                        <a href="{{ route('shop.index') }}" class="btn btn-primary" style="gap: 0.55rem;">
                            <span>Shop Collection</span>
                            <svg viewBox="0 0 24 24" aria-hidden="true" style="width: 16px; height: 16px; fill: currentColor;">
                                <path d="M13.172 12 8.222 7.05l1.414-1.414L16 12l-6.364 6.364-1.414-1.414z"/>
                            </svg>
                        </a>
                        <a href="{{ route('services.index') }}" class="btn btn-secondary" style="gap: 0.55rem;">
                            <span>View Services</span>
                            <svg viewBox="0 0 24 24" aria-hidden="true" style="width: 16px; height: 16px; fill: currentColor;">
                                <path d="M13.172 12 8.222 7.05l1.414-1.414L16 12l-6.364 6.364-1.414-1.414z"/>
                            </svg>
                        </a>
                    </div>

                    <div class="home-hero-tags" style="display: flex; flex-wrap: wrap; gap: 0.65rem;">
                        <span class="home-hero-tag" style="padding: 0.55rem 0.8rem; border-radius: 9999px; background: rgba(255,255,255,0.09); border: 1px solid rgba(255,255,255,0.15); color: rgba(255,255,255,0.92); font-size: 0.8rem; font-weight: 700;">Merchandise</span>
                        <span class="home-hero-tag" style="padding: 0.55rem 0.8rem; border-radius: 9999px; background: rgba(255,255,255,0.09); border: 1px solid rgba(255,255,255,0.15); color: rgba(255,255,255,0.92); font-size: 0.8rem; font-weight: 700;">Services</span>
                        <span class="home-hero-tag" style="padding: 0.55rem 0.8rem; border-radius: 9999px; background: rgba(255,255,255,0.09); border: 1px solid rgba(255,255,255,0.15); color: rgba(255,255,255,0.92); font-size: 0.8rem; font-weight: 700;">Student support</span>
                    </div>
                </div>

                <div class="home-hero-visual" style="display: grid; gap: 1.2rem; align-content: start;">
                    <div class="home-hero-feature-card" style="position: relative; overflow: hidden; border-radius: 2rem; padding: 2rem; background: linear-gradient(135deg, rgba(255,255,255,0.12) 0%, rgba(255,255,255,0.06) 100%); border: 1px solid rgba(255,255,255,0.18); backdrop-filter: blur(20px); color: white; box-shadow: 0 24px 48px rgba(0,0,0,0.22), 0 0 1px rgba(255,255,255,0.08) inset;">
                        <div style="display:flex; align-items:flex-start; justify-content:space-between; gap: 1.5rem; margin-bottom: 1.5rem;">
                            <div style="flex:1;">
                                <p style="margin: 0 0 0.5rem 0; font-size: 0.7rem; font-weight: 900; text-transform: uppercase; letter-spacing: 0.16em; color: rgba(244,193,90,0.95);">Official campus store</p>
                                <h2 style="margin: 0; font-size: clamp(1.6rem, 3.5vw, 2.2rem); line-height: 1.1; letter-spacing: -0.03em; color: white; font-weight: 800;">Built for students.</h2>
                            </div>
                            <div style="width: 4.5rem; height: 4.5rem; border-radius: 1.4rem; background: rgba(244,193,90,0.12); border: 1px solid rgba(244,193,90,0.22); display: flex; align-items: center; justify-content: center; overflow: hidden; flex-shrink: 0;">
                                <img src="{{ $faviconUrl }}" alt="CICT favicon" width="56" height="56" style="width: 65%; height: 65%; object-fit: contain; display: block; filter: brightness(1.2) drop-shadow(0 4px 8px rgba(0,0,0,0.2));">
                            </div>
                        </div>
                        <p style="margin: 0 0 1.8rem 0; color: rgba(255,255,255,0.92); line-height: 1.8; font-size: 1.05rem; font-weight: 500;">
                            A cleaner path from browse to checkout—campus merchandise and services organized to feel official, easy, and trustworthy.
                        </p>
                        <div style="display: grid; grid-template-columns: repeat(2, minmax(0, 1fr)); gap: 1rem;">
                            <div style="padding: 1.1rem; border-radius: 1.2rem; background: rgba(255,255,255,0.06); border: 1px solid rgba(255,255,255,0.12); color: white; text-align: center;">
                                <p style="margin: 0; font-size: 1.9rem; font-weight: 900; line-height: 1;">3x</p>
                                <p style="margin: 0.4rem 0 0 0; font-size: 0.72rem; text-transform: uppercase; letter-spacing: 0.1em; color: rgba(255,255,255,0.7); font-weight: 700;">Faster</p>
                            </div>
                            <div style="padding: 1.1rem; border-radius: 1.2rem; background: rgba(255,255,255,0.06); border: 1px solid rgba(255,255,255,0.12); color: white; text-align: center;">
                                <p style="margin: 0; font-size: 1.9rem; font-weight: 900; line-height: 1;">100%</p>
                                <p style="margin: 0.4rem 0 0 0; font-size: 0.72rem; text-transform: uppercase; letter-spacing: 0.1em; color: rgba(255,255,255,0.7); font-weight: 700;">Official</p>
                            </div>
                        </div>
                    </div>

                    <div class="home-hero-trust" style="display:flex; gap:1rem; align-items:center; padding:1.35rem 1.4rem; border-radius:1.4rem; background: rgba(244,193,90,0.08); border:1px solid rgba(244,193,90,0.22); color:white;">
                        <div style="width:3rem; height:3rem; border-radius: 1rem; background: rgba(244,193,90,0.18); display:flex; align-items:center; justify-content:center; color:#f4c15a; font-size: 1.5rem; font-weight:800; flex-shrink:0;">★</div>
                        <div>
                            <p style="margin: 0; font-size: 0.76rem; font-weight: 900; text-transform: uppercase; letter-spacing: 0.12em; color: rgba(244,193,90,0.95);">Trusted by campus</p>
                            <p style="margin: 0.35rem 0 0 0; font-size: 0.98rem; line-height: 1.65; color: rgba(255,255,255,0.95);">Student council–backed store with modern, easy-to-use design.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="home-section" style="background: var(--color-gray-50);">
        <div style="max-width: 1200px; margin: 0 auto;">
            <div style="display: flex; align-items: end; justify-content: space-between; gap: 1rem; flex-wrap: wrap; margin-bottom: 2rem;">
                <div>
                    <p style="margin: 0 0 0.35rem 0; font-size: 0.75rem; font-weight: 800; text-transform: uppercase; letter-spacing: 0.12em; color: var(--color-maroon);">Selected goods</p>
                    <h2 class="h2" style="margin: 0;">Featured Products</h2>
                </div>
                <p style="margin: 0; max-width: 34rem; color: var(--color-gray-600); line-height: 1.7;">Clean product cards with clear image hierarchy and straightforward pricing.</p>
            </div>

            <div class="home-product-grid">
                @forelse($featuredProducts as $product)
                    @php
                        $displayPrice = $featuredProductDisplayPrices[$product->id] ?? $product->base_price;
                    @endphp
                    <a href="{{ route('shop.show', $product->slug) }}" class="home-product-card">
                        <div class="home-product-media">
                            @if(!empty($product->image_url))
                                <div class="loading-skeleton-wrap" style="position: absolute; inset: 0; border-radius: 0.55rem; overflow: hidden;">
                                    <div class="loading-skeleton loading-skeleton--image" style="position:absolute; inset: 0;"></div>
                                    <img src="{{ $product->image_url }}" alt="{{ $product->name }}" loading="lazy" decoding="async" width="320" height="420">
                                </div>
                            @else
                                <div style="color: #9ca3af; font-size: 0.85rem;">No image</div>
                            @endif
                        </div>
                        <span class="home-product-tag">%</span>
                        <span class="home-product-badge">New</span>
                        <h3 class="home-product-name">{{ $product->name }}</h3>
                        <p class="home-product-price">P{{ number_format($displayPrice, 0) }}</p>
                        <div class="home-product-footer">
                            <div style="display: flex; align-items: center; gap: 0.4rem;">
                                <svg viewBox="0 0 20 20" fill="currentColor" style="width: 0.95rem; height: 0.95rem; color: #2d3748;">
                                    <path d="M3 1a1 1 0 000 2h1.22l.305 1.222a.997.997 0 00.01.042l1.358 5.43-.893.892C3.74 11.846 4.632 14 6.414 14H15a1 1 0 000-2H6.414l1-1h7.586a1 1 0 00.894-.553l3-6A1 1 0 0017 3H6.28l-.31-1.243A1 1 0 005 1H3zM5 16a2 2 0 11-4 0 2 2 0 014 0zm7 0a2 2 0 11-4 0 2 2 0 014 0z"></path>
                                </svg>
                                <span style="font-size: 0.85rem; font-weight: 600; color: #2d3748;">Add to Cart</span>
                            </div>
                            <svg viewBox="0 0 20 20" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" style="width: 1rem; height: 1rem; color: #2d3748;">
                                <path d="M7 10l5-5 5 5M7 15l5-5 5 5"></path>
                            </svg>
                        </div>
                    </a>
                @empty
                    <div style="grid-column: 1 / -1; text-align: center; padding: 2.5rem 1.25rem; border: 1px solid var(--color-gray-200); border-radius: 1.1rem; background: linear-gradient(180deg, #ffffff 0%, #f8fafc 100%); box-shadow: var(--shadow-sm);">
                        <p style="margin: 0 0 0.4rem 0; font-weight: 800; color: #111827;">No products available yet.</p>
                        <p style="margin: 0; color: var(--color-gray-500);">Check back soon for new arrivals.</p>
                    </div>
                @endforelse
            </div>

            @if($featuredProducts->count() > 0)
                <div style="text-align: center;">
                    <a href="{{ route('shop.index') }}" class="btn btn-secondary home-products-viewall" style="gap: 0.55rem;">
                        <span>View all products</span>
                        <svg viewBox="0 0 24 24" aria-hidden="true" style="width: 16px; height: 16px; fill: currentColor;">
                            <path d="M13.172 12 8.222 7.05l1.414-1.414L16 12l-6.364 6.364-1.414-1.414z"/>
                        </svg>
                    </a>
                </div>
            @endif
        </div>
    </section>

    <section class="home-sale-ticker" aria-label="Sale announcements">
        <div class="home-sale-ticker-track">
            <div class="home-sale-ticker-group">
                <span class="home-sale-ticker-text">SUMMER SALE <span class="accent">%</span> UP TO 70% OFF <span class="accent">%</span></span>
                <span class="home-sale-ticker-text">SUMMER SALE <span class="accent">%</span> UP TO 70% OFF <span class="accent">%</span></span>
                <span class="home-sale-ticker-text">SUMMER SALE <span class="accent">%</span> UP TO 70% OFF <span class="accent">%</span></span>
                <span class="home-sale-ticker-text">SUMMER SALE <span class="accent">%</span> UP TO 70% OFF <span class="accent">%</span></span>
            </div>
            <div class="home-sale-ticker-group" aria-hidden="true">
                <span class="home-sale-ticker-text">SUMMER SALE <span class="accent">%</span> UP TO 70% OFF <span class="accent">%</span></span>
                <span class="home-sale-ticker-text">SUMMER SALE <span class="accent">%</span> UP TO 70% OFF <span class="accent">%</span></span>
                <span class="home-sale-ticker-text">SUMMER SALE <span class="accent">%</span> UP TO 70% OFF <span class="accent">%</span></span>
                <span class="home-sale-ticker-text">SUMMER SALE <span class="accent">%</span> UP TO 70% OFF <span class="accent">%</span></span>
            </div>
        </div>
    </section>

    <section class="home-section" style="background: var(--color-white);">
        <div class="home-services-grid" style="max-width: 1200px; margin: 0 auto;">
            <div style="display: grid; gap: 1rem;">
                <p style="margin: 0; font-size: 0.75rem; font-weight: 800; text-transform: uppercase; letter-spacing: 0.12em; color: var(--color-maroon);">Services</p>
                <h2 class="h2" style="margin: 0; max-width: 13ch;"><span class="home-services-title-keep">Campus services and</span> digital support.</h2>
                <p style="margin: 0; color: var(--color-gray-600); line-height: 1.8;">A service section designed like a curated index: concise, direct, and easier to scan than a standard card wall.</p>
                <div class="home-services-cta-wrap">
                    <a href="{{ route('services.index') }}" class="btn btn-primary home-services-cta" style="width: fit-content; gap: 0.55rem;">
                        <span>Browse services</span>
                        <svg viewBox="0 0 24 24" aria-hidden="true" style="width: 16px; height: 16px; fill: currentColor;">
                            <path d="M13.172 12 8.222 7.05l1.414-1.414L16 12l-6.364 6.364-1.414-1.414z"/>
                        </svg>
                    </a>
                </div>
            </div>

            <div class="home-services-cards">
                @forelse($featuredServices as $service)
                    @php
                        $servicePrice = $service->price_primary ?? $service->price_bw ?? $service->price_color ?? null;
                    @endphp
                    <a href="{{ route('services.show', $service->slug) }}" class="home-service-card home-service-motion-card">
                        <div class="home-service-top">
                            @if(!is_null($servicePrice))
                                <span class="home-service-price">From P{{ number_format($servicePrice, 2) }}</span>
                            @else
                                <span class="home-service-price">Custom quote</span>
                            @endif
                        </div>

                        <h3 class="home-service-title">{{ $service->title }}</h3>
                        <p class="home-service-desc">{{ Str::limit($service->description, 130) }}</p>

                        <div class="home-service-footer">
                            <span class="home-service-link-label">View service</span>
                            <span class="home-service-arrow" aria-hidden="true">&gt;</span>
                        </div>
                    </a>
                @empty
                    <p style="grid-column: 1 / -1; text-align: center; color: var(--color-gray-500); padding: 2rem;">No services available yet.</p>
                @endforelse
            </div>
        </div>
    </section>

    <section class="home-wave-section" aria-label="Campus service motion icons">
        <div class="home-wave-shell">
            <div class="home-wave-track" aria-hidden="true">
                <span class="home-wave-item" style="--wave-delay: 0;">
                    <svg viewBox="0 0 24 24"><path d="M3.5 6.5h17l-1.8 8.5H7.2L5.8 3.8H3"></path><circle cx="9" cy="19" r="1.5"></circle><circle cx="17" cy="19" r="1.5"></circle></svg>
                </span>
                <span class="home-wave-item" style="--wave-delay: 1;">
                    <svg viewBox="0 0 24 24"><path d="M7 8h10v8H7z"></path><path d="M7 12H5v4h2"></path><path d="M17 12h2v4h-2"></path><path d="M9 16h6"></path></svg>
                </span>
                <span class="home-wave-item" style="--wave-delay: 2;">
                    <svg viewBox="0 0 24 24"><path d="M12 3v8"></path><path d="M9 8l3 3 3-3"></path><path d="M4.5 12.5a7.5 7.5 0 1 0 15 0"></path></svg>
                </span>
                <span class="home-wave-item" style="--wave-delay: 3;">
                    <svg viewBox="0 0 24 24"><path d="M4 9.5 12 4l8 5.5V19a1 1 0 0 1-1 1H5a1 1 0 0 1-1-1z"></path><path d="M9 20v-6h6v6"></path></svg>
                </span>
                <span class="home-wave-item" style="--wave-delay: 4;">
                    <svg viewBox="0 0 24 24"><path d="M8.5 10.5h7"></path><path d="M8.5 14h7"></path><rect x="5" y="4" width="14" height="16" rx="2"></rect></svg>
                </span>
                <span class="home-wave-item" style="--wave-delay: 5;">
                    <svg viewBox="0 0 24 24"><path d="M4 10.5h16"></path><path d="M7 7h10"></path><path d="M9 14h6"></path><path d="M10 17h4"></path><rect x="4" y="4" width="16" height="16" rx="2"></rect></svg>
                </span>
                <span class="home-wave-item" style="--wave-delay: 6;">
                    <svg viewBox="0 0 24 24"><path d="M4.5 12 12 5l7.5 7"></path><path d="M7 10.5V19h10v-8.5"></path></svg>
                </span>
                <span class="home-wave-item" style="--wave-delay: 7;">
                    <svg viewBox="0 0 24 24"><path d="M6 6h12v12H6z"></path><path d="M6 10h12"></path><path d="M10 6v12"></path></svg>
                </span>
                <span class="home-wave-item" style="--wave-delay: 8;">
                    <svg viewBox="0 0 24 24"><path d="M6 8h12"></path><path d="M6 12h12"></path><path d="M6 16h8"></path><rect x="4" y="4" width="16" height="16" rx="2"></rect></svg>
                </span>
                <span class="home-wave-item" style="--wave-delay: 9;">
                    <svg viewBox="0 0 24 24"><circle cx="12" cy="12" r="8"></circle><path d="M8 12h8"></path><path d="M12 8v8"></path></svg>
                </span>
                <span class="home-wave-item" style="--wave-delay: 10;">
                    <svg viewBox="0 0 24 24"><path d="M4 7h16"></path><path d="M4 12h10"></path><path d="M4 17h7"></path><circle cx="17" cy="12" r="3"></circle></svg>
                </span>
                <span class="home-wave-item" style="--wave-delay: 11;">
                    <svg viewBox="0 0 24 24"><path d="M6 5h12"></path><path d="M6 10h12"></path><path d="M6 15h8"></path><path d="M16.5 15.5 20 19"></path><circle cx="15" cy="15" r="3"></circle></svg>
                </span>
                <span class="home-wave-item" style="--wave-delay: 12;">
                    <svg viewBox="0 0 24 24"><path d="M5 8h14l-1.2 9H6.2L5 8Z"></path><path d="M9 8V6.8a3 3 0 0 1 6 0V8"></path></svg>
                </span>
                <span class="home-wave-item" style="--wave-delay: 13;">
                    <svg viewBox="0 0 24 24"><path d="M4.5 7.5h8l7 7-8 5.5-7-7Z"></path><circle cx="9" cy="10" r="1"></circle></svg>
                </span>
                <span class="home-wave-item" style="--wave-delay: 14;">
                    <svg viewBox="0 0 24 24"><rect x="4" y="5" width="16" height="14" rx="2"></rect><path d="M8 9h8"></path><path d="M8 13h8"></path><path d="M8 17h5"></path></svg>
                </span>
                <span class="home-wave-item" style="--wave-delay: 15;">
                    <svg viewBox="0 0 24 24"><path d="M4 14h11"></path><path d="M15 14h3l2-3h-5"></path><circle cx="8" cy="18" r="1.6"></circle><circle cx="17" cy="18" r="1.6"></circle><path d="M4 8h9"></path></svg>
                </span>
                <span class="home-wave-item" style="--wave-delay: 16;">
                    <svg viewBox="0 0 24 24"><path d="M6 6h12v12H6z"></path><path d="M9 10h6"></path><path d="M9 13h4"></path><path d="M12 6v12"></path></svg>
                </span>
                <span class="home-wave-item" style="--wave-delay: 17;">
                    <svg viewBox="0 0 24 24"><path d="M5 11h14"></path><path d="M8 7h8"></path><path d="M10 15h4"></path><circle cx="12" cy="18" r="2"></circle></svg>
                </span>
            </div>
        </div>
    </section>

    <section class="home-section" style="background: var(--color-gray-50);">
        <div class="home-about-grid" style="max-width: 1200px; margin: 0 auto;">
            <div style="display: flex; align-items: center; justify-content: center;">
                <div style="width: min(100%, 360px); aspect-ratio: 1; border-radius: 9999px; overflow: hidden; background: var(--color-white); box-shadow: var(--shadow-lg); border: 1px solid var(--color-gray-200);">
                    <img src="{{ asset('images/cict-logo.webp') }}" alt="{{ config('app.name', 'CICT Dingle') }} Logo" loading="lazy" decoding="async" style="width: 100%; height: 100%; object-fit: cover; object-position: center; display: block;">
                </div>
            </div>

            <div style="display: grid; gap: 1rem;">
                <p class="home-about-kicker" style="margin: 0; font-size: 0.75rem; font-weight: 800; text-transform: uppercase; letter-spacing: 0.12em; color: var(--color-maroon);">About</p>
                <h2 class="h2 home-about-title" style="margin: 0;">{{ config('app.name', 'CICT Dingle') }}</h2>
                <p style="font-size: 1rem; color: var(--color-gray-700); line-height: 1.8; margin: 0;">
                    Welcome to your one-stop campus hub at ISUFST Dingle Campus. We are the official merchandise and services store operated by the CICT Student Council, dedicated to providing quality campus gear, service requests, and digital solutions that make student life easier.
                </p>
                <p style="font-size: 1rem; color: var(--color-gray-700); line-height: 1.8; margin: 0;">
                    Every purchase you make directly supports student programs and campus initiatives. From custom apparel to essential document services, we deliver excellence for the entire ISUFST academic community.
                </p>
                <div class="home-about-actions" style="display: flex; gap: 0.85rem; flex-wrap: wrap; margin-top: 0.5rem;">
                    <a href="{{ route('contact.index') }}" class="btn btn-secondary" style="gap: 0.55rem;">
                        <span>Get in touch</span>
                        <svg viewBox="0 0 24 24" aria-hidden="true" style="width: 16px; height: 16px; fill: currentColor;">
                            <path d="M13.172 12 8.222 7.05l1.414-1.414L16 12l-6.364 6.364-1.414-1.414z"/>
                        </svg>
                    </a>
                </div>
            </div>
        </div>
    </section>

    <section class="home-section--cta" style="background: var(--color-white);">
        <div class="home-cta-panel" style="width: 100%; margin: 0 auto; background: linear-gradient(135deg, var(--color-maroon) 0%, var(--color-maroon-dark) 100%); color: white; border-radius: 1.5rem; padding: 4rem 3rem; display: flex; flex-direction: column; align-items: center; text-align: center; gap: 1.8rem; box-shadow: 0 16px 34px rgba(91, 0, 0, 0.22);">
            <div>
                <p style="margin: 0 0 0.5rem 0; font-size: 0.75rem; font-weight: 800; text-transform: uppercase; letter-spacing: 0.12em; color: rgba(255,255,255,0.72);">Ready to order</p>
                <h2 class="h2" style="color: white; margin: 0; max-width: 22ch;">Browse the collection or request a service.</h2>
            </div>
            <a href="{{ route('shop.index') }}" class="btn btn-primary" style="gap: 0.55rem; padding: 0.9rem 2rem; font-size: 1rem;">
                <span>Start shopping</span>
                <svg viewBox="0 0 24 24" aria-hidden="true" style="width: 18px; height: 18px; fill: currentColor;">
                    <path d="M13.172 12 8.222 7.05l1.414-1.414L16 12l-6.364 6.364-1.414-1.414z"/>
                </svg>
            </a>
        </div>
    </section>

    <section class="home-section--quick" style="background: var(--color-white);">
        <div style="max-width: 1200px; margin: -1.25rem auto 0; padding: 0;">
            <div class="home-quick-grid">
                <div class="home-quick-card" style="padding: 1.15rem 1.2rem; border-radius: 1.15rem; background: var(--color-white); border: 1px solid var(--color-gray-200); box-shadow: 0 10px 24px rgba(15, 23, 42, 0.06); display: flex; gap: 0.9rem; align-items: flex-start;">
                    <div style="width: 2.5rem; height: 2.5rem; border-radius: 9999px; background: rgba(139, 0, 0, 0.08); color: var(--color-maroon); display:flex; align-items:center; justify-content:center; font-weight: 800; flex-shrink: 0;">01</div>
                    <div>
                        <p style="margin: 0 0 0.3rem 0; font-size: 0.92rem; font-weight: 700; color: #111827;">Student-led support</p>
                        <p style="margin: 0; font-size: 0.88rem; color: var(--color-gray-600); line-height: 1.6;">Built for campus needs with quick support and clear ordering.</p>
                    </div>
                </div>
                <div class="home-quick-card" style="padding: 1.15rem 1.2rem; border-radius: 1.15rem; background: var(--color-white); border: 1px solid var(--color-gray-200); box-shadow: 0 10px 24px rgba(15, 23, 42, 0.06); display: flex; gap: 0.9rem; align-items: flex-start;">
                    <div style="width: 2.5rem; height: 2.5rem; border-radius: 9999px; background: rgba(91, 156, 246, 0.12); color: #215bbf; display:flex; align-items:center; justify-content:center; font-weight: 800; flex-shrink: 0;">02</div>
                    <div>
                        <p style="margin: 0 0 0.3rem 0; font-size: 0.92rem; font-weight: 700; color: #111827;">Reliable turnaround</p>
                                <p style="margin: 0; font-size: 0.88rem; color: var(--color-gray-600); line-height: 1.6;">Designed to make requests and pickup feel fast, simple, and dependable.</p>
                    </div>
                </div>
                <div class="home-quick-card" style="padding: 1.15rem 1.2rem; border-radius: 1.15rem; background: var(--color-white); border: 1px solid var(--color-gray-200); box-shadow: 0 10px 24px rgba(15, 23, 42, 0.06); display: flex; gap: 0.9rem; align-items: flex-start;">
                    <div style="width: 2.5rem; height: 2.5rem; border-radius: 9999px; background: rgba(244, 193, 90, 0.16); color: #8b5a00; display:flex; align-items:center; justify-content:center; font-weight: 800; flex-shrink: 0;">03</div>
                    <div>
                        <p style="margin: 0 0 0.3rem 0; font-size: 0.92rem; font-weight: 700; color: #111827;">Official campus store</p>
                        <p style="margin: 0; font-size: 0.88rem; color: var(--color-gray-600); line-height: 1.6;">A more credible storefront feel with clear hierarchy and brand trust.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <script>
        (function () {
            const reduceMotion = window.matchMedia && window.matchMedia('(prefers-reduced-motion: reduce)').matches;
            const isDesktop = window.matchMedia && window.matchMedia('(min-width: 768px)').matches;

            function run() {
                if (reduceMotion || !isDesktop || !window.gsap) {
                    return;
                }

                const gsap = window.gsap;
                const ScrollTrigger = window.ScrollTrigger;

                if (ScrollTrigger) {
                    gsap.registerPlugin(ScrollTrigger);
                }

                const hero = document.querySelector('.home-hero-panel');
                if (hero) {
                    const heroKicker = hero.querySelector('.home-hero-kicker');
                    const heroTitle = hero.querySelector('.home-hero-title');
                    const heroSubtitle = hero.querySelector('.home-hero-subtitle');
                    const heroActions = hero.querySelector('.home-hero-actions');
                    const heroTags = hero.querySelector('.home-hero-tags');
                    const heroVisual = hero.querySelector('.home-hero-visual');
                    const heroFeatureCard = hero.querySelector('.home-hero-feature-card');
                    const heroStats = hero.querySelector('.home-hero-stats');
                    const heroTrust = hero.querySelector('.home-hero-trust');

                    const heroParts = [heroKicker, heroTitle, heroSubtitle, heroActions, heroTags].filter(Boolean);
                    const visualParts = [heroFeatureCard, heroStats, heroTrust].filter(Boolean);

                    if (heroParts.length) {
                        gsap.from(heroParts, {
                            autoAlpha: 0,
                            y: 24,
                            duration: 0.8,
                            ease: 'power3.out',
                            stagger: 0.08
                        });
                    }

                    if (heroVisual) {
                        gsap.from(heroVisual, {
                            autoAlpha: 0,
                            x: 28,
                            duration: 0.9,
                            ease: 'power3.out',
                            delay: 0.15
                        });
                    }

                    if (visualParts.length) {
                        gsap.from(visualParts, {
                            autoAlpha: 0,
                            y: 28,
                            duration: 0.8,
                            ease: 'power3.out',
                            stagger: 0.12,
                            delay: 0.2
                        });
                    }
                }



                const serviceCards = gsap.utils.toArray('.home-service-motion-card');
                if (serviceCards.length) {
                    gsap.from(serviceCards, {
                        scrollTrigger: {
                            trigger: '.home-services-cards',
                            start: 'top 82%',
                            once: true
                        },
                        autoAlpha: 0,
                        y: 26,
                        duration: 0.75,
                        ease: 'power3.out',
                        stagger: 0.09,
                        clearProps: 'opacity,transform'
                    });
                }

                const waveSection = document.querySelector('.home-wave-section');
                const waveItems = gsap.utils.toArray('.home-wave-item');

                if (waveItems.length) {
                    gsap.from(waveItems, {
                        scrollTrigger: {
                            trigger: waveSection || waveItems[0],
                            start: 'top 86%',
                            once: true
                        },
                        autoAlpha: 0,
                        y: 18,
                        duration: 0.62,
                        ease: 'power3.out',
                        stagger: 0.04,
                        clearProps: 'opacity'
                    });
                }

                if (waveItems.length && waveSection && ScrollTrigger) {
                    gsap.to(waveItems, {
                        yPercent: function (index) {
                            return index % 2 === 0 ? -8 : 8;
                        },
                        ease: 'none',
                        stagger: {
                            each: 0.018,
                            from: 'start'
                        },
                        scrollTrigger: {
                            trigger: waveSection,
                            start: 'top bottom',
                            end: 'bottom top',
                            scrub: 0.85
                        }
                    });
                }

                const aboutBlock = document.querySelector('.home-about-grid');
                if (aboutBlock) {
                    gsap.from(aboutBlock, {
                        scrollTrigger: {
                            trigger: aboutBlock,
                            start: 'top 82%',
                            once: true
                        },
                        autoAlpha: 0,
                        y: 28,
                        duration: 0.8,
                        ease: 'power3.out',
                        clearProps: 'opacity,transform'
                    });
                }

                const ctaPanel = document.querySelector('.home-cta-panel');
                if (ctaPanel) {
                    gsap.from(ctaPanel, {
                        scrollTrigger: {
                            trigger: ctaPanel,
                            start: 'top 84%',
                            once: true
                        },
                        autoAlpha: 0,
                        y: 26,
                        duration: 0.8,
                        ease: 'power3.out',
                        clearProps: 'opacity,transform'
                    });
                }

                const quickCards = gsap.utils.toArray('.home-quick-card');
                if (quickCards.length) {
                    gsap.from(quickCards, {
                        scrollTrigger: {
                            trigger: quickCards[0].parentElement,
                            start: 'top 86%',
                            once: true
                        },
                        autoAlpha: 0,
                        y: 22,
                        duration: 0.65,
                        ease: 'power3.out',
                        stagger: 0.08,
                        clearProps: 'opacity,transform'
                    });
                }
            }

            function boot() {
                if (window.gsap) {
                    run();
                    return;
                }

                let attempts = 0;
                const waitForGsap = function () {
                    if (window.gsap) {
                        run();
                        return;
                    }

                    attempts += 1;
                    if (attempts < 120) {
                        window.requestAnimationFrame(waitForGsap);
                    }
                };

                waitForGsap();
            }

            if (document.readyState === 'loading') {
                document.addEventListener('DOMContentLoaded', boot, { once: true });
            } else {
                boot();
            }
        })();
    </script>
</x-app-layout>



