@props(['title' => config('app.name', 'CICT Dingle')])

<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ $title }}</title>

    <!-- DNS Preconnect for faster external resource loading -->
    <link rel="dns-prefetch" href="//fonts.googleapis.com">
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link rel="dns-prefetch" href="//cdnjs.cloudflare.com">

    <!-- Favicon (cached query) -->
    @php
        $faviconUrl = Cache::remember('site.favicon_url', now()->addHours(1), function () {
            $faviconSetting = \App\Models\Setting::where('key', 'site_favicon')->first();
            return ($faviconSetting && $faviconSetting->value) 
                ? \Storage::disk('supabase')->url($faviconSetting->value) 
                : null;
        });
    @endphp
    @if($faviconUrl)
        <link rel="icon" href="{{ $faviconUrl }}" type="image/x-icon">
    @endif

    <!-- Preconnect and Fonts (display=swap for faster text rendering) -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">

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

    @php 
        $viteManifestPath = public_path('build/manifest.json');
        $hasViteBuild = file_exists($viteManifestPath);
    @endphp
    @if ($hasViteBuild)
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    @else
        @if (file_exists(public_path('css/app.css')))
            <link rel="stylesheet" href="{{ asset('css/app.css') }}">
        @endif
        @if (file_exists(public_path('js/app.js')))
            <script src="{{ asset('js/app.js') }}" defer></script>
        @endif
    @endif

    <!-- Non-critical Animation CSS (load async) -->
    <link rel="stylesheet" href="{{ asset('css/page-transitions.css') }}" media="print" onload="this.media='all'">
    <link rel="stylesheet" href="{{ asset('css/micro-interactions.css') }}" media="print" onload="this.media='all'">
    <link rel="stylesheet" href="{{ asset('css/text-animations.css') }}" media="print" onload="this.media='all'">
    <link rel="stylesheet" href="{{ asset('css/button-interactions.css') }}" media="print" onload="this.media='all'">
    <link rel="stylesheet" href="{{ asset('css/animation-utilities.css') }}" media="print" onload="this.media='all'">
    <noscript>
        <link rel="stylesheet" href="{{ asset('css/page-transitions.css') }}">
        <link rel="stylesheet" href="{{ asset('css/micro-interactions.css') }}">
        <link rel="stylesheet" href="{{ asset('css/text-animations.css') }}">
        <link rel="stylesheet" href="{{ asset('css/button-interactions.css') }}">
        <link rel="stylesheet" href="{{ asset('css/animation-utilities.css') }}">
    </noscript>

    <!-- GSAP Animation Library (defer to not block rendering) -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.5/gsap.min.js" defer></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.5/ScrollTrigger.min.js" defer></script>
    
    <script>
        // Initialize GSAP plugins after load
        window.addEventListener('DOMContentLoaded', function() {
            if (typeof gsap !== 'undefined' && typeof ScrollTrigger !== 'undefined') {
                gsap.registerPlugin(ScrollTrigger);
            }
        });
    </script>

    <!-- Animations handled by CSS transitions -->

    <style>
        /* Global mobile fixes */
        html, body { overflow-x: hidden; }
        *, *::before, *::after { box-sizing: border-box; }

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
            .footer-main-wrapper {
                flex-direction: column;
                align-items: center;
            }
            
            .footer-logo-section {
                flex-direction: column !important;
                align-items: center !important;
                text-align: center;
                min-width: 100% !important;
                width: 100% !important;
            }

            .footer-logo-section h3,
            .footer-logo-section p {
                text-align: center !important;
            }

            .footer-support-section {
                max-width: 100% !important;
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
    <div class="min-h-screen flex flex-col">
        <!-- Navigation -->
        <x-navbar />

        <!-- Main Content -->
        <main class="flex-1">
            {{ $slot }}
        </main>

        @unless(request()->is('admin*'))
            <!-- Footer -->
            <footer class="bg-gray-900 text-gray-200 py-16 border-t border-gray-800 mt-16">
                <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 flex flex-col gap-10">
                    <div style="display: flex; justify-content: space-between; align-items: flex-start; flex-wrap: wrap; gap: 24px;" class="footer-main-wrapper">
                        <div style="display: flex; align-items: flex-start; gap: 22px; flex: 1; min-width: 280px;" class="footer-logo-section">
                            <div class="flex-shrink-0"
                                style="width:92px; height:92px; border-radius:9999px; padding:6px; background:#fff; box-shadow: 0 12px 28px rgba(0,0,0,0.3); display:flex; align-items:center; justify-content:center;">
                                <div
                                    style="width:80px; height:80px; border-radius:9999px; overflow:hidden; background:#fff;">
                                    @php
                                        $logoSetting = \App\Models\Setting::where('key', 'site_logo')->first();
                                        $logoUrl = $logoSetting && $logoSetting->value 
                                            ? \Storage::disk('supabase')->url($logoSetting->value) 
                                            : asset('images/ctrlp-logo.png');
                                    @endphp
                                    <img src="{{ $logoUrl }}" alt="{{ config('app.name', 'CICT Dingle') }} logo"
                                        class="w-full h-full object-cover" style="display:block; border-radius:9999px;">
                                </div>
                            </div>
                            <div>
                                <h3 class="font-bold text-xl text-white" style="margin: 0;">{{ config('app.name', 'CICT Dingle') }}</h3>
                                <p class="text-sm" style="margin: 2px 0 0 0; color: rgba(255,255,255,0.75);">ISUFST Dingle Campus · Shop & Services</p>
                                <p class="text-sm"
                                    style="margin: 12px 0 0 0; color: rgba(255,255,255,0.7); line-height:1.7; max-width: 22rem;">Campus-run
                                    store and services delivering print, merch, and digital support for students and orgs.
                                </p>
                            </div>
                        </div>

                        <div style="flex-shrink: 0; width: 100%; max-width: 420px;" class="footer-support-section">
                            <div class="p-4 rounded-xl flex items-start gap-3"
                                style="background: rgba(255,255,255,0.05); border: 1px solid rgba(255,255,255,0.12);">
                                <span class="inline-flex h-9 w-9 items-center justify-center rounded-full"
                                    style="background: linear-gradient(135deg,#8B0000,#A00000); color:white; box-shadow: 0 8px 20px rgba(0,0,0,0.18); flex-shrink: 0;">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                        stroke-width="1.6" stroke="currentColor" class="w-5 h-5">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M12 18.25c-2.548 0-4.93-.862-6.772-2.25a.75.75 0 0 1-.228-.834l1.115-3.34a.75.75 0 0 1 .713-.519h1.547A.75.75 0 0 0 9.125 10v-.25A3.625 3.625 0 0 1 12.75 6.125h1.25A3.625 3.625 0 0 1 17.625 9.75v.25a.75.75 0 0 0 .75.75h1.547a.75.75 0 0 1 .713.519l1.115 3.34a.75.75 0 0 1-.228.834A12.433 12.433 0 0 1 12 18.25Z" />
                                    </svg>
                                </span>
                                <div>
                                    <p class="text-sm font-semibold text-white" style="margin: 0;">Support</p>
                                    <p class="text-sm" style="margin: 8px 0 0 0; color: rgba(255,255,255,0.78);">Need help? Ask the
                                        chatbot on the bottom-right — it is always on.</p>
                                </div>
                            </div>
                        </div>

                        <div class="md:col-span-12 flex flex-col gap-4 mt-4 md:mt-0">
                            <h4 class="font-semibold text-sm text-white">Credits</h4>
                            <div class="flex flex-wrap gap-3 text-sm" style="color: rgba(255,255,255,0.92);">
                                <span class="px-4 py-3 rounded-xl"
                                    style="background: rgba(255,255,255,0.08); border: 1px solid rgba(255,255,255,0.18); font-weight: 700;">Lou
                                    Vincent Baroro — Developer</span>
                                <span class="px-4 py-3 rounded-xl"
                                    style="background: rgba(255,255,255,0.08); border: 1px solid rgba(255,255,255,0.18); font-weight: 700;">Karl
                                    Calitamon — UX/UI Designer</span>
                            </div>
                        </div>
                    </div>

                    <div class="pt-4 text-sm flex flex-col sm:flex-row items-center sm:items-center sm:justify-between gap-2 sm:gap-4"
                        style="border-top: 1px solid rgba(255,255,255,0.12); color: rgba(255,255,255,0.75); flex-wrap: wrap;">
                        <p class="m-0">&copy; {{ date('Y') }} {{ config('app.name', 'CICT Dingle') }} · ISUFST Dingle Campus</p>
                        <p class="m-0 text-xs" style="color: rgba(255,255,255,0.65);">All rights reserved.</p>
                    </div>
                </div>
            </footer>
        @endunless
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
                box-shadow: 0 8px 32px rgba(139, 0, 0, 0.4), 0 0 0 0 rgba(139, 0, 0, 0.4);
                transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
                pointer-events: auto !important;
                position: relative;
                overflow: visible;
            "
            onmouseover="this.style.transform='scale(1.1) translateY(-4px)'; this.style.boxShadow='0 16px 48px rgba(139, 0, 0, 0.5), 0 0 0 0 rgba(139, 0, 0, 0)';"
            onmouseout="this.style.transform='scale(1)'; this.style.boxShadow='0 8px 32px rgba(139, 0, 0, 0.4), 0 0 0 0 rgba(139, 0, 0, 0.4)';">

            <!-- AI Sparkle/Brain Icon - Better for AI Assistant -->
            <svg style="width: 28px; height: 28px;" viewBox="0 0 24 24" fill="none">
                <!-- Sparkle star shape representing AI -->
                <path
                    d="M12 2L13.09 8.26L18 6L15.74 10.91L22 12L15.74 13.09L18 18L13.09 15.74L12 22L10.91 15.74L6 18L8.26 13.09L2 12L8.26 10.91L6 6L10.91 8.26L12 2Z"
                    fill="white" stroke="white" stroke-width="0.5" />
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
                border: 3px solid white;
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
                    box-shadow: 0 8px 32px rgba(139, 0, 0, 0.4), 0 0 0 0 rgba(139, 0, 0, 0.4);
                }

                50% {
                    box-shadow: 0 8px 32px rgba(139, 0, 0, 0.4), 0 0 0 12px rgba(139, 0, 0, 0);
                }
            }

            /* Ripple effect */
            .chatbot-ripple {
                position: absolute;
                inset: -4px;
                border-radius: 50%;
                border: 2px solid rgba(139, 0, 0, 0.3);
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
                <form id="cict-chat-form" style="display: flex; gap: 10px; align-items: center;">
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
                            <path d="M12 2L9.19 8.63L2 11.5L9.19 14.37L12 21L14.81 14.37L22 11.5L14.81 8.63L12 2Z"/>
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

    <!-- Page Transition Script -->
    <script src="{{ asset('js/page-transitions.js') }}"></script>

    <!-- Advanced Animation System -->
    <script src="{{ asset('js/morphing-blobs.js') }}"></script>
    <script src="{{ asset('js/particles.js') }}"></script>
    <script src="{{ asset('js/gsap-animations.js') }}"></script>

    <!-- Enhanced Professional Animation System -->
    <script src="{{ asset('js/card-magnetic.js') }}" defer></script>
    <script src="{{ asset('js/scroll-reveal-enhanced.js') }}" defer></script>
    <script src="{{ asset('js/text-split-animate.js') }}" defer></script>
    <script src="{{ asset('js/parallax-simple.js') }}" defer></script>

    <!-- Performance-Optimized Animations -->
    <script src="{{ asset('js/card-interactions.js') }}" defer></script>
    <script src="{{ asset('js/scroll-reveals.js') }}" defer></script>
    <script src="{{ asset('js/text-reveal.js') }}" defer></script>
    <script src="{{ asset('js/parallax-lite.js') }}" defer></script>

    @stack('body-end')
</body>

</html>