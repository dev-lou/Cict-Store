<x-app-layout :title="'Services | ISUFST CICT Dingle Campus'"
    :meta_description="'Explore official ISUFST CICT Dingle Campus services with premium layout, clearer options, and direct officer support.'">

    @php
        $serviceIconKey = function ($service) {
            $text = \Illuminate\Support\Str::lower(($service->title ?? '') . ' ' . ($service->category ?? ''));

            if (str_contains($text, 'photo') || str_contains($text, 'image') || str_contains($text, 'id')) {
                return 'camera';
            }
            if (str_contains($text, 'design') || str_contains($text, 'layout') || str_contains($text, 'tarpaulin') || str_contains($text, 'logo')) {
                return 'pen';
            }
            if (str_contains($text, 'scan') || str_contains($text, 'print') || str_contains($text, 'copy') || str_contains($text, 'document')) {
                return 'document';
            }
            if (str_contains($text, 'binding') || str_contains($text, 'laminate') || str_contains($text, 'finish')) {
                return 'layers';
            }

            return 'spark';
        };
    @endphp

    <style>
        @media (max-width: 768px) {
            .services-officer-grid {
                display: grid !important;
                grid-template-columns: repeat(2, minmax(0, 1fr)) !important;
                gap: 0.75rem !important;
                overflow: visible;
                padding-bottom: 0;
            }

            .services-officer-grid .services-officer-card {
                min-width: 0;
                padding: 0.85rem !important;
            }

            .services-officer-grid .services-officer-head {
                display: flex !important;
                flex-direction: column;
                align-items: center;
                justify-content: flex-start;
                text-align: center;
                gap: 0.45rem !important;
            }

            .services-officer-grid .services-officer-meta {
                min-width: 0;
                width: 100%;
                text-align: center;
            }

            .services-officer-grid .services-officer-name,
            .services-officer-grid .services-officer-rank {
                white-space: normal !important;
                overflow: visible !important;
                text-overflow: clip !important;
                line-height: 1.3;
            }

            .services-officer-grid .services-officer-card .btn {
                font-size: 0.74rem;
                padding: 0.5rem 0.6rem;
            }
        }
    </style>

    <section class="store-section store-section-soft store-hero-section" style="padding: clamp(7rem, 12vw, 9rem) 1.5rem 2rem;">
        <div class="store-shell">
            <div class="editorial-hero">
                <div class="editorial-hero-glow" aria-hidden="true"></div>
                <div class="editorial-hero-grid" style="display: grid; grid-template-columns: minmax(0, 1.12fr) minmax(280px, 0.88fr); gap: 1.5rem; align-items: center; position: relative; z-index: 1;">
                    <div>
                        <div class="editorial-eyebrow" style="display: inline-flex; align-items: center; gap: 0.55rem; width: fit-content; padding: 0.55rem 0.95rem; border-radius: 9999px; background: rgba(255,255,255,0.12); border: 1px solid rgba(255,255,255,0.18); color: white; font-size: 0.76rem; font-weight: 800; letter-spacing: 0.12em; text-transform: uppercase;">
                            <span style="width: 0.45rem; height: 0.45rem; border-radius: 9999px; background: #f4c15a; box-shadow: 0 0 0 4px rgba(244,193,90,0.18);"></span>
                            Digital Service Hub
                        </div>
                        <h1 class="editorial-title" style="color: white; text-shadow: 0 4px 14px rgba(0, 0, 0, 0.14); font-size: clamp(2.8rem, 6vw, 5rem); line-height: 0.95; letter-spacing: -0.05em; margin: 1rem 0 0 0; max-width: 14ch;">Campus Services, Reframed.</h1>
                        <p class="editorial-subtitle" style="margin: 1rem 0 0 0; color: rgba(255,255,255,0.95); font-size: clamp(1rem, 2.2vw, 1.2rem); line-height: 1.65; max-width: 40rem; font-weight: 500;">Premium service presentation with cleaner options, clearer pricing, and direct support for students and campus organizations.</p>
                        <div class="editorial-chips" style="display: flex; flex-wrap: wrap; gap: 0.65rem; margin-top: 1.2rem;">
                            <span class="editorial-chip" style="padding: 0.55rem 0.8rem; border-radius: 9999px; background: rgba(255,255,255,0.09); border: 1px solid rgba(255,255,255,0.15); color: rgba(255,255,255,0.92); font-size: 0.8rem; font-weight: 700;">Officer Support</span>
                            <span class="editorial-chip" style="padding: 0.55rem 0.8rem; border-radius: 9999px; background: rgba(255,255,255,0.09); border: 1px solid rgba(255,255,255,0.15); color: rgba(255,255,255,0.92); font-size: 0.8rem; font-weight: 700;">Transparent Pricing</span>
                            <span class="editorial-chip editorial-chip--mobile-hide" style="padding: 0.55rem 0.8rem; border-radius: 9999px; background: rgba(255,255,255,0.09); border: 1px solid rgba(255,255,255,0.15); color: rgba(255,255,255,0.92); font-size: 0.8rem; font-weight: 700;">Fast Turnaround</span>
                        </div>
                    </div>
                    <div class="editorial-panel" style="position: relative; overflow: hidden; border-radius: 2rem; padding: 2rem; background: linear-gradient(135deg, rgba(255,255,255,0.12) 0%, rgba(255,255,255,0.06) 100%); border: 1px solid rgba(255,255,255,0.18); backdrop-filter: blur(20px); color: white; box-shadow: 0 24px 48px rgba(0,0,0,0.22), 0 0 1px rgba(255,255,255,0.08) inset;">
                        <p style="margin: 0 0 0.5rem 0; font-size: 0.7rem; font-weight: 900; text-transform: uppercase; letter-spacing: 0.16em; color: rgba(244,193,90,0.95);">Campus Workflows</p>
                        <h3 style="margin: 0 0 1rem 0; font-size: 1.6rem; line-height: 1.15; letter-spacing: -0.03em; color: white; font-weight: 800;">Built for real campus needs</h3>
                        <p style="margin: 0; color: rgba(255,255,255,0.92); line-height: 1.8; font-size: 1rem;">From document tasks to digital requests, each service is organized to reduce confusion and move requests faster.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="store-section store-section-soft" style="padding: 3.5rem 1.5rem 3.2rem;">
        <div class="store-shell">
            @if($groupedServices->isNotEmpty())
                <div style="background: #fff; border: 1px solid var(--color-gray-200); border-radius: 1rem; padding: 0.9rem; margin-bottom: 1.4rem; box-shadow: var(--shadow-sm);">
                    <div style="display: flex; flex-wrap: wrap; gap: 0.7rem;">
                        @foreach($groupedServices as $category => $categoryServices)
                            @php
                                $categorySlug = \Illuminate\Support\Str::slug($category ?: 'general');
                            @endphp
                            <a href="#category-{{ $categorySlug }}" class="btn btn-secondary" style="font-size: 0.72rem; padding: 0.45rem 0.8rem; text-transform: uppercase; letter-spacing: 0.08em;">
                                {{ $category ?: 'General' }}
                            </a>
                        @endforeach
                    </div>
                </div>
            @endif

            @forelse($groupedServices as $category => $categoryServices)
                @php
                    $serviceCount = $categoryServices->count();
                    $categorySlug = \Illuminate\Support\Str::slug($category ?: 'general');
                @endphp
                <article id="category-{{ $categorySlug }}" style="margin-bottom: 2.4rem;">
                    <div class="premium-section-head">
                        <div>
                            <p class="premium-kicker">Track {{ str_pad((string) $loop->iteration, 2, '0', STR_PAD_LEFT) }}</p>
                            <h2 class="h2" style="margin: 0;">{{ $category ?: 'General Services' }}</h2>
                        </div>
                        <p>{{ $serviceCount }} options curated with clearer service hierarchy and faster access to details.</p>
                    </div>

                    <div class="premium-service-grid">
                        @foreach($categoryServices as $service)
                            @php
                                $icon = $serviceIconKey($service);
                                $price = $service->price_primary ?? $service->price_bw ?? $service->price_color ?? null;
                                $iconColors = [
                                    'camera' => ['bg' => 'rgba(59, 130, 246, 0.12)', 'color' => '#3b82f6'],
                                    'pen' => ['bg' => 'rgba(168, 85, 247, 0.12)', 'color' => '#a855f7'],
                                    'document' => ['bg' => 'rgba(34, 197, 94, 0.12)', 'color' => '#22c55e'],
                                    'layers' => ['bg' => 'rgba(244, 193, 90, 0.14)', 'color' => '#f4c15a'],
                                    'default' => ['bg' => 'rgba(99, 102, 241, 0.12)', 'color' => '#6366f1']
                                ];
                                $colors = $iconColors[$icon] ?? $iconColors['default'];
                            @endphp
                            <a href="{{ route('services.show', $service->slug) }}" class="premium-service-card">
                                <div class="premium-service-head">
                                    <span class="premium-icon-wrap" style="background: {{ $colors['bg'] }}; color: {{ $colors['color'] }};" aria-hidden="true">
                                        @switch($icon)
                                            @case('camera')
                                                <svg viewBox="0 0 24 24"><path d="M4 8h3l1.6-2h6.8L17 8h3v11H4z"></path><circle cx="12" cy="13" r="3.6"></circle></svg>
                                                @break
                                            @case('pen')
                                                <svg viewBox="0 0 24 24"><path d="M4 20l4.2-1 9.5-9.5-3.2-3.2L5 15.8 4 20z"></path><path d="m13.8 5.8 3.2 3.2"></path></svg>
                                                @break
                                            @case('document')
                                                <svg viewBox="0 0 24 24"><path d="M7 3h7l4 4v14H7z"></path><path d="M14 3v5h4"></path><path d="M10 12h5M10 16h5"></path></svg>
                                                @break
                                            @case('layers')
                                                <svg viewBox="0 0 24 24"><path d="m12 4 8 4-8 4-8-4 8-4z"></path><path d="m4 12 8 4 8-4"></path><path d="m4 16 8 4 8-4"></path></svg>
                                                @break
                                            @default
                                                <svg viewBox="0 0 24 24"><path d="M12 3v6"></path><path d="M12 15v6"></path><path d="m5.6 6.4 4.2 4.2"></path><path d="m14.2 15 4.2 4.2"></path><path d="M3 12h6"></path><path d="M15 12h6"></path></svg>
                                        @endswitch
                                    </span>
                                    <span class="premium-service-price">
                                        @if(!is_null($price))
                                            From P{{ number_format($price, 2) }}
                                        @else
                                            Custom quote
                                        @endif
                                    </span>
                                </div>

                                <h3 class="premium-service-title">{{ $service->title }}</h3>
                                <p class="premium-service-desc">{{ Str::limit($service->description, 120) }}</p>

                                <div class="premium-service-foot">
                                    <span>View service</span>
                                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" style="width: 1rem; height: 1rem;">
                                        <path d="M7 17 17 7"></path>
                                        <path d="M8 7h9v9"></path>
                                    </svg>
                                </div>
                            </a>
                        @endforeach
                    </div>
                </article>
            @empty
                <article style="border-radius: 2rem; border: 2px dashed rgba(139,0,0,0.14); background: linear-gradient(135deg, rgba(139,0,0,0.04) 0%, rgba(244,193,90,0.04) 100%); padding: 4rem 2rem; text-align: center; box-shadow: 0 4px 16px rgba(139,0,0,0.06);">
                    <div style="width: 5.5rem; height: 5.5rem; margin: 0 auto 1.5rem; border-radius: 1.5rem; background: linear-gradient(135deg, rgba(244,193,90,0.12) 0%, rgba(139,0,0,0.08) 100%); border: 2px solid rgba(244,193,90,0.2); color: #8b0000; display:flex; align-items:center; justify-content:center; font-size: 2.2rem;">✦</div>
                    <h2 class="h2" style="margin: 0 0 0.75rem 0; color: #111827;">Services Catalog Opening Soon</h2>
                    <p style="margin: 0 auto 2rem; color: #4b5563; max-width: 40rem; line-height: 1.8; font-size: 1.05rem;">We're preparing a curated selection of document services, design requests, and campus support. Check back soon or <strong>contact our team</strong> for immediate assistance.</p>
                    <div style="display: flex; gap: 1rem; justify-content: center; flex-wrap: wrap;">
                        <a href="{{ route('shop.index') }}" class="btn btn-primary" style="display:inline-flex; gap: 0.5rem; text-decoration:none;">
                            <svg width="18" height="18" fill="currentColor" viewBox="0 0 24 24"><path d="M7 18c-1.1 0-1.99.9-1.99 2S5.9 22 7 22s2-.9 2-2-.9-2-2-2zM1 2v2h2l3.6 7.59-1.35 2.45c-.16.28-.25.61-.25.96 0 1.1.9 2 2 2h12v-2H7.42c-.14 0-.25-.11-.25-.25l.03-.12.9-1.63h7.45c.75 0 1.41-.41 1.75-1.03l3.58-6.49c.08-.14.12-.31.12-.48 0-.55-.45-1-1-1H5.21l-.94-2H1zm16 16c-1.1 0-1.99.9-1.99 2s.89 2 1.99 2 2-.9 2-2-.9-2-2-2z"/></svg>
                            Browse Merchandise
                        </a>
                        <a href="{{ route('contact.index') }}" class="btn btn-secondary" style="display:inline-flex; gap: 0.5rem; text-decoration:none;">
                            <svg width="18" height="18" fill="currentColor" viewBox="0 0 24 24"><path d="M20 2H4c-1.1 0-1.99.9-1.99 2L2 22l4-4h14c1.1 0 2-.9 2-2V4c0-1.1-.9-2-2-2z"/></svg>
                            Contact Team
                        </a>
                    </div>
                </article>
            @endforelse
        </div>
    </section>

    @if($officers->isNotEmpty())
        <section class="store-section" style="padding-top: 0;">
            <div class="store-shell">
                <div style="background: #fff; border: 1px solid var(--color-gray-200); border-radius: 1rem; padding: 1.7rem; box-shadow: var(--shadow-sm);">
                    <div class="premium-section-head" style="margin-bottom: 1.3rem;">
                        <div>
                            <p class="premium-kicker">Officer Directory</p>
                            <h2 class="h2" style="margin: 0;">Support Contacts</h2>
                        </div>
                        <p>For custom requests and complex files, message an officer directly for faster assistance.</p>
                    </div>

                    <div class="services-officer-grid" style="display: grid; gap: 1rem;">
                        @foreach($officers as $officer)
                            @php
                                $displayName = $officer->name ?? ($officer->user?->name ?? 'Team Member');
                                $displayRole = $officer->title ?? ($officer->role ?? 'Officer');
                                $messengerUrl = $officer->social_links['messenger'] ?? null;
                                $avatarUrl = $officer->avatar_url ?? ($officer->user?->avatar_url ?? null);
                            @endphp
                            <article class="services-officer-card" style="border: 1px solid var(--color-gray-200); background: var(--color-gray-50); border-radius: 0.9rem; padding: 1rem;">
                                <div class="services-officer-head" style="display: flex; align-items: center; gap: 0.9rem;">
                                    <div class="loading-skeleton-wrap" style="width: 56px; height: 56px; border-radius: 50%; position: relative; overflow: hidden; flex-shrink: 0;">
                                        <div class="loading-skeleton loading-skeleton--avatar" style="position:absolute; inset: 0;"></div>
                                        <img src="{{ $avatarUrl && str_starts_with($avatarUrl, 'http') ? $avatarUrl : asset('images/cict-logo.webp') }}" alt="{{ $displayName }}" style="width: 56px; height: 56px; border-radius: 50%; border: 2px solid var(--color-gold); object-fit: cover; position: relative; z-index: 1;" loading="lazy" onerror="this.onerror=null; this.src='{{ asset('images/cict-logo.webp') }}';">
                                    </div>
                                    <div class="services-officer-meta" style="min-width: 0; flex: 1;">
                                        <p class="services-officer-name" style="font-weight: 700; color: var(--color-gray-900); margin: 0; white-space: nowrap; overflow: hidden; text-overflow: ellipsis;">{{ $displayName }}</p>
                                        <p class="services-officer-rank" style="font-size: 0.875rem; color: var(--color-gray-600); margin: 0.2rem 0 0 0; white-space: nowrap; overflow: hidden; text-overflow: ellipsis;">{{ $displayRole }}</p>
                                    </div>
                                </div>

                                @if($messengerUrl)
                                    <a href="{{ $messengerUrl }}" target="_blank" rel="noopener noreferrer" class="btn btn-secondary" style="margin-top: 0.9rem; width: 100%; justify-content: center; gap: 0.45rem;">
                                        Message Officer
                                    </a>
                                @endif
                            </article>
                        @endforeach
                    </div>
                </div>
            </div>
        </section>
    @endif

</x-app-layout>
