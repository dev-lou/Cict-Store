<x-app-layout>
    @section('title', 'Services - ' . config('app.name', 'TheWerk'))

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

        /* ============ HERO SECTION ============ */
        .services-hero {
            min-height: 50vh;
            padding: 160px 24px 60px;
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
            .services-hero {
                min-height: 55vh;
                padding-top: 140px;
                padding-bottom: 40px;
            }

            .services-hero-content {
                margin-top: 60px;
            }
        }

        .services-hero::before {
            content: '';
            position: absolute;
            inset: 0;
            background: url('{{ asset("images/cict_hero_bg.png") }}') center/cover;
            opacity: 0.15;
        }

        .services-hero-content {
            position: relative;
            z-index: 10;
            max-width: 700px;
        }

        .services-hero-badge {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            padding: 8px 16px;
            background: rgba(255, 255, 255, 0.15);
            border-radius: 999px;
            color: #fff;
            font-size: 14px;
            font-weight: 600;
            margin-bottom: 20px;
        }

        .services-hero-title {
            font-size: clamp(32px, 5vw, 48px);
            font-weight: 800;
            color: #fff;
            line-height: 1.1;
            margin-bottom: 16px;
            letter-spacing: -1px;
        }

        .services-hero-subtitle {
            font-size: clamp(14px, 2vw, 18px);
            color: rgba(255, 255, 255, 0.9);
            line-height: 1.5;
        }

        /* ============ MAIN CONTENT ============ */
        .services-content {
            background: var(--bg-secondary);
            padding: 60px 24px 80px;
        }

        .services-container {
            max-width: 1200px;
            margin: 0 auto;
        }

        /* ============ CATEGORY SECTION ============ */
        .category-section {
            margin-bottom: 64px;
        }

        .category-section:last-child {
            margin-bottom: 0;
        }

        .category-header {
            margin-bottom: 24px;
        }

        .category-title {
            font-size: 24px;
            font-weight: 700;
            color: var(--text-primary);
            margin-bottom: 8px;
        }

        .category-subtitle {
            font-size: 14px;
            color: var(--text-secondary);
        }

        /* ============ SERVICES GRID ============ */
        .services-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 24px;
        }

        @media (max-width: 1024px) {
            .services-grid {
                grid-template-columns: repeat(2, 1fr);
            }
        }

        @media (max-width: 640px) {
            .services-grid {
                grid-template-columns: repeat(2, 1fr);
                gap: 12px;
            }

            .service-card {
                padding: 16px;
            }

            .service-header {
                flex-direction: column;
                gap: 12px;
            }

            .service-icon {
                width: 40px;
                height: 40px;
                font-size: 20px;
            }

            .service-title {
                font-size: 14px;
            }

            .service-category-badge {
                font-size: 10px;
            }

            .service-description {
                font-size: 12px;
                margin-bottom: 12px;
                display: -webkit-box;
                -webkit-line-clamp: 2;
                -webkit-box-orient: vertical;
                overflow: hidden;
            }

            .service-footer {
                flex-direction: column;
                gap: 8px;
                align-items: flex-start;
            }

            .service-price {
                font-size: 16px;
            }
        }

        /* ============ SERVICE CARD ============ */
        .service-card {
            background: var(--bg-primary);
            border: 1px solid var(--border);
            border-radius: var(--radius-lg);
            padding: 24px;
            transition: all 0.3s ease;
            display: flex;
            flex-direction: column;
            text-decoration: none;
        }

        .service-card:hover {
            transform: translateY(-4px);
            box-shadow: var(--shadow-lg);
            border-color: var(--primary);
        }

        .service-header {
            display: flex;
            align-items: flex-start;
            gap: 16px;
            margin-bottom: 16px;
        }

        .service-icon {
            width: 48px;
            height: 48px;
            background: linear-gradient(135deg, rgba(139, 0, 0, 0.1), rgba(139, 0, 0, 0.05));
            border-radius: var(--radius-md);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 24px;
            flex-shrink: 0;
        }

        .service-title-group {
            flex: 1;
        }

        .service-title {
            font-size: 18px;
            font-weight: 600;
            color: var(--text-primary);
            margin-bottom: 4px;
        }

        .service-category-badge {
            font-size: 11px;
            font-weight: 600;
            color: var(--primary);
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .service-description {
            font-size: 14px;
            color: var(--text-secondary);
            line-height: 1.6;
            margin-bottom: 16px;
            flex: 1;
        }

        .service-footer {
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding-top: 16px;
            border-top: 1px solid var(--border);
        }

        .service-price {
            font-size: 18px;
            font-weight: 700;
            color: var(--primary);
        }

        .service-price-label {
            font-size: 12px;
            color: var(--text-secondary);
            font-weight: 500;
        }

        .service-link {
            font-size: 14px;
            font-weight: 600;
            color: var(--primary);
            display: flex;
            align-items: center;
            gap: 4px;
        }

        .service-link:hover {
            text-decoration: underline;
        }

        /* ============ OFFICERS SECTION ============ */
        .officers-section {
            margin-top: 64px;
            padding-top: 48px;
            border-top: 1px solid var(--border);
        }

        .section-title {
            font-size: 24px;
            font-weight: 700;
            color: var(--text-primary);
            margin-bottom: 8px;
            text-align: center;
        }

        .section-subtitle {
            font-size: 14px;
            color: var(--text-secondary);
            text-align: center;
        }

        .officers-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(280px, 1fr));
            gap: 16px;
        }

        @media (max-width: 640px) {
            .officers-grid {
                grid-template-columns: repeat(2, 1fr);
                gap: 12px;
            }

            .officer-card {
                flex-direction: column;
                text-align: center;
                padding: 16px;
                gap: 10px;
            }

            .officer-avatar {
                width: 56px;
                height: 56px;
                font-size: 18px;
            }

            .officer-info {
                min-width: 0;
            }

            .officer-name {
                font-size: 13px;
            }

            .officer-title {
                font-size: 11px;
            }

            .officer-action {
                font-size: 12px;
            }
        }

        .officer-card {
            display: flex;
            align-items: center;
            gap: 16px;
            background: var(--bg-primary);
            border: 1px solid var(--border);
            border-radius: var(--radius-lg);
            padding: 20px;
            text-decoration: none;
            transition: all 0.3s ease;
        }

        .officer-card:hover {
            transform: translateY(-4px);
            box-shadow: var(--shadow-lg);
            border-color: var(--primary);
        }

        .officer-avatar {
            width: 48px;
            height: 48px;
            background: linear-gradient(135deg, var(--primary), #5C0000);
            color: #fff;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 16px;
            font-weight: 700;
            flex-shrink: 0;
        }

        .officer-info {
            flex: 1;
            min-width: 0;
        }

        .officer-name {
            font-size: 15px;
            font-weight: 600;
            color: var(--text-primary);
            margin: 0 0 4px 0;
        }

        .officer-title {
            font-size: 13px;
            color: var(--text-secondary);
            margin: 0;
        }

        .officer-action {
            font-size: 13px;
            font-weight: 600;
            color: var(--primary);
            flex-shrink: 0;
        }

        /* ============ INSTRUCTIONS SECTION ============ */
        .instructions-section {
            background: var(--bg-primary);
            border: 1px solid var(--border);
            border-radius: var(--radius-lg);
            padding: 48px;
            margin-top: 64px;
        }

        @media (max-width: 640px) {
            .instructions-section {
                padding: 24px;
            }
        }

        .instructions-title {
            font-size: 24px;
            font-weight: 700;
            color: var(--text-primary);
            text-align: center;
            margin-bottom: 8px;
        }

        .instructions-subtitle {
            font-size: 14px;
            color: var(--text-secondary);
            text-align: center;
            margin-bottom: 32px;
        }

        .instructions-grid {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 24px;
        }

        @media (max-width: 768px) {
            .instructions-grid {
                grid-template-columns: repeat(2, 1fr);
            }
        }

        .instruction-step {
            text-align: center;
        }

        .step-number {
            width: 48px;
            height: 48px;
            background: var(--primary);
            color: #fff;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 18px;
            font-weight: 700;
            margin: 0 auto 16px;
        }

        .step-title {
            font-size: 16px;
            font-weight: 600;
            color: var(--text-primary);
            margin-bottom: 8px;
        }

        .step-description {
            font-size: 13px;
            color: var(--text-secondary);
            line-height: 1.5;
        }

        .instructions-cta {
            text-align: center;
            margin-top: 32px;
            padding-top: 24px;
            border-top: 1px solid var(--border);
        }

        .btn-primary {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            padding: 14px 28px;
            background: var(--primary);
            color: #fff;
            font-size: 15px;
            font-weight: 600;
            border-radius: var(--radius-md);
            text-decoration: none;
            transition: all 0.2s ease;
        }

        .btn-primary:hover {
            background: var(--primary-hover);
            transform: translateY(-2px);
        }

        /* ============ HOURS CARD ============ */
        .hours-card {
            background: linear-gradient(135deg, var(--primary) 0%, #5C0000 100%);
            border-radius: var(--radius-lg);
            padding: 48px;
            text-align: center;
            margin-top: 48px;
            color: #fff;
        }

        .hours-title {
            font-size: 24px;
            font-weight: 700;
            margin-bottom: 16px;
        }

        .hours-time {
            font-size: 20px;
            font-weight: 600;
            margin-bottom: 8px;
        }

        .hours-note {
            font-size: 14px;
            opacity: 0.9;
        }

        /* ============ EMPTY STATE ============ */
        .empty-state {
            text-align: center;
            padding: 80px 24px;
        }

        .empty-state-text {
            font-size: 16px;
            color: var(--text-secondary);
        }

        /* ============ MOBILE ADJUSTMENTS ============ */
        @media (max-width: 640px) {
            .services-hero {
                min-height: 40vh;
                padding: 120px 16px 40px;
            }

            .services-hero-title {
                font-size: 28px;
            }

            .services-content {
                padding: 40px 16px 60px;
            }

            .service-card {
                padding: 20px;
            }
        }
    </style>

    <!-- Hero Section -->
    <section class="services-hero">
        <div class="services-hero-content">
            <div class="services-hero-badge">
                <span>🖨️</span>
                <span>Professional Services</span>
            </div>
            <h1 class="services-hero-title gsap-hero-title">Our Services</h1>
            <p class="services-hero-subtitle gsap-hero-subtitle">
                Print, IT, and digital solutions for students, organizations, and events.
            </p>
        </div>
    </section>

    <!-- Services Content -->
    <div class="services-content">
        <div class="services-container">
            @forelse($groupedServices as $category => $categoryServices)
                <div class="category-section">
                    <div class="category-header">
                        <h2 class="category-title">{{ $category }}</h2>
                        @php $catDesc = $categoryDescriptions[$category] ?? null; @endphp
                        <p class="category-subtitle">{{ $catDesc ?: 'Browse our available services' }}</p>
                    </div>

                    <div class="services-grid">
                        @foreach($categoryServices as $service)
                            @php
                                $startingPrice = $service->price_bw ?? $service->price_color;
                                $priceLabel = $service->price_label ?: 'per unit';
                            @endphp
                            <a href="{{ route('services.show', $service->slug) }}" class="service-card reveal-on-scroll">
                                <div class="service-header">
                                    <div class="service-icon">{{ $service->icon ?? '🖨️' }}</div>
                                    <div class="service-title-group">
                                        <h3 class="service-title">{{ $service->title }}</h3>
                                        <span class="service-category-badge">{{ $service->category ?? 'Service' }}</span>
                                    </div>
                                </div>
                                <p class="service-description">{{ Str::limit($service->description, 120) }}</p>
                                <div class="service-footer">
                                    @if($startingPrice)
                                        <div>
                                            <div class="service-price-label">Starting from</div>
                                            <div class="service-price">₱{{ number_format($startingPrice, 2) }}</div>
                                        </div>
                                    @endif
                                    <span class="service-link">
                                        Details <span>→</span>
                                    </span>
                                </div>
                            </a>
                        @endforeach
                    </div>
                </div>
            @empty
                <div class="empty-state">
                    <p class="empty-state-text">No services available at the moment.</p>
                </div>
            @endforelse

            <!-- Officers Section -->
            @if(isset($officers) && $officers->count() > 0)
                <div class="officers-section reveal-on-scroll">
                    <div class="section-header" style="margin-bottom: 32px;">
                        <h2 class="section-title">Our Officers</h2>
                        <p class="section-subtitle">Contact our team for service inquiries and assistance</p>
                    </div>

                    <div class="officers-grid">
                        @foreach($officers as $officer)
                            <a href="{{ $officer->messenger_url }}" target="_blank" class="officer-card">
                                <div class="officer-avatar">
                                    {{ $officer->initials }}
                                </div>
                                <div class="officer-info">
                                    <h4 class="officer-name">{{ $officer->name }}</h4>
                                    <p class="officer-title">{{ $officer->title }}</p>
                                </div>
                                <div class="officer-action">
                                    <span>Message →</span>
                                </div>
                            </a>
                        @endforeach
                    </div>
                </div>
            @endif

            <!-- Instructions Section -->
            <div class="instructions-section reveal-on-scroll">
                <h2 class="instructions-title">How to Request a Service</h2>
                <p class="instructions-subtitle">Simple 4-step process to get started</p>

                <div class="instructions-grid">
                    <div class="instruction-step">
                        <div class="step-number">1</div>
                        <h4 class="step-title">Tell Us What You Need</h4>
                        <p class="step-description">Share the service type and your requirements</p>
                    </div>
                    <div class="instruction-step">
                        <div class="step-number">2</div>
                        <h4 class="step-title">Send Your Files</h4>
                        <p class="step-description">Upload documents, specs, or reference photos</p>
                    </div>
                    <div class="instruction-step">
                        <div class="step-number">3</div>
                        <h4 class="step-title">We Confirm Details</h4>
                        <p class="step-description">We'll reply with cost and timeline</p>
                    </div>
                    <div class="instruction-step">
                        <div class="step-number">4</div>
                        <h4 class="step-title">Approve & Receive</h4>
                        <p class="step-description">Confirm the quote and pick up your order</p>
                    </div>
                </div>

                <div class="instructions-cta">
                    <a href="https://www.messenger.com/e2ee/t/780806171591045" target="_blank" class="btn-primary">
                        Message Us on Messenger
                        <span>→</span>
                    </a>
                </div>
            </div>

            <!-- Hours Card -->
            <div class="hours-card reveal-on-scroll">
                <h3 class="hours-title">Service Hours</h3>
                <p class="hours-time">Monday – Friday: 8:00 AM – 5:00 PM</p>
                <p class="hours-note">Closed on weekends and holidays</p>
            </div>
        </div>
    </div>

</x-app-layout>