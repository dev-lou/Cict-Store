<x-app-layout :title="'Shop | ISUFST CICT Dingle Campus'"
    :meta_description="'Browse official ISUFST CICT Dingle Campus merchandise with a cleaner premium storefront and student-first support.'">

    <section class="store-section store-section-soft store-hero-section" style="padding: clamp(7rem, 12vw, 9rem) 1.5rem 2rem;">
        <div class="store-shell">
            <div class="editorial-hero">
                <div class="editorial-hero-glow" aria-hidden="true"></div>
                <div class="editorial-hero-grid" style="display: grid; grid-template-columns: minmax(0, 1.12fr) minmax(280px, 0.88fr); gap: 1.5rem; align-items: center; position: relative; z-index: 1;">
                    <div>
                        <div class="editorial-eyebrow" style="display: inline-flex; align-items: center; gap: 0.55rem; width: fit-content; padding: 0.55rem 0.95rem; border-radius: 9999px; background: rgba(255,255,255,0.12); border: 1px solid rgba(255,255,255,0.18); color: white; font-size: 0.76rem; font-weight: 800; letter-spacing: 0.12em; text-transform: uppercase;">
                            <span style="width: 0.45rem; height: 0.45rem; border-radius: 9999px; background: #f4c15a; box-shadow: 0 0 0 4px rgba(244,193,90,0.18);"></span>
                            Official Campus Store
                        </div>
                        <h1 class="editorial-title" style="color: white; text-shadow: 0 4px 14px rgba(0, 0, 0, 0.14); font-size: clamp(2.8rem, 6vw, 5rem); line-height: 0.95; letter-spacing: -0.05em; margin: 1rem 0 0 0; max-width: 14ch;">Shop CICT Merchandise.</h1>
                        <p class="editorial-subtitle" style="margin: 1rem 0 0 0; color: rgba(255,255,255,0.95); font-size: clamp(1rem, 2.2vw, 1.2rem); line-height: 1.65; max-width: 40rem; font-weight: 500;">Modern campus gear with a cleaner buying flow, clearer pricing, and the same student-led support.</p>
                        <div class="editorial-chips" style="display: flex; flex-wrap: wrap; gap: 0.65rem; margin-top: 1.2rem;">
                            <span class="editorial-chip" style="padding: 0.55rem 0.8rem; border-radius: 9999px; background: rgba(255,255,255,0.09); border: 1px solid rgba(255,255,255,0.15); color: rgba(255,255,255,0.92); font-size: 0.8rem; font-weight: 700;">Student Support</span>
                            <span class="editorial-chip" style="padding: 0.55rem 0.8rem; border-radius: 9999px; background: rgba(255,255,255,0.09); border: 1px solid rgba(255,255,255,0.15); color: rgba(255,255,255,0.92); font-size: 0.8rem; font-weight: 700;">Campus Pickup</span>
                            <span class="editorial-chip editorial-chip--mobile-hide" style="padding: 0.55rem 0.8rem; border-radius: 9999px; background: rgba(255,255,255,0.09); border: 1px solid rgba(255,255,255,0.15); color: rgba(255,255,255,0.92); font-size: 0.8rem; font-weight: 700;">Official Merchandise</span>
                        </div>
                    </div>
                    <div class="editorial-panel" style="position: relative; overflow: hidden; border-radius: 2rem; padding: 2rem; background: linear-gradient(135deg, rgba(255,255,255,0.12) 0%, rgba(255,255,255,0.06) 100%); border: 1px solid rgba(255,255,255,0.18); backdrop-filter: blur(20px); color: white; box-shadow: 0 24px 48px rgba(0,0,0,0.22), 0 0 1px rgba(255,255,255,0.08) inset;">
                        <p style="margin: 0 0 0.5rem 0; font-size: 0.7rem; font-weight: 900; text-transform: uppercase; letter-spacing: 0.16em; color: rgba(244,193,90,0.95);">Premium Checkout</p>
                        <h3 style="margin: 0 0 1rem 0; font-size: 1.6rem; line-height: 1.15; letter-spacing: -0.03em; color: white; font-weight: 800;">Built for quick checkout</h3>
                        <p style="margin: 0; color: rgba(255,255,255,0.92); line-height: 1.8; font-size: 1rem;">From product discovery to order confirmation, the catalog is tuned for a more premium and trustworthy shopping experience.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="store-section store-section-soft" style="padding-top: 1.8rem; min-height: 60vh;">
        <div class="store-shell">
            @if($products->count() > 0)
                <div class="premium-section-head">
                    <div>
                        <p class="premium-kicker">Catalog</p>
                        <h2 class="h2" style="margin: 0;">All Products</h2>
                    </div>
                    <p>{{ $products->total() }} items available with variant pricing and stock-aware listing.</p>
                </div>

                <div class="premium-shop-grid">
                    @foreach($products as $product)
                        @php
                            $stock = $product->current_stock;
                            $isLowStock = $stock > 0 && $stock <= $product->low_stock_threshold;
                            $isOutOfStock = $stock == 0;
                            $firstVariant = \App\Models\ProductVariant::where('product_id', $product->id)
                                ->where('status', 'active')
                                ->orderBy('price_modifier', 'asc')
                                ->first();
                            $displayPrice = $firstVariant
                                ? $product->base_price + $firstVariant->price_modifier
                                : $product->base_price;
                        @endphp
                        <a href="{{ route('shop.show', $product->slug) }}" class="premium-product-card">
                            <div class="premium-product-media">
                                <div class="premium-badge-row">
                                    <span class="premium-badge premium-badge-sale">Sale</span>
                                    <span class="premium-badge premium-badge-new">New</span>
                                </div>
                                @if(!empty($product->image_url))
                                    <div class="loading-skeleton-wrap" style="position:absolute; inset: 0; border-radius: 1rem; overflow: hidden;">
                                        <div class="loading-skeleton loading-skeleton--image" style="position:absolute; inset: 0;"></div>
                                        <img src="{{ $product->image_url }}" alt="{{ $product->name }}" loading="lazy" decoding="async" width="320" height="420">
                                    </div>
                                @else
                                    <div style="font-size: 0.82rem; color: var(--color-gray-400);">No image</div>
                                @endif
                            </div>
                            <h3 class="premium-product-name">{{ $product->name }}</h3>
                            <div class="premium-price-row">
                                <p class="premium-product-price">P{{ number_format($displayPrice, 0) }}</p>
                                <span class="premium-stock-note">
                                    @if($isOutOfStock)
                                        Out
                                    @elseif($isLowStock)
                                        Low
                                    @else
                                        Ready
                                    @endif
                                </span>
                            </div>
                            <div class="premium-product-footer">
                                <span class="premium-action">
                                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" aria-hidden="true">
                                        <circle cx="9" cy="20" r="1.4"></circle>
                                        <circle cx="17" cy="20" r="1.4"></circle>
                                        <path d="M2.8 4h2.1l2.1 10.4a1 1 0 0 0 1 .8h9.7a1 1 0 0 0 1-.74L21 7H6.4"></path>
                                    </svg>
                                    Add to cart
                                </span>
                                <svg class="premium-arrow" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" aria-hidden="true">
                                    <path d="M7 17 17 7"></path>
                                    <path d="M8 7h9v9"></path>
                                </svg>
                            </div>
                        </a>
                    @endforeach
                </div>

                @if($products->hasPages())
                    <div style="margin-top: 2.5rem; display: flex; justify-content: center;">
                        <nav style="background: var(--color-white); border-radius: var(--radius-md); padding: 0.75rem 1rem; box-shadow: var(--shadow-sm);">
                            {{ $products->links() }}
                        </nav>
                    </div>
                @endif
            @else
                <div style="text-align: center; padding: 4.5rem 1rem; background: linear-gradient(180deg, #ffffff 0%, #f8fafc 100%); border: 1px solid var(--color-gray-200); border-radius: 1.25rem; box-shadow: var(--shadow-sm); max-width: 760px; margin: 0 auto;">
                    <div style="width: 4.5rem; height: 4.5rem; margin: 0 auto 1rem; border-radius: 9999px; background: rgba(139,0,0,0.08); color: var(--color-maroon); display:flex; align-items:center; justify-content:center; font-size: 1.6rem;">🛍️</div>
                    <h3 class="h3" style="margin-bottom: 0.55rem;">No Products Available</h3>
                    <p style="margin: 0 auto 1.25rem; color: var(--color-gray-600); max-width: 32rem; line-height: 1.7;">Check back soon for new arrivals, or use the services section while the catalog is being updated.</p>
                    <a href="{{ route('services.index') }}" class="btn btn-primary" style="display:inline-flex; gap: 0.5rem; text-decoration:none;">
                        View Services
                    </a>
                </div>
            @endif
        </div>
    </section>

</x-app-layout>
