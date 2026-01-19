# Admin Redirect Loop Fix

## Problem
When logging in as admin on Render (cictstore.me):
- `ERR_TOO_MANY_REDIRECTS` error
- Clicking "Admin Dashboard" in navbar just reloads the page

## Root Causes
1. **Session Configuration Issues**: Cookie driver with incorrect secure/domain settings
2. **AdminMiddleware Redirect**: Was redirecting to `/login` instead of using `redirect()->guest()`
3. **Cookie Domain Mismatch**: Sessions not persisting across redirects

## Fixes Applied

### 1. Updated AdminMiddleware
**File**: `app/Http/Middleware/AdminMiddleware.php`

Changed redirect logic to use Laravel's intended redirect:
```php
// Before:
return redirect('/login');

// After:
return redirect()->guest(route('login'));
```

This ensures the intended URL is stored and the user is redirected back after login.

### 2. Environment Variables for Render

Add these to your **Render Environment Variables**:

```env
# Session Configuration
SESSION_DRIVER=database
SESSION_SECURE_COOKIE=true
SESSION_DOMAIN=.cictstore.me
SESSION_SAME_SITE=lax

# App URL (CRITICAL - must match your domain)
APP_URL=https://cictstore.me
```

## Why These Changes Fix It

### SESSION_DRIVER=database
- Cookie driver can cause issues with large session data
- Database driver is more reliable for production
- Ensures sessions persist across redirects

### SESSION_SECURE_COOKIE=true
- **CRITICAL** for HTTPS sites (cictstore.me uses HTTPS)
- Without this, cookies won't be sent by the browser
- This is the #1 cause of redirect loops on production

### SESSION_DOMAIN=.cictstore.me
- Allows cookies to work across all paths
- The leading dot (.) allows subdomain compatibility
- Ensures consistency

### SESSION_SAME_SITE=lax
- Allows cookies during redirects
- `strict` would block cookies during POST→GET redirects
- `lax` is the sweet spot for security + functionality

### APP_URL
- Laravel uses this for generating URLs
- Must match your actual domain
- Prevents redirect mismatches

## Steps to Fix on Render

1. **Go to Render Dashboard** → Your Web Service

2. **Environment Tab** → Add/Update these variables:
   ```
   SESSION_DRIVER=database
   SESSION_SECURE_COOKIE=true
   SESSION_DOMAIN=.cictstore.me
   SESSION_SAME_SITE=lax
   APP_URL=https://cictstore.me
   ```

3. **Save Changes** (This will trigger a redeploy)

4. **After Deploy**, run these commands in Render Shell:
   ```bash
   php artisan config:clear
   php artisan cache:clear
   php artisan migrate
   ```

5. **Test Login**:
   - Go to https://cictstore.me/login
   - Log in with admin credentials
   - Should redirect to admin dashboard without loops

## Database Migration Required

Since we're switching to `database` session driver, ensure the sessions table exists:

```bash
php artisan session:table
php artisan migrate
```

This table should already exist, but run it to be safe.

## Verification Checklist

- [ ] Environment variables added to Render
- [ ] Service redeployed
- [ ] Config cleared
- [ ] Can log in without redirect loop
- [ ] Admin dashboard loads properly
- [ ] Clicking admin dashboard in navbar works
- [ ] Can navigate between admin pages
- [ ] Logout works correctly

## Additional Notes

### Local Development
Your local `.env` can keep `SESSION_DRIVER=cookie` since you're on HTTP. The cookie driver works fine locally.

### Clear Browser Cookies
If still having issues after the fix, tell users to:
1. Clear browser cookies for cictstore.me
2. Close all tabs with the site
3. Open a fresh browser window
4. Try logging in again

### Security
The `SESSION_SECURE_COOKIE=true` setting means:
- ✅ Works on HTTPS (production)
- ❌ Won't work on HTTP (local - keep it false or unset locally)

## Common Errors

### "Session store not set on request"
- Run `php artisan config:clear`
- Check APP_KEY is set

### "CSRF token mismatch"  
- Sessions not persisting
- Check SESSION_SECURE_COOKIE matches your protocol (HTTPS=true, HTTP=false)

### "Unauthenticated" after login
- APP_URL doesn't match actual domain
- SESSION_DOMAIN set incorrectly

## Testing Commands

Check current session config:
```bash
php artisan tinker
>>> config('session.driver')
>>> config('session.secure')
>>> config('session.domain')
```

Check if sessions table exists:
```bash
php artisan db:table sessions
```

## Need Help?

If redirect loops persist:
1. Check Render logs for exact error
2. Verify all environment variables saved
3. Ensure migrations ran successfully
4. Clear browser cookies completely
5. Try in incognito/private window
