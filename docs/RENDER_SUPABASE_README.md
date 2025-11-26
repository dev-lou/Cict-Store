# Render / Supabase — Troubleshooting & Fixes

## The Problem

Your Render app cannot reach the Supabase Postgres database because:
- **Supabase endpoints are IPv6-only** (they only have AAAA DNS records, no IPv4 A records)
- **Render's outbound network is IPv4-only** (cannot connect to IPv6 addresses)

This results in `SQLSTATE[08006] Network is unreachable` errors.

---

## ✅ IMMEDIATE FIX: Enable REST API Fallback

This keeps your **storefront pages online** (home, shop, products) even when Postgres is unreachable.

### Step 1: Add these environment variables in Render Dashboard

Go to your Render service → **Environment** → Add these variables:

| Variable | Value | Where to find it |
|----------|-------|------------------|
| `SUPABASE_SERVICE_ROLE_KEY` | `eyJhbGci...` | Supabase → Project Settings → API → `service_role` key |
| `SUPABASE_ANON_KEY` | `eyJhbGci...` | Supabase → Project Settings → API → `anon` key |

### Step 2: Redeploy

Click **Manual Deploy** → **Deploy latest commit**

### Step 3: Verify

Visit `https://your-app.onrender.com/healthz`

You should see:
```json
{"status":"degraded","db":"unreachable","fallback":"supabase_rest"}
```

This means:
- ❌ Postgres is still unreachable (expected)
- ✅ REST API fallback is active (storefront will work!)

---

## 🔧 PERMANENT FIX OPTIONS

### Option A: Ask Supabase for IPv4 (Recommended)

1. Contact Supabase support
2. Request an IPv4 endpoint for your database
3. Update `DB_HOST` in Render with the new IPv4 address
4. Redeploy

### Option B: Use an IPv4 Proxy

Set up a small VM with IPv4 that forwards traffic to Supabase's IPv6:

```bash
# On a DigitalOcean/AWS/GCP VM with IPv4
sudo apt update && sudo apt install -y socat
sudo socat TCP-LISTEN:5432,reuseaddr,fork TCP6:[2a05:d014:etc:your-supabase-ipv6]:5432 &
```

Then update Render:
- `DB_HOST` = your VM's IPv4 address
- `DB_PORT` = 5432

### Option C: Use a Different Database Provider

Switch to a Postgres provider that offers IPv4 endpoints (Neon, Railway, etc.)

---

## 📊 Diagnostic Commands

Run these in Render's **Shell** tab:

```bash
# Check DNS resolution and connectivity
php scripts/check_db_connectivity.php

# Test if REST fallback is working
curl -s http://localhost/healthz | cat

# Prime the local cache (creates fallback JSON files)
php artisan app:prime-cache
```

---

## 🔍 What the Fallback Does

When Postgres is unreachable, the app automatically:

1. **Middleware intercepts** the DB failure
2. **Fetches data** from Supabase REST API instead
3. **Renders pages** using the REST data
4. **Falls back to local JSON** if REST also fails

**Works for:**
- ✅ Homepage (`/`)
- ✅ Shop listing (`/shop`)
- ✅ Product pages (`/shop/{slug}`)

**Does NOT work for:**
- ❌ Admin panel (requires DB)
- ❌ Orders/checkout (requires DB)
- ❌ User accounts (requires DB)

---

## 📁 Files Involved

| File | Purpose |
|------|---------|
| `app/Http/Middleware/DegradedModeIfDbUnavailable.php` | Intercepts DB errors, uses REST fallback |
| `app/Services/SupabaseFallback.php` | REST API client for Supabase |
| `app/DTO/FallbackProduct.php` | Data object for fallback product data |
| `app/Console/Commands/PrimeCache.php` | Creates local JSON fallback files |
| `scripts/check_db_connectivity.php` | Diagnostic script |
| `storage/app/public/fallback/*.json` | Local JSON cache files |
| `storage/app/public/degraded.html` | Static 503 page |

---

## 🚨 Troubleshooting

### "Bad Gateway" errors
- Check Render logs for the actual error
- Run `php scripts/check_db_connectivity.php` in Render shell

### REST fallback not working
- Verify `SUPABASE_SERVICE_ROLE_KEY` is set correctly
- Check that it matches your Supabase project
- Look for "DegradedMode" entries in Render logs

### Pages show old data
- Run `php artisan app:prime-cache` to refresh local JSON
- Check that REST API is returning current data
