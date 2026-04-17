<x-app-layout :title="$service->title . ' | ISUFST CICT Dingle Campus'"
    :meta_description="'View service options, dimensions, and pricing for ' . $service->title . ' at ISUFST CICT Dingle Campus.'">

    @php
        $iconKey = (function ($item) {
            $text = \Illuminate\Support\Str::lower(($item->title ?? '') . ' ' . ($item->category ?? ''));

            if (str_contains($text, 'photo') || str_contains($text, 'image') || str_contains($text, 'id')) {
                return 'camera';
            }
            if (str_contains($text, 'design') || str_contains($text, 'layout') || str_contains($text, 'logo')) {
                return 'pen';
            }
            if (str_contains($text, 'scan') || str_contains($text, 'print') || str_contains($text, 'copy') || str_contains($text, 'document')) {
                return 'document';
            }
            if (str_contains($text, 'binding') || str_contains($text, 'laminate') || str_contains($text, 'finish')) {
                return 'layers';
            }

            return 'spark';
        })($service);
    @endphp

    <div style="height: 110px; background: linear-gradient(135deg, #8B0000 0%, #A00000 40%, #6B0000 100%); position: relative; overflow: hidden;">
        <div style="position: absolute; inset: 0; opacity: 0.1; background-image: radial-gradient(rgba(255,255,255,0.2) 1px, transparent 1px); background-size: 26px 26px;"></div>
    </div>

    <section style="background: var(--color-gray-50); min-height: 100vh;">
        <div class="premium-detail-shell">
            <div style="margin-bottom: 1rem;">
                <a href="{{ route('services.index') }}" class="btn btn-secondary" style="gap: 0.45rem;">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" style="width: 1rem; height: 1rem;">
                        <path d="M15 6 9 12l6 6"></path>
                    </svg>
                    Back to services
                </a>
            </div>

            <div class="premium-detail-hero" style="margin-bottom: 1.4rem;">
                <div class="premium-detail-head">
                    <span class="premium-icon-wrap" aria-hidden="true">
                        @switch($iconKey)
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
                    <div>
                        <p class="premium-inline-meta" style="margin-bottom: 0.22rem;">{{ $service->category ?? 'General' }}</p>
                        <h1 class="premium-detail-title">{{ $service->title }}</h1>
                    </div>
                </div>
                <p class="premium-muted">{{ $service->description }}</p>
            </div>

            @if($options->count())
                <div class="premium-section-head" style="margin-bottom: 1rem;">
                    <div>
                        <p class="premium-kicker">Service matrix</p>
                        <h2 class="h2" style="margin: 0;">Options & Variants</h2>
                    </div>
                </div>

                <div class="premium-option-grid">
                    @foreach($options as $option)
                        <article style="border-radius: 1rem; border: 1px solid #e9edf3; background: #fff; box-shadow: 0 14px 26px rgba(16,24,40,0.07); padding: 1.1rem; display: grid; gap: 0.95rem;">
                            <div>
                                @if($option->badge)
                                    <span class="premium-inline-meta" style="margin-bottom: 0.45rem;">{{ $option->badge }}</span>
                                @endif
                                <h3 style="margin: 0; font-size: 1.15rem; color: #1f2937; line-height: 1.35;">{{ $option->name }}</h3>
                                @if($option->dimensions)
                                    <p style="margin: 0.35rem 0 0; color: var(--color-gray-600); font-size: 0.85rem;">{{ $option->dimensions }}</p>
                                @endif
                            </div>

                            <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 0.7rem; margin-top: auto;">
                                <div style="background: #f9fafc; border: 1px solid #e7eaf0; border-radius: 0.75rem; padding: 0.8rem;">
                                    <p style="margin: 0 0 0.2rem; font-size: 0.72rem; font-weight: 800; letter-spacing: 0.08em; color: var(--color-gray-600); text-transform: uppercase;">{{ $option->price_primary_label ?? 'Primary' }}</p>
                                    <p style="margin: 0; font-size: 1.08rem; font-weight: 800; color: var(--color-maroon);">{{ $option->price_primary ? 'P' . number_format($option->price_primary, 2) : '—' }}</p>
                                </div>
                                <div style="background: #f9fafc; border: 1px solid #e7eaf0; border-radius: 0.75rem; padding: 0.8rem;">
                                    <p style="margin: 0 0 0.2rem; font-size: 0.72rem; font-weight: 800; letter-spacing: 0.08em; color: var(--color-gray-600); text-transform: uppercase;">{{ $option->price_secondary_label ?? 'Secondary' }}</p>
                                    <p style="margin: 0; font-size: 1.08rem; font-weight: 800; color: var(--color-maroon);">{{ $option->price_secondary ? 'P' . number_format($option->price_secondary, 2) : '—' }}</p>
                                </div>
                            </div>
                        </article>
                    @endforeach
                </div>
            @endif
        </div>
    </section>

</x-app-layout>