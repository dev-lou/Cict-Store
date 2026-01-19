# Cache Reference Guide

## 🗂️ Active Caches

### Application Caches

| Cache Key | Duration | Auto-Clears On | Purpose |
|-----------|----------|----------------|---------|
| `setting.{key}` | 1 hour | Setting update/delete | Site logo, favicon, etc. |
| `admin.order_counts` | 5 minutes | Order create/update/delete | Admin dashboard counts |
| `homepage.featured_products` | 10 minutes | Product create/update/delete | Homepage product listing |
| `homepage.featured_services` | 10 minutes | Manual | Homepage service listing |
| `homepage.service_categories` | 10 minutes | Manual | Service category grouping |
| `site.logo_url` | 30 minutes | Manual | Supabase logo URL |

## 🔄 Cache Invalidation Strategy

### Automatic (Model Events)
```php
// Product model events
Product::created → Clear homepage.featured_products
Product::updated → Clear homepage.featured_products
Product::deleted → Clear homepage.featured_products

// Order model events
Order::created → Clear admin.order_counts
Order::updated → Clear admin.order_counts
Order::deleted → Clear admin.order_counts

// Setting model events
Setting::saved → Clear setting.{key}
Setting::deleted → Clear setting.{key}
```

### Manual Clearing
```bash
# Clear all performance caches
php artisan cache:clear-performance

# Clear specific cache
php artisan tinker
>>> Cache::forget('admin.order_counts')
>>> Cache::forget('homepage.featured_products')

# Clear everything
php artisan cache:clear
```

## 📊 Cache Hit Monitoring

### Check if cache is working:
```bash
php artisan tinker

# Check order counts cache
>>> Cache::has('admin.order_counts')
# Should return: true (if cached)

>>> Cache::get('admin.order_counts')
# Should return array with counts

# Check settings cache
>>> Cache::get('setting.site_logo')
# Should return the logo path or null
```

### View cache statistics (file driver):
```bash
# Check cache directory size
ls -lh storage/framework/cache/data/

# Count cache files
find storage/framework/cache/data/ -type f | wc -l
```

## ⚡ Cache Warming

After clearing caches, warm them up:

```bash
# Visit these pages to populate caches:
curl https://your-site.com/              # Homepage caches
curl https://your-site.com/admin         # Order count caches
curl https://your-site.com/shop          # Product caches
```

Or use this warming script:
```php
php artisan tinker

# Warm settings cache
\App\Models\Setting::get('site_logo');
\App\Models\Setting::get('site_favicon');

# Warm order counts (done automatically on first admin view)
# Warm homepage (done automatically on first homepage visit)
```

## 🚨 Cache Issues & Solutions

### Issue: Settings not updating
**Symptom**: Changed logo in admin, not showing on site

**Solution**:
```bash
# Option 1: Wait 1 hour for cache to expire
# Option 2: Clear cache manually
php artisan cache:forget setting.site_logo
# Option 3: Clear all performance caches
php artisan cache:clear-performance
```

### Issue: Order counts stuck
**Symptom**: New orders not showing in admin count

**Solution**:
```bash
# Should auto-clear, but if stuck:
php artisan cache:forget admin.order_counts
# Or wait 5 minutes for auto-expiry
```

### Issue: Homepage not showing new products
**Symptom**: Added product, not appearing on homepage

**Solution**:
```bash
# Should auto-clear, but if stuck:
php artisan cache:forget homepage.featured_products
# Or wait 10 minutes for auto-expiry
```

### Issue: Cache not persisting
**Symptom**: Cache always empty, performance not improving

**Check**:
```bash
# 1. Check cache driver
php artisan tinker
>>> config('cache.default')
# Should be: "file" or "database"

# 2. Check if cache directory is writable
ls -la storage/framework/cache/

# 3. Check permissions
chmod -R 775 storage/framework/cache/
```

## 🔧 Cache Commands

### Built-in Laravel Commands
```bash
# Clear application cache
php artisan cache:clear

# Clear config cache
php artisan config:clear

# Clear route cache
php artisan route:clear

# Clear view cache
php artisan view:clear

# Clear all caches
php artisan optimize:clear

# Rebuild all caches
php artisan optimize
```

### Custom Commands
```bash
# Clear only performance caches (new)
php artisan cache:clear-performance

# Clear all with --all flag
php artisan cache:clear-performance --all
```

## 📈 Performance Impact

### With Caching (Current)
```
Homepage Load:
- First visit: 8 queries
- Cached visit: 3 queries
- Savings: 62%

Admin Dashboard:
- First visit: 12 queries
- Cached visit: 8 queries
- Savings: 33%

Product Page:
- First visit: 10 queries
- Cached visit: 6 queries
- Savings: 40%
```

### Cache Hit Rates (Expected)
- Settings: ~95% (changes rarely)
- Order Counts: ~80% (5min cache)
- Homepage: ~85% (10min cache)

## 🛠️ Development Tips

### Local Development
```bash
# Disable caching during development
# Add to .env:
CACHE_DRIVER=array  # Cache only for current request

# Or use file driver but clear often:
php artisan cache:clear  # After code changes
```

### Testing Cache
```php
// In your tests
use Illuminate\Support\Facades\Cache;

// Before each test
Cache::flush();

// Or in setUp()
protected function setUp(): void
{
    parent::setUp();
    Cache::flush();
}
```

### Cache Debugging
```php
// Add to your code temporarily
use Illuminate\Support\Facades\Log;

// Log cache hits
if (Cache::has('my.cache.key')) {
    Log::info('Cache HIT: my.cache.key');
} else {
    Log::info('Cache MISS: my.cache.key');
}
```

## 🔍 Monitoring Production Caches

### Check Render Logs
Look for these patterns:
```
Cache HIT: admin.order_counts
Cache MISS: homepage.featured_products (first load)
Cache CLEARED: setting.site_logo (after update)
```

### Monitor Performance
```bash
# Check response times in Render dashboard
# Before caching: 4000-5000ms
# After caching: 800-1500ms
```

## 📚 Related Files

- **Models**: `app/Models/Setting.php`, `Product.php`, `Order.php`
- **Providers**: `app/Providers/AppServiceProvider.php`
- **Controllers**: `app/Http/Controllers/HomepageController.php`
- **Commands**: `app/Console/Commands/ClearPerformanceCache.php`
- **Config**: `config/cache.php`

## 💡 Future Enhancements

### Upgrade to Redis (Recommended for Scale)
```bash
# Install Redis on Render
# Update .env:
CACHE_DRIVER=redis
REDIS_HOST=your-redis-host
REDIS_PASSWORD=your-password
REDIS_PORT=6379

# Benefits:
# - Faster than file cache
# - Supports multiple servers
# - Advanced features (tags, etc.)
```

### Cache Tags (Redis only)
```php
// Group related caches
Cache::tags(['products', 'homepage'])->put('key', 'value', 600);

// Clear all product caches at once
Cache::tags('products')->flush();
```

---

**Last Updated**: January 19, 2026  
**Cache Strategy**: Time-based with automatic invalidation  
**Storage**: File-based (default)
