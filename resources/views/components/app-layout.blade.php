@props([
    'title' => 'ISUFST CICT | Dingle Campus',
    'meta_description' => 'Official ISUFST CICT Student Council Store at Dingle Campus. Shop merchandise, services, and student support at cictstore.me.',
])

<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, viewport-fit=cover, maximum-scale=5">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="theme-color" content="#8B0000">
    <meta name="mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="black-translucent">

    <title>{{ $title }}</title>

    <!-- SEO Meta Tags -->
    <meta name="description" content="{{ $meta_description }}">
    <meta name="keywords" content="ISUFST CICT, ISUFST Dingle Campus, cictstore.me, ISUFST student council store, ISUFST merchandise, CICT merch, campus services Iloilo, Dingle campus shop, student services Iloilo, ISUFST uniform">
    <meta name="author" content="CICT Student Council">
    <meta name="application-name" content="ISUFST CICT Store">
    <meta name="apple-mobile-web-app-title" content="ISUFST CICT">
    <meta name="robots" content="index, follow">
    <meta name="geo.region" content="PH-ILI">
    <meta name="geo.placename" content="Dingle, Iloilo">
    <link rel="canonical" href="{{ url()->current() }}">
    <link rel="alternate" hreflang="en-PH" href="{{ url()->current() }}">
    <link rel="alternate" hreflang="x-default" href="{{ url()->current() }}">

    <!-- Favicon (cached query) -->
    @php
        $faviconUrl = Cache::remember('site.favicon_url', 3600, function () {
            $faviconSetting = \App\Models\Setting::where('key', 'site_favicon')->first();
            /** @var \Illuminate\Filesystem\FilesystemAdapter $faviconDisk */
            $faviconDisk = \Storage::disk('supabase');
            return ($faviconSetting && $faviconSetting->value) 
                ? $faviconDisk->url($faviconSetting->value) 
                : null;
        });
        $ogImageValue = \App\Models\Setting::get('site_logo');
        /** @var \Illuminate\Filesystem\FilesystemAdapter $ogImageDisk */
        $ogImageDisk = \Storage::disk('supabase');
        $ogImageUrl = $ogImageValue ? $ogImageDisk->url($ogImageValue) : null;

        $isHomePage = request()->routeIs('home');
        $isShopPage = request()->routeIs('shop.index');
        $isServicesPage = request()->routeIs('services.index');
        $isContactPage = request()->routeIs('contact.index');
        $isHeroRoute = $isHomePage || $isShopPage || $isServicesPage || $isContactPage;
        $enableBlurLoading = $isHeroRoute;

        $siteUrl = rtrim(url('/'), '/');
        $currentUrl = url()->current();

        $organizationSchema = [
            '@context' => 'https://schema.org',
            '@type' => 'Organization',
            'name' => 'ISUFST CICT Student Council Store',
            'url' => $siteUrl,
            'logo' => $ogImageUrl,
            'description' => 'Official campus merchandise and services store of the CICT Student Council at ISUFST Dingle Campus.',
            'address' => [
                '@type' => 'PostalAddress',
                'addressLocality' => 'Dingle',
                'addressRegion' => 'Iloilo',
                'addressCountry' => 'PH',
            ],
        ];

        $websiteSchema = [
            '@context' => 'https://schema.org',
            '@type' => 'WebSite',
            'name' => 'ISUFST CICT',
            'url' => $siteUrl,
            'inLanguage' => 'en-PH',
            'potentialAction' => [
                '@type' => 'SearchAction',
                'target' => $siteUrl . '/shop?search={search_term_string}',
                'query-input' => 'required name=search_term_string',
            ],
        ];

        $pageSchema = [
            '@context' => 'https://schema.org',
            '@type' => 'WebPage',
            'name' => $title,
            'url' => $currentUrl,
            'description' => $meta_description,
            'isPartOf' => [
                '@type' => 'WebSite',
                'name' => 'ISUFST CICT',
                'url' => $siteUrl,
            ],
        ];

        if ($isHomePage) {
            $pageSchema['@type'] = 'WebPage';
            $pageSchema['name'] = 'ISUFST CICT | Dingle Campus';
        } elseif ($isShopPage) {
            $pageSchema['@type'] = 'CollectionPage';
            $pageSchema['name'] = 'Shop | ISUFST CICT';
        } elseif ($isServicesPage) {
            $pageSchema['@type'] = 'CollectionPage';
            $pageSchema['name'] = 'Services | ISUFST CICT';
        } elseif ($isContactPage) {
            $pageSchema['@type'] = 'ContactPage';
            $pageSchema['name'] = 'Contact | ISUFST CICT';
        }

        $breadcrumbItems = [
            [
                '@type' => 'ListItem',
                'position' => 1,
                'name' => 'Home',
                'item' => $siteUrl . '/',
            ],
        ];

        if (request()->routeIs('shop.index')) {
            $breadcrumbItems[] = [
                '@type' => 'ListItem',
                'position' => 2,
                'name' => 'Shop',
                'item' => $siteUrl . '/shop',
            ];
        } elseif (request()->routeIs('shop.show')) {
            $breadcrumbItems[] = [
                '@type' => 'ListItem',
                'position' => 2,
                'name' => 'Shop',
                'item' => $siteUrl . '/shop',
            ];
            $breadcrumbItems[] = [
                '@type' => 'ListItem',
                'position' => 3,
                'name' => trim((string) preg_replace('/\s*\|\s*ISUFST CICT Dingle Campus$/', '', (string) $title)),
                'item' => $currentUrl,
            ];
        } elseif (request()->routeIs('services.index')) {
            $breadcrumbItems[] = [
                '@type' => 'ListItem',
                'position' => 2,
                'name' => 'Services',
                'item' => $siteUrl . '/services',
            ];
        } elseif (request()->routeIs('services.show')) {
            $breadcrumbItems[] = [
                '@type' => 'ListItem',
                'position' => 2,
                'name' => 'Services',
                'item' => $siteUrl . '/services',
            ];
            $breadcrumbItems[] = [
                '@type' => 'ListItem',
                'position' => 3,
                'name' => trim((string) preg_replace('/\s*\|\s*ISUFST CICT Dingle Campus$/', '', (string) $title)),
                'item' => $currentUrl,
            ];
        } elseif (request()->routeIs('contact.index')) {
            $breadcrumbItems[] = [
                '@type' => 'ListItem',
                'position' => 2,
                'name' => 'Contact',
                'item' => $siteUrl . '/contact',
            ];
        }

        $breadcrumbSchema = count($breadcrumbItems) > 1
            ? [
                '@context' => 'https://schema.org',
                '@type' => 'BreadcrumbList',
                'itemListElement' => $breadcrumbItems,
            ]
            : null;
    @endphp
    @if($faviconUrl)
        <link rel="icon" href="{{ $faviconUrl }}" type="image/x-icon">
        <link rel="apple-touch-icon" sizes="180x180" href="{{ $faviconUrl }}">
    @endif

    @if($isHeroRoute)
        <link rel="preload" as="image" href="{{ asset('images/cict_hero_bg.webp') }}" fetchpriority="high">
    @endif

    <!-- Open Graph / Facebook -->
    <meta property="og:type" content="website">
    <meta property="og:url" content="{{ url()->current() }}">
    <meta property="og:title" content="{{ $title }}">
    <meta property="og:description" content="{{ $meta_description }}">
    @if($ogImageUrl)<meta property="og:image" content="{{ $ogImageUrl }}">@endif
    <meta property="og:site_name" content="ISUFST CICT">
    <meta property="og:locale" content="en_PH">

    <!-- Twitter -->
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="{{ $title }}">
    <meta name="twitter:description" content="{{ $meta_description }}">
    @if($ogImageUrl)<meta name="twitter:image" content="{{ $ogImageUrl }}">@endif

    <!-- Structured Data (JSON-LD) -->
    <script type="application/ld+json">@json($organizationSchema, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES)</script>
    <script type="application/ld+json">@json($websiteSchema, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES)</script>
    <script type="application/ld+json">@json($pageSchema, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES)</script>
    @if($breadcrumbSchema)
        <script type="application/ld+json">@json($breadcrumbSchema, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES)</script>
    @endif

    <!-- DNS Preconnect for faster external resource loading -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link rel="dns-prefetch" href="//cdnjs.cloudflare.com">

    <!-- Fonts (display=swap for faster text rendering) -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet" media="print" onload="this.media='all'">
    <noscript><link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet"></noscript>

    <!-- Global debug flag and console silencer for production -->
    <script>
        window.APP_DEBUG = @json(config('app.debug'));
        if (!window.APP_DEBUG) {
            console.log = console.debug = console.info = console.warn = function () { };
        }
    </script>

    <!-- Critical CSS inline for faster first paint -->
    <style>
        /* Critical above-the-fold styles */
        *,*::before,*::after{box-sizing:border-box}
        html,body{margin:0;padding:0;overflow-x:hidden;font-family:'Inter',system-ui,-apple-system,sans-serif}
        .hero,.shop-hero,.services-hero,.contact-hero{min-height:50vh;background:linear-gradient(135deg,#8B0000 0%,#5C0000 100%)}
    </style>

    @include('components.vite-assets')

    <!-- Only load essential animation CSS (combined) -->
    <link rel="stylesheet" href="{{ asset('css/button-interactions.css') }}" media="print" onload="this.media='all'">
    <noscript>
        <link rel="stylesheet" href="{{ asset('css/button-interactions.css') }}">
    </noscript>

    @if($isHomePage)
        <!-- GSAP Animation Library: loaded only where currently used (homepage desktop) -->
        <script>
            if (window.innerWidth >= 768) {
                ['gsap.min.js', 'ScrollTrigger.min.js'].forEach(function(f) {
                    var s = document.createElement('script');
                    s.src = 'https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.5/' + f;
                    s.defer = true;
                    document.head.appendChild(s);
                });
            }
        </script>
    @endif

    <style>
        /* Global mobile fixes */
        html, body { overflow-x: hidden; }

        /* Prevent underline on buttons and cards */
        .product-card,
        .service-card,
        .bento-card,
        .contact-block,
        .social-card,
        .contact-card,
        .officer-card,
        .related-card,
        .social-link,
        .btn,
        .btn-primary,
        .btn-secondary,
        .btn-outline,
        .auth-button,
        .checkout-btn,
        .view-all-btn,
        .hero-button,
        button:not(.no-animate),
        a.product-card,
        a.service-card,
        a.btn-primary,
        a.btn-secondary,
        a.btn-outline {
            text-decoration: none !important;
        }

        .product-card:hover,
        .service-card:hover,
        .bento-card:hover,
        .contact-block:hover,
        .social-card:hover,
        .contact-card:hover,
        .officer-card:hover,
        .related-card:hover,
        .social-link:hover,
        .btn:hover,
        .btn-primary:hover,
        .btn-secondary:hover,
        .btn-outline:hover,
        .auth-button:hover,
        .checkout-btn:hover,
        .view-all-btn:hover,
        .hero-button:hover,
        button:not(.no-animate):hover,
        a.product-card:hover,
        a.service-card:hover,
        a.btn-primary:hover,
        a.btn-secondary:hover,
        a.btn-outline:hover {
            text-decoration: none !important;
        }

        @keyframes bounce-slow {

            0%,
            100% {
                transform: translateY(0);
            }

            50% {
                transform: translateY(-8px);
            }
        }

        @keyframes slideInUp {
            from {
                opacity: 0;
                transform: translateY(20px) scale(0.95);
            }

            to {
                opacity: 1;
                transform: translateY(0) scale(1);
            }
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
            }

            to {
                opacity: 1;
            }
        }

        .chat-window-enter {
            animation: slideInUp 0.3s cubic-bezier(0.34, 1.56, 0.64, 1);
        }

        .message-enter {
            animation: fadeIn 0.2s ease-out;
        }

        /* Custom scrollbar for chat */
        #cict-chat-messages::-webkit-scrollbar {
            width: 6px;
        }

        #cict-chat-messages::-webkit-scrollbar-track {
            background: transparent;
        }

        #cict-chat-messages::-webkit-scrollbar-thumb {
            background: rgba(139, 0, 0, 0.2);
            border-radius: 3px;
        }

        #cict-chat-messages::-webkit-scrollbar-thumb:hover {
            background: rgba(139, 0, 0, 0.3);
        }

        .footer-nav-link {
            color: rgba(255, 255, 255, 0.82);
            text-decoration: none;
            font-size: 0.96rem;
            transition: color 0.2s ease, transform 0.2s ease;
            transform: translateX(0);
        }

        .footer-nav-link:hover {
            color: #ffffff;
            transform: translateX(3px);
        }

        .footer-nav-link:focus-visible {
            color: #ffffff;
            outline: 2px solid rgba(255, 255, 255, 0.55);
            outline-offset: 3px;
            border-radius: 0.3rem;
        }

        /* On mobile reduce area and avoid overlapping notification dropdown */
        @media (max-width: 768px) {
            #cict-chatbot {
                right: 8px !important;
                bottom: 8px !important;
            }

            #cict-chatbot-window {
                right: 8px !important;
                left: 8px !important;
                width: calc(100% - 16px) !important;
                bottom: 8px !important;
                border-radius: 12px !important;
                height: calc(100vh - 120px) !important;
            }

            /* Footer mobile adjustments */
            .footer {
                border-top-left-radius: 1.2rem !important;
                border-top-right-radius: 1.2rem !important;
            }

            .footer-inner {
                padding: 4.2rem 1rem 1.1rem !important;
                gap: 1.3rem !important;
            }

            .footer-top-grid {
                grid-template-columns: 1fr !important;
                gap: 1.25rem !important;
            }

            .footer-brand-col {
                gap: 1rem !important;
                justify-items: center;
            }

            .footer-logo-row {
                align-items: center !important;
                justify-content: center !important;
                text-align: center;
            }

            .footer-brand-headline {
                justify-items: center;
                text-align: center;
            }

            .footer-brand-desc {
                text-align: center;
            }

            .footer-tag-list {
                display: grid !important;
                width: 100%;
                grid-template-columns: repeat(3, minmax(0, 1fr));
                gap: 0.42rem !important;
            }

            .footer-tag-chip {
                text-align: center;
                padding: 0.42rem 0.22rem !important;
                font-size: 0.61rem !important;
                border-radius: 0.75rem !important;
            }

            .footer-support-col {
                gap: 0.75rem !important;
            }

            .footer-metrics {
                grid-template-columns: repeat(3, minmax(0, 1fr)) !important;
                gap: 0.55rem !important;
            }

            .footer-metric-card {
                padding: 0.52rem 0.55rem !important;
                border-radius: 0.72rem !important;
            }

            .footer-metric-value {
                font-size: 1.02rem !important;
            }

            .footer-metric-label {
                margin-top: 0.18rem !important;
                font-size: 0.56rem !important;
                letter-spacing: 0.07em !important;
            }

            .footer-links-grid {
                grid-template-columns: repeat(2, minmax(0, 1fr)) !important;
                gap: 1rem !important;
                padding-top: 1.2rem !important;
            }

            .footer-link-col--credits {
                grid-column: 1 / -1;
                margin-top: 0.85rem;
                text-align: center;
            }

            .footer-link-col--credits h4 {
                text-align: center;
            }

            .footer-credit-name {
                text-align: center;
            }

            .footer-bottom-row {
                flex-direction: column !important;
                align-items: center !important;
                gap: 0.8rem !important;
                text-align: center;
            }

            .footer-bottom-copy {
                text-align: center;
            }

            .footer-watermark {
                white-space: normal !important;
                font-size: clamp(2rem, 16vw, 3rem) !important;
                line-height: 0.95 !important;
                align-self: center;
                text-align: center;
            }
        }

        @media (max-width: 520px) {
            .footer-tag-chip {
                font-size: 0.56rem !important;
                padding: 0.36rem 0.18rem !important;
            }

            .footer-metrics {
                grid-template-columns: repeat(3, minmax(0, 1fr)) !important;
                gap: 0.38rem !important;
            }

            .footer-metric-card {
                padding: 0.44rem !important;
            }

            .footer-metric-value {
                font-size: 0.9rem !important;
            }

            .footer-metric-label {
                font-size: 0.52rem !important;
            }
        }

        [x-cloak] {
            display: none !important;
        }

        /* Scroll Reveal Animations */
        .reveal-on-scroll {
            opacity: 0;
            transform: translateY(30px) scale(0.96);
            transition: opacity 0.6s cubic-bezier(0.25, 0.46, 0.45, 0.94),
                transform 0.6s cubic-bezier(0.25, 0.46, 0.45, 0.94);
        }

        .reveal-on-scroll.revealed {
            opacity: 1;
            transform: translateY(0) scale(1);
        }

        /* Respect reduced motion preference */
        @media (prefers-reduced-motion: reduce) {
            .reveal-on-scroll {
                opacity: 1;
                transform: none;
                transition: none;
            }
        }
    </style>
</head>

<body class="bg-white text-gray-900 font-inter antialiased">
    <div id="global-nav-progress" class="page-load-progress" hidden aria-hidden="true">
        <span class="page-load-progress-bar"></span>
    </div>
    <div id="global-nav-overlay" class="page-load-overlay" hidden aria-hidden="true" role="status" aria-live="polite">
        <div class="page-load-overlay-card">
            <div class="page-load-overlay-mark" aria-hidden="true">
                <img src="{{ $faviconUrl ?: asset('images/cict-logo.webp') }}" alt="" width="40" height="40">
            </div>
            <span class="page-load-overlay-copy">
                <span class="page-load-overlay-label">Loading</span>
                <span class="page-load-overlay-subtitle">Just a moment</span>
                <span class="page-load-overlay-tip" data-loading-tip>Preparing your page...</span>
            </span>
        </div>
    </div>
    <div class="min-h-screen flex flex-col">
        <!-- Navigation -->
        <x-navbar />

        <!-- Main Content -->
        <main class="flex-1">
            {{ $slot }}
        </main>

        @unless(request()->is('admin*'))
            <footer class="footer" style="position: relative; margin-top: 4rem; color: var(--color-white); background: linear-gradient(180deg, #7a0000 0%, #5d0000 100%); overflow: hidden; border-top-left-radius: 2rem; border-top-right-radius: 2rem;">
                <div aria-hidden="true" style="position: absolute; top: -1px; left: 0; width: 100%; height: 86px; pointer-events: none; overflow: hidden; line-height: 0; z-index: 2;">
                    <svg viewBox="0 0 1440 120" preserveAspectRatio="none" style="display: block; width: 100%; height: 100%;">
                        <path d="M0,64 C120,104 240,104 360,72 C480,40 600,16 720,32 C840,48 960,104 1080,88 C1200,72 1320,24 1440,40 L1440,0 L0,0 Z" fill="#7a0000"></path>
                    </svg>
                </div>
                <div style="position: absolute; inset: 0; background-image: radial-gradient(rgba(255,255,255,0.09) 1px, transparent 1px); background-size: 28px 28px; opacity: 0.16; pointer-events: none;"></div>
                <div style="position: absolute; right: -8rem; top: 2rem; width: 22rem; height: 22rem; border-radius: 9999px; background: radial-gradient(circle, rgba(244,193,90,0.14), rgba(244,193,90,0) 70%); pointer-events: none;"></div>

                <div class="footer-inner" style="max-width: 1200px; margin: 0 auto; position: relative; z-index: 3; padding: 5rem 1.5rem 1.5rem; display: grid; gap: 2rem;">
                    @php
                        $logoSetting = \App\Models\Setting::where('key', 'site_logo')->first();
                        $logoUrl = $logoSetting && $logoSetting->value && str_starts_with($logoSetting->value, 'http')
                            ? $logoSetting->value
                            : asset('images/cict-logo.webp');
                    @endphp

                    <div class="footer-top-grid" style="display: grid; grid-template-columns: minmax(0, 1.25fr) minmax(280px, 0.75fr); gap: 2rem; align-items: start;">
                        <div class="footer-brand-col" style="display: grid; gap: 1.25rem; max-width: 44rem;">
                            <div class="footer-logo-row" style="display: flex; align-items: center; gap: 1rem; flex-wrap: wrap;">
                                <div style="width: 112px; height: 112px; border-radius: 9999px; overflow: hidden; background: rgba(255,255,255,0.08); border: 1px solid rgba(255,255,255,0.22); box-shadow: 0 18px 34px rgba(0,0,0,0.24); flex-shrink: 0;">
                                    <img src="{{ $logoUrl }}" alt="{{ config('app.name', 'CICT Dingle') }} logo" width="112" height="112" style="width: 100%; height: 100%; border-radius: 9999px; object-fit: cover; object-position: center; transform: scale(1.08); display: block;">
                                </div>
                                <div class="footer-brand-headline" style="display: grid; gap: 0.45rem;">
                                    <p style="margin: 0; font-size: 0.74rem; font-weight: 800; letter-spacing: 0.18em; text-transform: uppercase; color: rgba(255,255,255,0.74);">Campus store and services</p>
                                    <h3 style="margin: 0; font-family: var(--font-heading); font-size: clamp(2.25rem, 4vw, 3.4rem); line-height: 0.92; letter-spacing: -0.06em; color: white;">{{ config('app.name', 'CICT Dingle') }}</h3>
                                </div>
                            </div>

                            <p class="footer-brand-desc" style="margin: 0; max-width: 38rem; color: rgba(255,255,255,0.88); font-size: 1rem; line-height: 1.8;">
                                Campus-run store and services delivering merch, requests, and digital support for students and orgs.
                            </p>

                            <div class="footer-tag-list" style="display: flex; flex-wrap: wrap; gap: 0.7rem;">
                                <span class="footer-tag-chip" style="padding: 0.6rem 0.85rem; border-radius: 9999px; background: rgba(255,255,255,0.08); border: 1px solid rgba(255,255,255,0.14); font-size: 0.82rem; font-weight: 700; color: rgba(255,255,255,0.92);">Merchandise</span>
                                <span class="footer-tag-chip" style="padding: 0.6rem 0.85rem; border-radius: 9999px; background: rgba(255,255,255,0.08); border: 1px solid rgba(255,255,255,0.14); font-size: 0.82rem; font-weight: 700; color: rgba(255,255,255,0.92);">Services</span>
                                <span class="footer-tag-chip" style="padding: 0.6rem 0.85rem; border-radius: 9999px; background: rgba(255,255,255,0.08); border: 1px solid rgba(255,255,255,0.14); font-size: 0.82rem; font-weight: 700; color: rgba(255,255,255,0.92);">Student support</span>
                            </div>
                        </div>

                        <div class="footer-support-col" style="display: grid; gap: 1rem;">
                            <div style="padding: 1.15rem 1.2rem; border-radius: 1.25rem; background: rgba(255,255,255,0.09); border: 1px solid rgba(255,255,255,0.15); backdrop-filter: blur(14px); display: flex; gap: 0.9rem; align-items: flex-start;">
                                <span style="display: inline-flex; width: 42px; height: 42px; align-items: center; justify-content: center; border-radius: 9999px; background: rgba(244,193,90,0.18); color: #f4c15a; flex-shrink: 0;">
                                    <svg viewBox="0 0 24 24" aria-hidden="true" style="width: 20px; height: 20px; fill: currentColor;">
                                        <path d="M12 2 1 7l11 5 9-4.09V17h2V7L12 2Zm0 12L4.74 10.67 12 7.36l7.26 3.31L12 14Zm-9 2v2c0 2.2 4.03 4 9 4s9-1.8 9-4v-2l-9 4-9-4Z"/>
                                    </svg>
                                </span>
                                <div>
                                    <p style="margin: 0; font-size: 0.78rem; font-weight: 800; text-transform: uppercase; letter-spacing: 0.12em; color: rgba(255,255,255,0.72);">Official support</p>
                                    <p style="margin: 0.4rem 0 0 0; font-size: 0.92rem; color: rgba(255,255,255,0.88); line-height: 1.7;">Need help? Use the chatbot in the lower corner or contact the team directly.</p>
                                </div>
                            </div>

                            <div class="footer-metrics" style="display: grid; grid-template-columns: repeat(3, minmax(0, 1fr)); gap: 0.8rem;">
                                <div class="footer-metric-card" style="padding: 0.95rem 1rem; border-radius: 1rem; background: rgba(255,255,255,0.08); border: 1px solid rgba(255,255,255,0.12);">
                                    <p class="footer-metric-value" style="margin: 0; font-size: 1.35rem; font-weight: 800; line-height: 1;">Fast</p>
                                    <p class="footer-metric-label" style="margin: 0.3rem 0 0 0; font-size: 0.74rem; text-transform: uppercase; letter-spacing: 0.1em; color: rgba(255,255,255,0.72);">Turnaround</p>
                                </div>
                                <div class="footer-metric-card" style="padding: 0.95rem 1rem; border-radius: 1rem; background: rgba(255,255,255,0.08); border: 1px solid rgba(255,255,255,0.12);">
                                    <p class="footer-metric-value" style="margin: 0; font-size: 1.35rem; font-weight: 800; line-height: 1;">Clear</p>
                                    <p class="footer-metric-label" style="margin: 0.3rem 0 0 0; font-size: 0.74rem; text-transform: uppercase; letter-spacing: 0.1em; color: rgba(255,255,255,0.72);">Navigation</p>
                                </div>
                                <div class="footer-metric-card" style="padding: 0.95rem 1rem; border-radius: 1rem; background: rgba(255,255,255,0.08); border: 1px solid rgba(255,255,255,0.12);">
                                    <p class="footer-metric-value" style="margin: 0; font-size: 1.35rem; font-weight: 800; line-height: 1;">Official</p>
                                    <p class="footer-metric-label" style="margin: 0.3rem 0 0 0; font-size: 0.74rem; text-transform: uppercase; letter-spacing: 0.1em; color: rgba(255,255,255,0.72);">Campus</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="footer-links-grid" style="display: grid; grid-template-columns: repeat(3, minmax(0, 1fr)); gap: 1.25rem; padding-top: 1.75rem; border-top: 1px solid rgba(255,255,255,0.14);">
                        <div class="footer-link-col footer-link-col--explore">
                            <h4 style="margin: 0 0 1rem 0; font-family: var(--font-heading); font-size: 0.92rem; letter-spacing: 0.12em; text-transform: uppercase; color: rgba(255,255,255,0.9);">Explore</h4>
                            <div style="display: grid; gap: 0.7rem;">
                                <a class="footer-nav-link" href="/">Home</a>
                                <a class="footer-nav-link" href="{{ route('shop.index') }}">Shop</a>
                                <a class="footer-nav-link" href="{{ route('services.index') }}">Services</a>
                                <a class="footer-nav-link" href="{{ route('contact.index') }}">Contact</a>
                            </div>
                        </div>

                        <div class="footer-link-col footer-link-col--support">
                            <h4 style="margin: 0 0 1rem 0; font-family: var(--font-heading); font-size: 0.92rem; letter-spacing: 0.12em; text-transform: uppercase; color: rgba(255,255,255,0.9);">Support</h4>
                            <div style="display: grid; gap: 0.7rem;">
                                <a class="footer-nav-link" href="https://www.facebook.com/profile.php?id=100068849010766" target="_blank">Facebook</a>
                                <a class="footer-nav-link" href="https://www.messenger.com/e2ee/t/780806171591045" target="_blank">Messenger</a>
                                <a class="footer-nav-link" href="{{ route('contact.index') }}">Get help</a>
                            </div>
                        </div>

                        <div class="footer-link-col footer-link-col--credits">
                            <h4 style="margin: 0 0 1rem 0; font-family: var(--font-heading); font-size: 0.92rem; letter-spacing: 0.12em; text-transform: uppercase; color: rgba(255,255,255,0.9);">Credits</h4>
                            <div style="display: grid; gap: 0.7rem;">
                                <span class="footer-credit-name" style="padding: 0.65rem 0.85rem; border-radius: 1rem; background: rgba(255,255,255,0.09); border: 1px solid rgba(255,255,255,0.14); font-size: 0.92rem; font-weight: 700;">Lou Vincent Baroro - Developer</span>
                                <span class="footer-credit-name" style="padding: 0.65rem 0.85rem; border-radius: 1rem; background: rgba(255,255,255,0.09); border: 1px solid rgba(255,255,255,0.14); font-size: 0.92rem; font-weight: 700;">Karl Calimotan - UI/UX Designer</span>
                            </div>
                        </div>
                    </div>

                    <div class="footer-bottom-row" style="display: flex; flex-wrap: wrap; justify-content: space-between; gap: 1rem; align-items: center; padding-top: 1rem; border-top: 1px solid rgba(255,255,255,0.12);">
                        <div class="footer-bottom-copy" style="display: grid; gap: 0.3rem;">
                            <p style="margin: 0; color: rgba(255,255,255,0.76); font-size: 0.9rem;">&copy; 2026 ISUFST CICT</p>
                            <p style="margin: 0; color: rgba(255,255,255,0.62); font-size: 0.85rem;">All rights reserved.</p>
                        </div>

                        <p class="footer-watermark" style="margin: 0; font-family: var(--font-heading); font-size: clamp(2.15rem, 7vw, 5.1rem); font-weight: 800; letter-spacing: -0.045em; line-height: 0.9; color: rgba(255,255,255,0.11); white-space: nowrap;">ISUFST DINGLE CAMPUS</p>
                    </div>
                </div>
            </footer>
        @endunless
    </div>

    <!-- Toast Notification Component -->
    <div x-data="{
            show: false,
            message: '',
            type: 'success',
            init() {
                const pendingToast = window.sessionStorage ? window.sessionStorage.getItem('cict-pending-toast') : null;
                if (pendingToast) {
                    try {
                        const data = JSON.parse(pendingToast);
                        this.showToast(data.message || '', data.type || 'success');
                    } catch (error) {
                        this.showToast('Action completed.', 'success');
                    }
                    window.sessionStorage.removeItem('cict-pending-toast');
                }

                @if(session('success'))
                    this.showToast(@json(session('success')), 'success');
                @endif
                @if(session('error'))
                    this.showToast(@json(session('error')), 'error');
                @endif
            },
            showToast(msg, toastType = 'success') {
                this.message = msg;
                this.type = toastType;
                this.show = true;
                setTimeout(() => { this.show = false }, 4000);
            }
        }" @toast.window="showToast($event.detail.message, $event.detail.type || 'success')" x-show="show"
        x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0 translate-y-4 scale-95"
        x-transition:enter-end="opacity-100 translate-y-0 scale-100" x-transition:leave="transition ease-in duration-200"
        x-transition:leave-start="opacity-100 translate-y-0 scale-100" x-transition:leave-end="opacity-0 translate-y-4 scale-95"
        class="fixed bottom-8 right-8 z-[99999] max-w-md" style="display: none;">
        <div class="rounded-2xl shadow-2xl p-4 flex items-center gap-3 border border-white/10"
            :style="type === 'success' ? 'background: linear-gradient(135deg, rgba(122,14,14,0.96), rgba(91,0,0,0.96)); backdrop-filter: blur(12px);' : 'background: linear-gradient(135deg, rgba(239,68,68,0.96), rgba(127,29,29,0.96)); backdrop-filter: blur(12px);'">
            <div class="flex-shrink-0">
                <template x-if="type === 'success'">
                    <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                </template>
                <template x-if="type === 'error'">
                    <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                </template>
            </div>

            <p class="text-white font-semibold flex-1 leading-snug" x-text="message"></p>

            <button @click="show = false" class="flex-shrink-0 text-white/90 hover:text-white transition-colors">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                </svg>
            </button>
        </div>
    </div>

    <!-- Modern Chatbot Widget -->
    <div id="cict-chatbot" class="fixed z-50"
        style="position: fixed !important; bottom: 24px !important; right: 24px !important; z-index: 2147483647 !important; pointer-events: auto !important;">

        <!-- Animated Floating Button with AI Assistant Icon -->
        <button aria-label="Open CICT AI Assistant" id="cict-chatbot-btn" class="chatbot-btn-animated" style="
                width: 64px;
                height: 64px;
                border-radius: 50%;
                border: none;
                cursor: pointer;
                display: flex !important;
                align-items: center;
                justify-content: center;
                background: linear-gradient(145deg, #8B0000 0%, #6B0000 100%);
                box-shadow: 0 8px 32px rgba(139, 0, 0, 0.4), 0 0 0 2px rgba(244, 193, 90, 0.52), 0 0 0 0 rgba(139, 0, 0, 0.4);
                transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
                pointer-events: auto !important;
                position: relative;
                overflow: visible;
            "
            onmouseover="this.style.transform='scale(1.1) translateY(-4px)'; this.style.boxShadow='0 16px 48px rgba(139, 0, 0, 0.5), 0 0 0 3px rgba(244, 193, 90, 0.72), 0 0 0 0 rgba(139, 0, 0, 0)';"
            onmouseout="this.style.transform='scale(1)'; this.style.boxShadow='0 8px 32px rgba(139, 0, 0, 0.4), 0 0 0 2px rgba(244, 193, 90, 0.52), 0 0 0 0 rgba(139, 0, 0, 0.4)';">

            <!-- Chatbot icon for clearer intent -->
            <svg style="width: 30px; height: 30px;" viewBox="0 0 24 24" fill="none" aria-hidden="true">
                <rect x="4.5" y="7" width="15" height="10.5" rx="3.2" stroke="white" stroke-width="1.9" />
                <path d="M12 4.1v2.4" stroke="white" stroke-width="1.9" stroke-linecap="round" />
                <circle cx="9.2" cy="11.9" r="1.15" fill="white" />
                <circle cx="14.8" cy="11.9" r="1.15" fill="white" />
                <path d="M9.4 14.5h5.2" stroke="white" stroke-width="1.6" stroke-linecap="round" />
            </svg>

            <!-- Online indicator - positioned outside button overflow -->
            <span style="
                position: absolute;
                top: -2px;
                right: -2px;
                width: 16px;
                height: 16px;
                background: #22C55E;
                border-radius: 50%;
                border: 3px solid #f4c15a;
                box-shadow: 0 2px 8px rgba(34, 197, 94, 0.5);
                z-index: 10;
            "></span>

            <!-- Ripple animation ring -->
            <span class="chatbot-ripple"></span>
        </button>

        <style>
            /* Pulse animation for chatbot button */
            .chatbot-btn-animated {
                animation: chatbot-pulse 3s ease-in-out infinite;
            }

            @keyframes chatbot-pulse {

                0%,
                100% {
                    box-shadow: 0 8px 32px rgba(139, 0, 0, 0.4), 0 0 0 2px rgba(244, 193, 90, 0.52), 0 0 0 0 rgba(139, 0, 0, 0.4);
                }

                50% {
                    box-shadow: 0 8px 32px rgba(139, 0, 0, 0.4), 0 0 0 2px rgba(244, 193, 90, 0.52), 0 0 0 12px rgba(139, 0, 0, 0);
                }
            }

            /* Ripple effect */
            .chatbot-ripple {
                position: absolute;
                inset: -4px;
                border-radius: 50%;
                border: 2px solid rgba(244, 193, 90, 0.55);
                animation: chatbot-ripple-anim 2s ease-out infinite;
                pointer-events: none;
            }

            @keyframes chatbot-ripple-anim {
                0% {
                    transform: scale(1);
                    opacity: 0.6;
                }

                100% {
                    transform: scale(1.4);
                    opacity: 0;
                }
            }

            /* Hover stops the pulse animation */
            .chatbot-btn-animated:hover {
                animation: none;
            }

            .chatbot-btn-animated:hover .chatbot-ripple {
                animation: none;
                opacity: 0;
            }
        </style>

        <!-- Modern Chat Window -->
        <div id="cict-chatbot-window" class="hidden fixed" role="dialog" aria-label="CICT Assistant" aria-hidden="true"
            style="
                display: none;
                right: 24px;
                bottom: 24px;
                width: 320px;
                height: 480px;
                background: #FFFFFF;
                border-radius: 20px;
                box-shadow: 0 25px 60px rgba(0,0,0,0.18), 0 0 0 1px rgba(0,0,0,0.05);
                z-index: 2147483647 !important;
                overflow: hidden;
                flex-direction: column;
            ">

            <!-- Header -->
            <div style="
                padding: 16px 18px;
                background: linear-gradient(145deg, #8B0000 0%, #6B0000 100%);
                display: flex;
                align-items: center;
                justify-content: space-between;
            ">
                <div style="display: flex; align-items: center; gap: 12px;">
                    <div style="
                        width: 38px;
                        height: 38px;
                        background: rgba(255,255,255,0.18);
                        border-radius: 12px;
                        display: flex;
                        align-items: center;
                        justify-content: center;
                        backdrop-filter: blur(4px);
                    ">
                        <svg style="width: 20px; height: 20px; color: white;" viewBox="0 0 24 24" fill="currentColor">
                            <path d="M12 2L9.19 8.63L2 11.5L9.19 14.37L12 21L14.81 14.37L22 11.5L14.81 8.63L12 2Z" />
                        </svg>
                    </div>
                    <div>
                        <div style="color: white; font-size: 15px; font-weight: 700; letter-spacing: -0.3px;">CICT
                            Assistant</div>
                        <div
                            style="color: rgba(255,255,255,0.85); font-size: 12px; display: flex; align-items: center; gap: 6px;">
                            <span style="width: 7px; height: 7px; background: #4ADE80; border-radius: 50%;"></span>
                            <span>Online now</span>
                        </div>
                    </div>
                </div>
                <button id="cict-chatbot-close" aria-label="Close chat" style="
                        width: 32px;
                        height: 32px;
                        border: none;
                        background: rgba(255,255,255,0.12);
                        border-radius: 10px;
                        cursor: pointer;
                        display: flex;
                        align-items: center;
                        justify-content: center;
                        transition: background 0.2s;
                    " onmouseover="this.style.background='rgba(255,255,255,0.22)';"
                    onmouseout="this.style.background='rgba(255,255,255,0.12)';">
                    <svg style="width: 18px; height: 18px; color: white;" fill="none" stroke="currentColor"
                        viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12">
                        </path>
                    </svg>
                </button>
            </div>

            <!-- Messages area -->
            <div id="cict-chat-messages" style="
                flex: 1;
                overflow-y: auto;
                padding: 16px;
                background: linear-gradient(180deg, #FAFAFA 0%, #F5F5F5 100%);
            ">
                <!-- Messages rendered by JS -->
            </div>

            <!-- Loading indicator -->
            <div id="cict-chat-loading" style="display: none; padding: 12px 16px;">
                <div
                    style="display: flex; gap: 4px; padding: 12px 16px; background: white; border-radius: 16px; width: fit-content; box-shadow: 0 2px 8px rgba(0,0,0,0.06);">
                    <span
                        style="width: 8px; height: 8px; background: #CBD5E1; border-radius: 50%; animation: bounce 1.4s infinite;"></span>
                    <span
                        style="width: 8px; height: 8px; background: #CBD5E1; border-radius: 50%; animation: bounce 1.4s infinite; animation-delay: 0.2s;"></span>
                    <span
                        style="width: 8px; height: 8px; background: #CBD5E1; border-radius: 50%; animation: bounce 1.4s infinite; animation-delay: 0.4s;"></span>
                </div>
            </div>

            <!-- Input area -->
            <div style="
                padding: 14px 16px;
                background: #FFFFFF;
                border-top: 1px solid #F0F0F0;
            ">
                <form id="cict-chat-form" data-no-loading="true" style="display: flex; gap: 10px; align-items: center;">
                    <input id="cict-chat-input" name="message" aria-label="Chat message" type="text"
                        placeholder="Type a message..." style="
                            flex: 1;
                            padding: 12px 16px;
                            border: 1px solid #E5E7EB;
                            border-radius: 12px;
                            font-size: 14px;
                            outline: none;
                            transition: border-color 0.2s, box-shadow 0.2s;
                            background: #FAFAFA;
                        "
                        onfocus="this.style.borderColor='#8B0000'; this.style.boxShadow='0 0 0 3px rgba(139,0,0,0.08)'; this.style.background='#fff';"
                        onblur="this.style.borderColor='#E5E7EB'; this.style.boxShadow='none'; this.style.background='#FAFAFA';" />
                    <button id="cict-chat-send" type="submit" style="
                            width: 44px;
                            height: 44px;
                            border: none;
                            border-radius: 12px;
                            background: linear-gradient(145deg, #8B0000 0%, #6B0000 100%);
                            color: white;
                            cursor: pointer;
                            display: flex;
                            align-items: center;
                            justify-content: center;
                            transition: all 0.2s;
                            box-shadow: 0 4px 12px rgba(139,0,0,0.25);
                        "
                        onmouseover="this.style.transform='scale(1.05)'; this.style.boxShadow='0 6px 16px rgba(139,0,0,0.35)';"
                        onmouseout="this.style.transform='scale(1)'; this.style.boxShadow='0 4px 12px rgba(139,0,0,0.25)';">
                        <svg style="width: 18px; height: 18px;" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                            stroke-width="2.5">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M6 12L3.269 3.126A59.768 59.768 0 0121.485 12 59.77 59.77 0 013.27 20.876L5.999 12zm0 0h7.5">
                            </path>
                        </svg>
                    </button>
                </form>
            </div>

        </div>
    </div>

    <style>
        @keyframes bounce {

            0%,
            60%,
            100% {
                transform: translateY(0);
            }

            30% {
                transform: translateY(-6px);
            }
        }
    </style>

    <!-- Alpine.js from unpkg (faster) -->
    <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>

    <!-- Scroll Reveal Animation Script -->
    <script>
        (function () {
            // Respect reduced motion preference
            if (window.matchMedia && window.matchMedia('(prefers-reduced-motion: reduce)').matches) {
                return;
            }

            document.addEventListener('DOMContentLoaded', function () {
                const revealElements = document.querySelectorAll('.reveal-on-scroll');
                if (!revealElements.length) return;

                const observer = new IntersectionObserver(function (entries) {
                    entries.forEach(function (entry) {
                        const el = entry.target;
                        
                        // Only animate if not already revealed
                        if (entry.isIntersecting && !el.classList.contains('revealed')) {
                            const delay = parseInt(el.dataset.revealDelay || '0', 10);
                            
                            setTimeout(function () {
                                el.classList.add('revealed');
                                // Stop observing this element once revealed
                                observer.unobserve(el);
                            }, delay);
                        }
                    });
                }, {
                    root: null,
                    rootMargin: '0px 0px -50px 0px',
                    threshold: 0.1
                });

                revealElements.forEach(function (el) {
                    observer.observe(el);
                });
            });
        })();
    </script>

    <!-- Global navigation loading UX -->
    <script>
        (function () {
            const progress = document.getElementById('global-nav-progress');
            const overlay = document.getElementById('global-nav-overlay');
            const tipEl = overlay ? overlay.querySelector('[data-loading-tip]') : null;
            if (!progress || !overlay) {
                return;
            }

            let active = false;
            let settlingTimer = null;
            let tipTimer = null;
            const allowedPaths = new Set(['/', '/shop', '/services', '/contact']);
            const loadingTips = [
                'Tip: Shop for products, Services for requests, and Contact for help.',
                'FAQ: Orders and service requests are organized in separate pages for faster browsing.',
                'Tip: You can use the chatbot in the corner if you need a quick answer.',
                'FAQ: This store is built for ISUFST Dingle Campus students and campus support.',
            ];

            function setLoadingTip(index) {
                if (!tipEl || !loadingTips.length) {
                    return;
                }

                tipEl.textContent = loadingTips[index % loadingTips.length];
            }

            function normalizePath(pathname) {
                if (!pathname) {
                    return '/';
                }

                const trimmed = pathname.replace(/\/+$/, '');
                return trimmed === '' ? '/' : trimmed;
            }

            function resetLoadingState() {
                active = false;
                document.body.classList.remove('is-navigating');
                clearTimeout(settlingTimer);
                clearInterval(tipTimer);
                tipTimer = null;
                progress.classList.remove('is-active', 'is-settling');
                progress.setAttribute('hidden', 'hidden');
                overlay.classList.remove('is-active');
                overlay.setAttribute('hidden', 'hidden');
                if (tipEl) {
                    tipEl.textContent = 'Preparing your page...';
                }
                document.querySelectorAll('.is-loading[aria-busy="true"]').forEach(function (el) {
                    el.classList.remove('is-loading');
                    el.removeAttribute('aria-busy');
                });
            }

            function startLoadingState(triggerEl) {
                if (active) {
                    return;
                }

                active = true;
                document.body.classList.add('is-navigating');

                if (triggerEl) {
                    triggerEl.classList.add('is-loading');
                    triggerEl.setAttribute('aria-busy', 'true');
                }

                progress.removeAttribute('hidden');
                overlay.removeAttribute('hidden');
                setLoadingTip(0);
                clearInterval(tipTimer);
                let tipIndex = 0;
                tipTimer = window.setInterval(function () {
                    tipIndex += 1;
                    setLoadingTip(tipIndex);
                }, 3600);
                requestAnimationFrame(function () {
                    progress.classList.add('is-active');
                    overlay.classList.add('is-active');
                });

                settlingTimer = window.setTimeout(function () {
                    progress.classList.add('is-settling');
                }, 220);
            }

            function shouldStartForLink(el, event) {
                if (!el || event.defaultPrevented) {
                    return false;
                }

                if (event.button !== 0 || event.metaKey || event.ctrlKey || event.shiftKey || event.altKey) {
                    return false;
                }

                const href = el.getAttribute('href');
                if (!href || href.startsWith('#') || href.startsWith('javascript:') || href.startsWith('mailto:') || href.startsWith('tel:')) {
                    return false;
                }

                if (el.hasAttribute('download') || el.getAttribute('target') === '_blank') {
                    return false;
                }

                let targetUrl;
                try {
                    targetUrl = new URL(el.href, window.location.href);
                } catch (_e) {
                    return false;
                }

                if (targetUrl.origin !== window.location.origin) {
                    return false;
                }

                const targetPath = normalizePath(targetUrl.pathname);
                if (!allowedPaths.has(targetPath)) {
                    return false;
                }

                const current = window.location;
                if (targetPath === normalizePath(current.pathname) && targetUrl.search === current.search && targetUrl.hash) {
                    return false;
                }

                return true;
            }

            document.addEventListener('click', function (event) {
                const link = event.target.closest('a');
                if (shouldStartForLink(link, event)) {
                    startLoadingState(link);
                }
            }, true);

            window.addEventListener('beforeunload', function () {
                document.body.classList.add('is-navigating');
            });

            window.addEventListener('pageshow', resetLoadingState);
            resetLoadingState();
        })();
    </script>

    <script>
        (function () {
            function markWrapper(wrapper) {
                if (!wrapper) return;
                const img = wrapper.querySelector('img');
                if (!img) return;

                function finish() {
                    wrapper.classList.add('is-loaded');
                }

                if (img.complete && img.naturalWidth > 0) {
                    finish();
                    return;
                }

                img.addEventListener('load', finish, { once: true });
                img.addEventListener('error', finish, { once: true });
            }

            function boot() {
                document.querySelectorAll('.loading-skeleton-wrap').forEach(markWrapper);
            }

            if (document.readyState === 'loading') {
                document.addEventListener('DOMContentLoaded', boot, { once: true });
            } else {
                boot();
            }
        })();
    </script>

    <!-- Chatbot (vanilla JS): renders messages, handles send & quick actions, always-on-top -->
    <script>
        (function () {
            // Routes & tokens from Blade
            const CHAT_POST = '{{ route('chatbot.chat') }}';
            const QUICK_ROUTES = {
                shop: '{{ route('shop.index') }}',
                services: '{{ route('services.index') }}',
                orders: '{{ route('account.orders') }}',
                contact: '{{ route('contact.index') }}'
            };
            const CSRF = '{{ csrf_token() }}';

            function $(sel, root = document) { return root.querySelector(sel); }
            function $all(sel, root = document) { return Array.from(root.querySelectorAll(sel)); }

            const root = document.getElementById('cict-chatbot');
            if (!root) return;

            // Ensure the widget is appended to document.body — this avoids clipping or transforms
            // from ancestor elements that can make fixed-positioned children invisible.
            try {
                if (root.parentElement && root.parentElement !== document.body) {
                    document.body.appendChild(root);
                    // Debug log removed for production
                }
            } catch (e) {
                // Silently handle widget positioning error
            }

            const btn = $('#cict-chatbot-btn', root);
            const win = $('#cict-chatbot-window', root);
            const messagesEl = $('#cict-chat-messages', root);
            const loadingEl = $('#cict-chat-loading', root);
            const form = $('#cict-chat-form', root);
            const input = $('#cict-chat-input', root);
            const closeBtn = $('#cict-chatbot-close', root);

            let state = { open: false, loading: false, messages: [] };

            function timeNow() {
                return new Date().toLocaleTimeString([], { hour: '2-digit', minute: '2-digit' });
            }

            function escapeHtml(str) {
                return String(str).replace(/[&<>"]|'/g, function (s) { return ({ '&': '&amp;', '<': '&lt;', '>': '&gt;', '"': '&quot;', "'": '&#39;' })[s]; });
            }

            function render() {
                if (!messagesEl) return;
                const logo = `<div class="flex flex-col items-center justify-center py-8 opacity-70">
                    <div class="w-16 h-16 rounded-full flex items-center justify-center mb-3" style="background: linear-gradient(135deg,#8B0000 0%,#A00000 100%); box-shadow: 0 4px 12px rgba(139,0,0,0.3);">
                        <svg class="w-8 h-8 text-white" viewBox="0 0 24 24" fill="currentColor">
                            <path d="M12 2a1 1 0 0 1 1 1v1h2a3 3 0 0 1 3 3v7a3 3 0 0 1-3 3h-2l-3 3-3-3H6a3 3 0 0 1-3-3V7a3 3 0 0 1 3-3h2V3a1 1 0 0 1 2 0v1h2V3a1 1 0 0 1 1-1ZM9 10.5a1.25 1.25 0 1 0 0 2.5 1.25 1.25 0 0 0 0-2.5Zm6 0a1.25 1.25 0 1 0 0 2.5 1.25 1.25 0 0 0 0-2.5Z"/>
                        </svg>
                    </div>
                    <div class="text-center">
                        <div class="text-lg font-bold text-gray-700 mb-1">CICT AI</div>
                        <div class="text-xs text-gray-500">How can I help you today?</div>
                    </div>
                </div>`;

                const messages = state.messages.map((m, idx) => {
                    const wrapper = m.type === 'user' ? 'flex justify-end' : 'flex justify-start';
                    const bubble = m.type === 'user'
                        ? 'bg-blue-500 text-white shadow-sm hover:shadow-md'
                        : 'bg-white border border-gray-200 shadow-sm hover:shadow-md';
                    const timeClass = m.type === 'user' ? 'text-blue-100' : 'text-gray-500';
                    const roundedClass = m.type === 'user' ? 'rounded-xl rounded-br-sm' : 'rounded-xl rounded-bl-sm';
                    // render links if any
                    let linksHtml = '';
                    if (m.links && Array.isArray(m.links) && m.links.length) {
                        linksHtml = '<div class="mt-3 flex gap-2 flex-wrap">' + m.links.map(l => `<a href="${encodeURI(l.url)}" class="text-xs bg-white/90 border border-gray-200 text-maroon-700 px-2 py-1 rounded-full hover:bg-maroon-50 shadow-sm" target="_blank" rel="noopener noreferrer">${escapeHtml(l.text)}</a>`).join('') + '</div>';
                    }

                    return `<div class="${wrapper} message-enter" style="animation-delay: ${idx * 0.05}s"><div class="${bubble} ${roundedClass} max-w-[85%] px-3 py-2 transition-shadow duration-200"><div class="text-sm leading-relaxed break-words overflow-wrap-anywhere whitespace-pre-wrap">${escapeHtml(m.text)}</div>${linksHtml}<div class="text-[10px] mt-1 ${timeClass} opacity-65">${escapeHtml(m.time)}</div></div></div>`;
                }).join('');

                messagesEl.innerHTML = logo + (state.messages.length > 0 ? '<div class="space-y-2 mt-4">' + messages + '</div>' : '');

                // Ensure the newest message is fully visible instead of being cut off while waiting for a reply.
                // Use a small timeout to allow the browser to render and measure elements before scrolling.
                setTimeout(() => {
                    try {
                        const entries = messagesEl.querySelectorAll('.message-enter');
                        if (entries && entries.length) {
                            const last = entries[entries.length - 1];
                            last.scrollIntoView({ behavior: 'smooth', block: 'end', inline: 'nearest' });
                        } else {
                            messagesEl.scrollTop = messagesEl.scrollHeight;
                        }
                    } catch (e) {
                        messagesEl.scrollTop = messagesEl.scrollHeight;
                    }
                }, 40);
            }

            function openChat() {
                state.open = true;
                // remove any Tailwind 'hidden' class and ensure the window is visually on top and clickable
                if (win.classList.contains('hidden')) win.classList.remove('hidden');
                win.style.removeProperty('display'); // clear prior inline style then set important below
                win.style.setProperty('display', 'flex', 'important');
                win.style.visibility = 'visible';
                win.style.setProperty('z-index', '2147483647', 'important');
                win.style.setProperty('pointer-events', 'auto', 'important');
                win.classList.add('chat-window-enter');
                win.setAttribute('aria-hidden', 'false');
                if (window.APP_DEBUG) console.log('CICT chat: openChat - showing window');
                // Force bottom-right anchoring to keep it fixed in the visible area
                win.style.setProperty('right', '24px', 'important');
                win.style.setProperty('bottom', '24px', 'important');
                win.style.removeProperty('left');
                win.style.removeProperty('top');

                btn.style.setProperty('display', 'none', 'important');
                btn.setAttribute('aria-expanded', 'true');
                setTimeout(() => messagesEl.scrollTop = messagesEl.scrollHeight, 80);

                // Debugging: log computed styles and bounding rect to help diagnose visibility problems
                try {
                    const cs = window.getComputedStyle(win);
                    if (window.APP_DEBUG) console.log('CICT chat: computed display=', cs.display, 'visibility=', cs.visibility, 'opacity=', cs.opacity, 'zIndex=', cs.zIndex);
                    const rect = win.getBoundingClientRect();
                    if (window.APP_DEBUG) console.log('CICT chat: bounding rect=', rect);

                    // Log viewport info
                    if (window.APP_DEBUG) console.log('CICT chat: viewport innerHeight=', window.innerHeight, 'innerWidth=', window.innerWidth, 'scrollY=', window.scrollY, 'clientHeight=', document.documentElement.clientHeight);

                    // If the element is partially or fully off-screen (top >= innerHeight OR bottom > innerHeight OR fully above) reposition
                    if (rect.top >= window.innerHeight || rect.bottom > window.innerHeight || rect.bottom <= 0 || rect.top < 0) {
                        console.warn('CICT chat: window off-screen or partially off-screen — repositioning into viewport');

                        // If the chat window is taller than the viewport, make it fit inside the viewport with padding
                        if (rect.height >= window.innerHeight) {
                            const pad = 24;
                            win.style.setProperty('top', pad + 'px', 'important');
                            win.style.setProperty('bottom', 'auto', 'important');
                            win.style.setProperty('height', Math.max(120, window.innerHeight - pad * 2) + 'px', 'important');
                        } else {
                            // Normal case: position the window just above the bottom edge, with 24px margin
                            const targetTop = Math.max(24, window.innerHeight - rect.height - 24);
                            win.style.setProperty('top', targetTop + 'px', 'important');
                            win.style.setProperty('bottom', 'auto', 'important');
                        }

                        // Ensure visible horizontally too (handle left/right off-screen)
                        if (rect.left < 0 || rect.right > window.innerWidth) {
                            // move it fully into the viewport (24px margin from the right)
                            win.style.setProperty('left', Math.max(12, window.innerWidth - rect.width - 24) + 'px', 'important');
                            win.style.setProperty('right', 'auto', 'important');
                        }

                        const newRect = win.getBoundingClientRect();
                        if (window.APP_DEBUG) console.log('CICT chat: new bounding rect=', newRect);
                        // also log computed style after reposition
                        const cs2 = window.getComputedStyle(win);
                        if (window.APP_DEBUG) console.log('CICT chat: computed after reposition display=', cs2.display, 'top=', cs2.top, 'bottom=', cs2.bottom, 'left=', cs2.left, 'right=', cs2.right);
                    }

                    // Walk up ancestors and log any transforms which can affect fixed positioning
                    let node = win.parentElement; let i = 0; while (node && i < 8) {
                        const pcs = window.getComputedStyle(node);
                        if (pcs.transform && pcs.transform !== 'none' && window.APP_DEBUG) console.log('CICT chat: ancestor transform on', node.tagName, 'transform=', pcs.transform);
                        node = node.parentElement; i++;
                    }
                } catch (e) { console.error('CICT chat: openChat debug error', e); }
            }

            function closeChat() {
                state.open = false;
                win.style.setProperty('display', 'none', 'important');
                win.setAttribute('aria-hidden', 'true');
                if (window.APP_DEBUG) console.log('CICT chat: closeChat - hiding window');
                btn.style.setProperty('display', 'flex', 'important');
                btn.setAttribute('aria-expanded', 'false');
            }

            function setLoading(v) {
                state.loading = !!v;
                if (loadingEl) loadingEl.style.display = state.loading ? 'block' : 'none';
                if (input) input.disabled = state.loading;
                // when entering loading state, ensure the most recent message remains visible
                if (state.loading && messagesEl) {
                    setTimeout(() => {
                        try {
                            const entries = messagesEl.querySelectorAll('.message-enter');
                            if (entries && entries.length) entries[entries.length - 1].scrollIntoView({ block: 'end' });
                        } catch (e) { messagesEl.scrollTop = messagesEl.scrollHeight; }
                    }, 40);
                }
            }

            async function sendMessage(text) {
                if (!text || !text.trim()) return;
                state.messages.push({ type: 'user', text: text.trim(), time: timeNow() });
                render();
                setLoading(true);
                try {
                    const res = await fetch(CHAT_POST, {
                        method: 'POST',
                        headers: { 'Content-Type': 'application/json', 'X-CSRF-TOKEN': CSRF },
                        body: JSON.stringify({ message: text.trim() })
                    });
                    const data = await res.json();
                    if (data && data.success) {
                        const botMsg = { type: 'bot', text: data.message, time: timeNow() };
                        if (data.quick_links && Array.isArray(data.quick_links) && data.quick_links.length) botMsg.links = data.quick_links;
                        state.messages.push(botMsg);
                    } else {
                        state.messages.push({ type: 'bot', text: data.error || 'Sorry — something went wrong. Try again later.', time: timeNow() });
                    }
                } catch (err) {
                    console.error('Chat send error', err);
                    state.messages.push({ type: 'bot', text: 'Connection error. Please try again later.', time: timeNow() });
                } finally {
                    setLoading(false);
                    render();
                }
            }

            // initialize
            state.messages.push({ type: 'bot', text: 'Hi! 👋 I\'m the CICT AI Assistant — how can I help?', time: timeNow() });
            render();

            // ensure the button is visible and clickable
            if (btn) {
                // make sure the floating button is interactive and on top
                btn.style.setProperty('display', 'flex', 'important');
                btn.style.setProperty('z-index', '2147483647', 'important');
                btn.style.setProperty('pointer-events', 'auto', 'important');
                btn.addEventListener('click', function (e) { if (window.APP_DEBUG) console.log('CICT chat: button clicked'); e.preventDefault(); openChat(); });
            }

            if (closeBtn) closeBtn.addEventListener('click', function (e) { if (window.APP_DEBUG) console.log('CICT chat: close clicked'); e.preventDefault(); closeChat(); });

            if (form) {
                form.addEventListener('submit', function (e) {
                    e.preventDefault();
                    const v = input ? input.value : '';
                    if (!v || !v.trim()) return;
                    if (input) input.value = '';
                    sendMessage(v);
                });
            }

            // wire quick action buttons
            $all('[data-quick]', root).forEach(el => {
                el.addEventListener('click', function (e) {
                    e.preventDefault();
                    const key = el.getAttribute('data-quick');
                    if (key && QUICK_ROUTES[key]) window.location.href = QUICK_ROUTES[key];
                });
            });

            // keep widget on top and fixed while scrolling (already fixed by layout, ensure style)
            win.style.setProperty('position', 'fixed', 'important');
            win.style.setProperty('z-index', '2147483647', 'important');

            console.log('CICT chat widget (vanilla) initialized', window.location.host + ':' + window.location.port);
        })();
    </script>

    <!-- Minimal Animation (particles only for visual appeal) -->
    <script src="{{ asset('js/particles.js') }}" defer></script>
    
    <!-- Professional Modern Animations (GSAP) -->
    <script src="{{ asset('js/modern-animations.js') }}" defer></script>

    @stack('body-end')
</body>

</html>