# Cloudflare CDN Setup Guide for CICT Store

## Why Cloudflare?
- **Free tier** - No cost for basic CDN
- **50-70% faster** for returning visitors
- **Global edge caching** - Files served from nearest location
- **DDoS protection** included

---

## Setup Steps (10 minutes)

### Step 1: Sign Up
1. Go to [cloudflare.com](https://cloudflare.com)
2. Create free account
3. Click "Add a Site"
4. Enter your domain: `cictstore.online` (or your domain)

### Step 2: DNS Configuration
1. Cloudflare will scan your DNS records
2. Verify existing records are imported
3. Click "Continue"

### Step 3: Update Nameservers
1. Cloudflare gives you 2 nameservers like:
   - `anna.ns.cloudflare.com`
   - `bob.ns.cloudflare.com`
2. Go to your domain registrar (where you bought domain)
3. Replace nameservers with Cloudflare's
4. Wait 1-24 hours for propagation

### Step 4: Configure Caching (Optional but Recommended)
1. Go to **Caching** → **Configuration**
2. Set "Caching Level" to **Standard**
3. Set "Browser Cache TTL" to **1 month**

### Step 5: Enable Speed Features
1. Go to **Speed** → **Optimization**
2. Enable:
   - ✅ Auto Minify (HTML, CSS, JS)
   - ✅ Brotli compression
   - ✅ Early Hints
   - ✅ Rocket Loader (optional, test first)

---

## Result
- Static files (CSS, JS, images) cached globally
- First load: Same speed
- Repeat visits: **50-70% faster**
- Free SSL certificate included

---

## Notes for Render
Your Render backend still handles PHP/Laravel.
Cloudflare sits in front as a CDN/proxy.

```
User → Cloudflare (cached assets) → Render (PHP processing) → Supabase (database)
```
