<x-app-layout>
    @section('title', $service->title . ' - CICT Merch')

    <!-- Decorative Red Header Banner (Behind Navbar) -->
    <div
        style="position: absolute; top: 0; left: 0; right: 0; height: 100px; background: linear-gradient(135deg, #8B0000 0%, #A00000 40%, #6B0000 100%); z-index: 0; overflow: hidden;">
        <!-- Decorative Pattern Overlay -->
        <div style="position: absolute; inset: 0; opacity: 0.1; background-image: url('data:image/svg+xml,%3Csvg width=\"
            60\" height=\"60\" viewBox=\"0 0 60 60\" xmlns=\"http://www.w3.org/2000/svg\"%3E%3Cg fill=\"none\"
            fill-rule=\"evenodd\"%3E%3Cg fill=\"%23ffffff\" fill-opacity=\"1\"%3E%3Cpath d=\"M36
            34v-4h-2v4h-4v2h4v4h2v-4h4v-2h-4zm0-30V0h-2v4h-4v2h4v4h2V6h4V4h-4zM6 34v-4H4v4H0v2h4v4h2v-4h4v-2H6zM6
            4V0H4v4H0v2h4v4h2V6h4V4H6z\"/%3E%3C/g%3E%3C/g%3E%3C/svg%3E');"></div>
        <!-- Decorative Circles -->
        <div
            style="position: absolute; top: -20px; right: -20px; width: 80px; height: 80px; background: rgba(255,255,255,0.05); border-radius: 50%;">
        </div>
        <div
            style="position: absolute; top: 20px; right: 80px; width: 40px; height: 40px; background: rgba(255,255,255,0.03); border-radius: 50%;">
        </div>
        <div
            style="position: absolute; top: 5px; left: 10%; width: 60px; height: 60px; background: rgba(255,255,255,0.04); border-radius: 50%;">
        </div>
    </div>

    <div style="position: relative; z-index: 1;">
        <style>
            body {
                background: #F9FAFB !important;
            }

            h1,
            h2,
            h3,
            h4,
            h5,
            h6 {
                font-family: 'Poppins', sans-serif;
            }

            .page-shell {
                max-width: 1200px;
                margin: 0 auto;
                padding: 115px 32px 80px;
            }

            @media (max-width: 768px) {
                .page-shell {
                    padding: 105px 20px 60px;
                }
            }

            .options-grid {
                display: grid;
                grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
                gap: 24px;
                align-items: stretch;
            }

            .card {
                background: #FFFFFF;
                border: 2px solid #F0F0F0;
                border-radius: 20px;
                box-shadow: 0 12px 40px rgba(15, 23, 42, 0.08),
                    0 4px 12px rgba(139, 0, 0, 0.04),
                    inset 0 1px 0 rgba(255, 255, 255, 0.9);
                padding: 36px;
                transition: all 0.3s ease;
            }

            .card:hover {
                box-shadow: 0 20px 50px rgba(15, 23, 42, 0.12),
                    0 8px 20px rgba(139, 0, 0, 0.08);
                transform: translateY(-4px);
            }

            .paper-card {
                background: #FFFFFF;
                border: 2px solid #F0F0F0;
                border-radius: 16px;
                box-shadow: 0 8px 24px rgba(15, 23, 42, 0.06),
                    inset 0 1px 0 rgba(255, 255, 255, 0.8);
                text-align: center;
                transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
                position: relative;
                display: flex;
                flex-direction: column;
                justify-content: space-between;
                overflow: hidden;
            }

            .paper-card::before {
                content: '';
                position: absolute;
                inset: 0;
                border-radius: 16px;
                padding: 2px;
                background: linear-gradient(135deg, #8B0000, #FFD700, #8B0000);
                -webkit-mask: linear-gradient(#fff 0 0) content-box, linear-gradient(#fff 0 0);
                -webkit-mask-composite: xor;
                mask-composite: exclude;
                opacity: 0;
                transition: opacity 0.4s ease;
            }

            .paper-card:hover::before {
                opacity: 1;
            }

            .paper-card.short {
                height: 320px;
                padding: 28px 32px;
            }

            .paper-card.standard {
                height: 440px;
                padding: 44px 32px;
            }

            .paper-card.long {
                height: 560px;
                padding: 60px 32px;
            }

            .paper-card:hover {
                box-shadow: 0 20px 50px rgba(139, 0, 0, 0.15),
                    0 10px 30px rgba(15, 23, 42, 0.1);
                transform: translateY(-8px) scale(1.02);
                border-color: transparent;
            }

            .paper-card h4 {
                color: #1E293B;
                font-weight: 800;
                margin: 0 0 16px;
                letter-spacing: -0.5px;
            }

            .paper-card.short h4 {
                font-size: 1.75rem;
            }

            .paper-card.standard h4 {
                font-size: 2.4rem;
            }

            .paper-card.long h4 {
                font-size: 3rem;
            }

            .paper-badge {
                display: inline-block;
                background: linear-gradient(135deg, #FCEEEF, #FEF3F2);
                color: #8B0000;
                padding: 8px 16px;
                border-radius: 10px;
                font-size: 12px;
                font-weight: 800;
                margin-bottom: 16px;
                text-transform: uppercase;
                letter-spacing: 0.6px;
                border: 2px solid rgba(139, 0, 0, 0.15);
                box-shadow: 0 4px 12px rgba(139, 0, 0, 0.1);
            }

            .paper-card-dims {
                color: #888;
                font-size: 13px;
                margin-bottom: 24px;
                font-weight: 500;
            }

            .price-grid {
                display: grid;
                grid-template-columns: 1fr 1fr;
                gap: 16px;
                margin-top: auto;
            }

            .price-item {
                background: linear-gradient(135deg, #F7F8FB 0%, #FFFFFF 100%);
                padding: 20px 18px;
                border-radius: 12px;
                border: 2px solid #E8EBF0;
                transition: all 0.35s cubic-bezier(0.4, 0, 0.2, 1);
                display: flex;
                flex-direction: column;
                justify-content: center;
                min-height: 90px;
                position: relative;
                overflow: hidden;
            }

            .price-item::before {
                content: '';
                position: absolute;
                inset: 0;
                background: linear-gradient(135deg, #8B0000 0%, #A00000 100%);
                opacity: 0;
                transition: opacity 0.35s ease;
            }

            .price-item:hover::before {
                opacity: 1;
            }

            .price-item>* {
                position: relative;
                z-index: 1;
            }

            .price-item-label {
                font-size: 12px;
                color: #667085;
                margin-bottom: 10px;
                font-weight: 700;
                text-transform: uppercase;
                letter-spacing: 0.5px;
                transition: color 0.35s ease;
            }

            .price-item:hover .price-item-label {
                color: rgba(255, 255, 255, 0.9);
            }

            .price-item-value {
                color: #8B0000;
                font-weight: 900;
                font-size: 22px;
                letter-spacing: -0.5px;
                transition: color 0.35s ease;
            }

            .price-item:hover .price-item-value {
                color: #FFFFFF;
            }

            .back-link {
                color: #8B0000;
                font-weight: 700;
                display: inline-flex;
                align-items: center;
                gap: 8px;
                padding: 10px 18px;
                border-radius: 10px;
                background: #FFFFFF;
                border: 2px solid #F0F0F0;
                transition: all 0.3s ease;
                text-decoration: none;
                box-shadow: 0 4px 12px rgba(0, 0, 0, 0.05);
            }

            .back-link:hover {
                background: #8B0000;
                color: #FFFFFF;
                border-color: #8B0000;
                transform: translateX(-4px);
                box-shadow: 0 8px 20px rgba(139, 0, 0, 0.15);
            }
        </style>

        <div class="page-shell">
            <div style="margin-bottom: 24px;">
                <a href="{{ route('services.index') }}" class="back-link">
                    <svg width="16" height="16" viewBox="0 0 16 16" fill="currentColor">
                        <path d="M10 12L6 8l4-4" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                            stroke-linejoin="round" fill="none" />
                    </svg>
                    Back to services
                </a>
            </div>

            <div class="card" style="margin-bottom: 40px; display:flex; flex-direction:column; gap:18px;">
                <div style="display:flex; align-items:center; gap:18px; flex-wrap:wrap;">
                    <div
                        style="width:64px; height:64px; border-radius:16px; background:linear-gradient(135deg,#8B0000 0%,#A00000 100%); color:#fff; display:grid; place-items:center; font-size:32px; box-shadow: 0 8px 20px rgba(139, 0, 0, 0.25);">
                        {{ $service->icon ?? '🖨️' }}</div>
                    <div>
                        <h1 style="margin:0; font-size:2rem; font-weight:900; color:#1E293B; letter-spacing:-0.5px;">
                            {{ $service->title }}</h1>
                        <div style="color:#667085; font-size:15px; font-weight:600; margin-top:4px;">
                            {{ $service->category ?? 'General' }}</div>
                    </div>
                </div>
                <p style="margin:0; color:#475569; line-height:1.7; font-size:15.5px; font-weight:500;">
                    {{ $service->description }}</p>
            </div>

            @if($options->count())
                <div
                    style="margin-bottom:32px; display:flex; align-items:center; justify-content:space-between; gap:12px; flex-wrap:wrap;">
                    <div>
                        <h2 style="margin:0; font-size:1.75rem; font-weight:900; color:#1E293B; letter-spacing:-0.5px;">
                            Options & Variants</h2>

                    </div>
                </div>
                <div class="options-grid">
                    @foreach($options as $option)
                        <div class="paper-card {{ $option->size_class ?? 'standard' }}">
                            @if($option->badge)
                                <span class="paper-badge">{{ $option->badge }}</span>
                            @endif
                            <h4 style="margin:0; font-weight:800; font-size:1.25rem; color:#1a1a1a;">{{ $option->name }}</h4>
                            @if($option->dimensions)
                                <div class="paper-card-dims">{{ $option->dimensions }}</div>
                            @endif
                            <div class="price-grid">
                                <div class="price-item">
                                    <div class="price-item-label">{{ $option->price_primary_label ?? 'Primary' }}</div>
                                    <div class="price-item-value">
                                        {{ $option->price_primary ? '₱' . number_format($option->price_primary, 2) : '—' }}</div>
                                </div>
                                <div class="price-item">
                                    <div class="price-item-label">{{ $option->price_secondary_label ?? 'Secondary' }}</div>
                                    <div class="price-item-value">
                                        {{ $option->price_secondary ? '₱' . number_format($option->price_secondary, 2) : '—' }}</div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            @endif
        </div>
    </div>
</x-app-layout>