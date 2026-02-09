<x-app-layout>
    @section('title', 'Shop - ' . config('app.name', 'CICT Dingle'))

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
        .shop-hero {
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
            .shop-hero {
                min-height: 55vh;
                padding-top: 140px;
                padding-bottom: 40px;
            }

            .shop-hero-content {
                margin-top: 60px;
            }
        }

        .shop-hero::before {
            content: '';
            position: absolute;
            inset: 0;
            background: url('{{ asset("images/cict_hero_bg.webp") }}') center/cover;
            opacity: 0.15;
        }

        .shop-hero-content {
            position: relative;
            z-index: 10;
            max-width: 700px;
        }

        .shop-hero-badge {
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

        .shop-hero-title {
            font-size: clamp(32px, 5vw, 48px);
            font-weight: 800;
            color: #fff;
            line-height: 1.1;
            margin-bottom: 16px;
            letter-spacing: -1px;
        }

        .shop-hero-subtitle {
            font-size: clamp(14px, 2vw, 18px);
            color: rgba(255, 255, 255, 0.9);
            line-height: 1.5;
        }

        /* ============ MAIN CONTENT ============ */
        .shop-content {
            background: var(--bg-secondary);
            padding: 60px 24px 80px;
            min-height: 60vh;
        }

        .shop-container {
            max-width: 1200px;
            margin: 0 auto;
        }

        /* ============ HEADER ============ */
        .shop-header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 32px;
            padding-bottom: 20px;
            border-bottom: 1px solid var(--border);
            flex-wrap: wrap;
            gap: 16px;
        }

        .shop-header-left h2 {
            font-size: 24px;
            font-weight: 700;
            color: var(--text-primary);
            margin: 0 0 4px 0;
        }

        .shop-header-left p {
            font-size: 14px;
            color: var(--text-secondary);
            margin: 0;
        }

        /* ============ PRODUCT GRID ============ */
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
        }

        /* ============ PRODUCT CARD ============ */
        .product-card {
            background: var(--bg-primary);
            border: 1px solid var(--border);
            border-radius: var(--radius-lg);
            overflow: hidden;
            transition: all 0.3s ease;
            display: flex;
            flex-direction: column;
            text-decoration: none;
            position: relative;
        }

        .product-card:hover {
            transform: translateY(-8px);
            box-shadow: var(--shadow-xl);
        }

        .product-badge {
            position: absolute;
            top: 12px;
            left: 12px;
            padding: 6px 12px;
            background: var(--primary);
            color: #fff;
            font-size: 11px;
            font-weight: 600;
            border-radius: var(--radius-sm);
            z-index: 5;
        }

        .product-badge.warning {
            background: #F59E0B;
        }

        .product-badge.danger {
            background: #DC2626;
        }

        .product-image {
            aspect-ratio: 1/1;
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

        .product-image-placeholder {
            width: 100%;
            height: 100%;
            display: flex;
            align-items: center;
            justify-content: center;
            color: var(--text-secondary);
            font-size: 13px;
        }

        .product-info {
            padding: 16px;
            flex: 1;
            display: flex;
            flex-direction: column;
        }

        .product-title {
            font-size: 14px;
            font-weight: 600;
            color: var(--text-primary);
            margin-bottom: 8px;
            line-height: 1.4;
            display: -webkit-box;
            -webkit-line-clamp: 2;
            -webkit-box-orient: vertical;
            overflow: hidden;
        }

        .product-description {
            font-size: 12px;
            color: var(--text-secondary);
            line-height: 1.5;
            margin-bottom: 12px;
            display: -webkit-box;
            -webkit-line-clamp: 2;
            -webkit-box-orient: vertical;
            overflow: hidden;
        }

        .product-price {
            font-size: 18px;
            font-weight: 700;
            color: var(--primary);
            margin-top: auto;
            margin-bottom: 12px;
        }

        .product-btn {
            display: block;
            width: 100%;
            padding: 12px;
            background: var(--primary);
            color: #fff;
            font-size: 13px;
            font-weight: 600;
            text-align: center;
            border-radius: var(--radius-sm);
            transition: background 0.2s ease;
        }

        .product-btn:hover {
            background: var(--primary-hover);
        }

        /* ============ PAGINATION ============ */
        .pagination-wrapper {
            margin-top: 48px;
            display: flex;
            justify-content: center;
        }

        .pagination-wrapper nav {
            background: var(--bg-primary);
            border-radius: var(--radius-md);
            padding: 12px 16px;
            box-shadow: var(--shadow-sm);
        }

        /* ============ EMPTY STATE ============ */
        .empty-state {
            text-align: center;
            padding: 80px 24px;
        }

        .empty-state-icon {
            font-size: 64px;
            margin-bottom: 16px;
        }

        .empty-state-title {
            font-size: 20px;
            font-weight: 600;
            color: var(--text-primary);
            margin-bottom: 8px;
        }

        .empty-state-text {
            font-size: 14px;
            color: var(--text-secondary);
        }

        /* ============ MOBILE ADJUSTMENTS ============ */
        @media (max-width: 640px) {
            .shop-hero {
                min-height: 35vh;
                padding: 120px 16px 40px;
            }

            .shop-hero-title {
                font-size: 26px;
            }

            .shop-hero-subtitle {
                font-size: 13px;
            }

            .shop-content {
                padding: 32px 12px 60px;
            }

            .products-grid {
                gap: 10px;
            }

            .product-card {
                border-radius: 12px;
            }

            .product-image {
                aspect-ratio: 1/1;
            }

            .product-info {
                padding: 10px;
            }

            .product-title {
                font-size: 12px;
                margin-bottom: 4px;
                -webkit-line-clamp: 2;
            }

            .product-description {
                display: none;
            }

            .product-price {
                font-size: 14px;
                margin-bottom: 8px;
            }

            .product-btn {
                padding: 8px;
                font-size: 11px;
                border-radius: 6px;
            }

            .product-badge {
                top: 8px;
                left: 8px;
                padding: 4px 8px;
                font-size: 9px;
            }

            .shop-header {
                margin-bottom: 20px;
                padding-bottom: 16px;
            }

            .shop-header-left h2 {
                font-size: 20px;
            }

            .shop-header-left p {
                font-size: 13px;
            }
        }
    </style>

    <!-- Hero Section -->
    <section class="shop-hero">
        <div class="shop-hero-content">
            <div class="shop-hero-badge">
                <span>🛍️</span>
                <span>CICT Student Council Store</span>
            </div>
            <h1 class="shop-hero-title gsap-hero-title">Shop Merchandise</h1>
            <p class="shop-hero-subtitle gsap-hero-subtitle">
                Browse our collection of premium campus merchandise. Every purchase supports student initiatives.
            </p>
        </div>
    </section>

    <!-- Products Section -->
    <div class="shop-content">
        <div class="shop-container">
            @if($products->count() > 0)
                <div class="shop-header">
                    <div class="shop-header-left">
                        <h2>All Products</h2>
                        <p>{{ $products->total() }} items available</p>
                    </div>
                </div>

                <div class="products-grid">
                    @foreach($products as $product)
                        @php
                            $stock = $product->current_stock;
                            $isLowStock = $stock > 0 && $stock <= $product->low_stock_threshold;
                            $isOutOfStock = $stock == 0;
                        @endphp
                        <a href="{{ route('shop.show', $product->slug) }}" class="product-card reveal-on-scroll">
                            {{-- Custom promotional badge (e.g., Christmas, Valentine) --}}
                            @if($product->badge_text)
                                <span class="product-badge"
                                    style="background: {{ $product->badge_color ?? '#8B0000' }}; top: 12px; right: 12px; left: auto;">{{ $product->badge_text }}</span>
                            @endif

                            {{-- Stock status badges --}}
                            @if($isOutOfStock)
                                <span class="product-badge danger">Out of Stock</span>
                            @elseif($isLowStock)
                                <span class="product-badge warning">Only {{ $stock }} left</span>
                            @endif

                            <div class="product-image">
                                @if(!empty($product->image_url))
                                    <img src="{{ $product->image_url }}" 
                                         alt="{{ $product->name }}" 
                                         loading="lazy" 
                                         decoding="async"
                                         width="400"
                                         height="400">
                                @else
                                    <div class="product-image-placeholder">No Image</div>
                                @endif
                            </div>

                            <div class="product-info">
                                <h3 class="product-title">{{ $product->name }}</h3>
                                <p class="product-description">{{ Str::limit($product->description, 60) }}</p>
                                <div class="product-price">
                                    @php
                                        $firstVariant = \App\Models\ProductVariant::where('product_id', $product->id)
                                            ->where('status', 'active')
                                            ->orderBy('price_modifier', 'asc')
                                            ->first();

                                        $displayPrice = $firstVariant
                                            ? $product->base_price + $firstVariant->price_modifier
                                            : $product->base_price;
                                    @endphp
                                    ₱{{ number_format($displayPrice, 0) }}
                                </div>
                                <span class="product-btn">View Details</span>
                            </div>
                        </a>
                    @endforeach
                </div>

                @if($products->hasPages())
                    <div class="pagination-wrapper">
                        {{ $products->links() }}
                    </div>
                @endif
            @else
                <div class="empty-state">
                    <div class="empty-state-icon">🛒</div>
                    <h3 class="empty-state-title">No Products Available</h3>
                    <p class="empty-state-text">Check back soon for new items!</p>
                </div>
            @endif
        </div>
    </div>

</x-app-layout>