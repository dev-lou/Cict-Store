# Render Deployment Troubleshooting Guide

## Issue: White Screen on Render Deployment

### Possible Causes & Solutions

#### 1. **Build Assets Missing**
The Dockerfile should build assets during image creation. Verify the build logs show:
```
npm run build
```
And that `public/build/manifest.json` is created.

#### 2. **Database Connection Issues**
Check if the sessions table exists:
```sql
CREATE TABLE IF NOT EXISTS sessions (
    id VARCHAR(255) PRIMARY KEY,
    user_id BIGINT NULL,
    ip_address VARCHAR(45) NULL,
    user_agent TEXT NULL,
    payload TEXT NOT NULL,
    last_activity INTEGER NOT NULL
);

CREATE INDEX sessions_user_id_index ON sessions(user_id);
CREATE INDEX sessions_last_activity_index ON sessions(last_activity);
```

Also create the settings table:
```sql
CREATE TABLE IF NOT EXISTS settings (
    id BIGSERIAL PRIMARY KEY,
    key VARCHAR(255) UNIQUE NOT NULL,
    value TEXT NULL,
    created_at TIMESTAMP(0) WITHOUT TIME ZONE NULL,
    updated_at TIMESTAMP(0) WITHOUT TIME ZONE NULL
);

INSERT INTO settings (key, value, created_at, updated_at) 
VALUES ('site_logo', 'images/ctrlp-logo.png', NOW(), NOW())
ON CONFLICT (key) DO NOTHING;
```

#### 3. **Check Health Endpoint**
Visit: `https://cict-dingle.onrender.com/healthz`

Should return:
- `200` with `{"status":"ok"}` if everything works
- `503` with degraded status if DB is unreachable

#### 4. **Check Render Logs**
In Render Dashboard:
1. Go to your service
2. Click "Logs" tab
3. Look for PHP errors or exceptions

#### 5. **Common Environment Variable Issues**
Ensure these are set in Render:
```
APP_ENV=production
APP_DEBUG=false
APP_KEY=base64:... (your key)
SESSION_DRIVER=database
FILESYSTEM_DISK=supabase

AWS_ACCESS_KEY_ID=...
AWS_SECRET_ACCESS_KEY=...
AWS_BUCKET=products
AWS_ENDPOINT=https://ppsdvdrnvquykxsmwjmg.supabase.co/storage/v1/s3
AWS_URL=https://ppsdvdrnvquykxsmwjmg.supabase.co/storage/v1/object/public/products
```

#### 6. **Vite Manifest Check**
SSH into your Render container (if possible) and verify:
```bash
ls -la /var/www/html/public/build/
cat /var/www/html/public/build/manifest.json
```

The manifest should list CSS and JS files.

#### 7. **Force Redeploy**
Sometimes Render's cache causes issues:
1. Go to Render Dashboard
2. Click "Manual Deploy" → "Clear build cache & deploy"

#### 8. **Check for Migration Failures**
The entrypoint runs `php artisan migrate --force`. Check logs to ensure:
- `users` table exists
- `sessions` table exists  
- `settings` table exists
- No foreign key errors

## Quick Diagnosis

Visit these URLs in order:
1. `https://cict-dingle.onrender.com/healthz` - Check if app is running
2. `https://cict-dingle.onrender.com/` - Check homepage
3. Check browser console (F12) for JavaScript errors
4. Check Network tab for 404s on CSS/JS files

## Emergency Fallback

If the white screen persists, it might be an asset loading issue. The app has fallback CSS loading:
```php
@if (file_exists($viteManifestPath))
    @vite(['resources/css/app.css', 'resources/js/app.js'])
@else
    <!-- Fallback -->
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
@endif
```

Ensure `public/css/app.css` exists or the build creates `public/build/manifest.json`.
