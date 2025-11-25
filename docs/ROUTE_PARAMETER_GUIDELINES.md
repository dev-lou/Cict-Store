# Route parameter guidelines and audit checklist

Purpose
- Prevent runtime UrlGenerationException caused by calling named routes that require URL parameters without passing them. These often show up as `Missing required parameter for [Route: name]` and cause 500 responses in production.

Key rules
1. Always pass required route parameters when using the `route()` helper.
   - If the route is defined like `/products/{product}` (name `shop.show`) you must call `route('shop.show', $product)` or `route('shop.show', $product->slug)`.
   - Prefer passing the Eloquent model where route-model-binding is used. Example: `route('shop.show', $product)`.

2. Guard route() calls where view data might be missing.
   - When rendering lists that can contain nullable items (or when `$product` could be null), wrap the link in an `@if($product)` guard, or fallback to a non-clickable element.

3. For JS code inside Blade that generates URLs, ensure the data is always present before calling `route()`.

4. Use tests and CI checks (see below) to catch mistakes early.

Examples (before / after)
- Problematic:
```blade
<form action="{{ route('reviews.store') }}"> <!-- Missing product param - fails at runtime -->
```
- Correct:
```blade
<form action="{{ route('reviews.store', $product) }}"> <!-- Passes product, route is generated correctly -->
```

- Problematic:
```blade
<a href="{{ route('shop.show', $product?->slug ?? '') }}">...
```

- Safer:
```blade
@if($product)
  <a href="{{ route('shop.show', $product) }}">...
@else
  <div class="product-card disabled">...</div>
@endif
```

How to run the route-parameter checker locally

- Run the included script (added to composer scripts):

```bash
composer check:route-params
```

This script scans `routes/web.php` for parameterized route names and searches views for `route('name')` calls without extra parameters.

CI integration
- A GitHub Actions workflow `.github/workflows/route-params-check.yml` was added. It runs automatically on PRs and pushes when views or routes change.

Developer checklist (quick)
- [ ] Passing route parameters? ✅
- [ ] Using model where possible? ✅
- [ ] Guarded usage in views where data might be null? ✅
- [ ] Tests added? ✅
- [ ] CI check created? ✅

If you'd like, I can expand this into a longer section for `CONTRIBUTING.md` and add a pre-commit hook to run the checker before commits are allowed.