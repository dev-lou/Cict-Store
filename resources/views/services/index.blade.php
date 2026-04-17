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

    <section class="store-section store-section-soft store-hero-section">
        <div class="store-shell">
            <div class="editorial-hero">
                <div class="editorial-hero-glow" aria-hidden="true"></div>
                <div class="editorial-hero-grid">
                    <div>
                        <div class="editorial-eyebrow">
                            <span style="width: 0.42rem; height: 0.42rem; border-radius: 9999px; background: #f4c15a;"></span>
                            Digital Service Hub
                        </div>
                        <h1 class="editorial-title">Campus Services, Reframed.</h1>
                        <p class="editorial-subtitle">Premium service presentation with cleaner options, clearer pricing, and direct support for students and campus organizations.</p>
                        <div class="editorial-chips">
                            <span class="editorial-chip">Officer Support</span>
                            <span class="editorial-chip">Transparent Pricing</span>
                            <span class="editorial-chip editorial-chip--mobile-hide">Fast Turnaround</span>
                        </div>
                    </div>
                    <div class="editorial-panel">
                        <h3>Built for real campus workflows</h3>
                        <p>From document tasks to digital requests, each service is organized to reduce confusion and move requests faster.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="store-section store-section-soft" style="padding-top: 1.8rem;">
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
                            @endphp
                            <a href="{{ route('services.show', $service->slug) }}" class="premium-service-card">
                                <div class="premium-service-head">
                                    <span class="premium-icon-wrap" aria-hidden="true">
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
                <article style="border-radius: 1rem; border: 1px solid var(--color-gray-200); background: linear-gradient(180deg, #ffffff 0%, #f8fafc 100%); padding: 2.2rem 1.5rem; text-align: center; color: var(--color-gray-600); box-shadow: var(--shadow-sm);">
                    <div style="width: 4.25rem; height: 4.25rem; margin: 0 auto 1rem; border-radius: 9999px; background: rgba(244,193,90,0.18); color: #8b0000; display:flex; align-items:center; justify-content:center; font-size: 1.5rem;">✦</div>
                    <h3 class="h3" style="margin-bottom: 0.55rem;">Services will appear here soon.</h3>
                    <p style="margin: 0 auto; max-width: 30rem; line-height: 1.7;">Once the catalog is updated, you’ll be able to browse document tasks, design requests, and office support from this page.</p>
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
