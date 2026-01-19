# URGENT: Security Key Leak Response

## 🚨 SECURITY BREACH DETECTED

Your API keys were found in GitHub repository history at:
`bootstrap/cache/config.php`

### Exposed Credentials:
1. ❌ Gemini API Key
2. ❌ Supabase Service Role Key (CRITICAL - full database access!)
3. ❌ Supabase Anon Key
4. ❌ Google OAuth Client ID & Secret

---

## ⚡ IMMEDIATE ACTIONS REQUIRED

### Step 1: Regenerate ALL Keys (Do this NOW!)

#### 1.1 Gemini API Key
```
1. Go to: https://makersuite.google.com/app/apikey
2. Click on your old key: AIzaSyDevKLgC0brDaUs8TUCcRjygtuJaqxF4Bk
3. Click "Delete" or "Revoke"
4. Click "Create API Key"
5. Copy the new key to your .env file:
   GEMINI_API_KEY=your_new_key_here
```

#### 1.2 Supabase Keys (MOST CRITICAL!)
```
1. Go to: https://supabase.com/dashboard/project/ppsdvdrnvquykxsmwjmg/settings/api
2. Click "Reset project API keys"
3. Confirm the reset
4. Update your .env:
   SUPABASE_SERVICE_ROLE_KEY=new_service_role_key
   SUPABASE_ANON_KEY=new_anon_key
```

**WARNING**: The exposed `service_role_key` has FULL DATABASE ACCESS!
Anyone with this key can:
- Read all data
- Modify all data  
- Delete tables
- Access user information

#### 1.3 Google OAuth Credentials
```
1. Go to: https://console.cloud.google.com/apis/credentials
2. Find: 12845029973-nkq1gfaoom0od2bb5flpqua3ko03g4mr
3. Click the trash icon to delete
4. Click "Create Credentials" → "OAuth 2.0 Client ID"
5. Application type: Web application
6. Authorized redirect URIs:
   - https://your-production-site.com/auth/google/callback
   - http://127.0.0.1:8000/auth/google/callback (for local dev)
7. Update your .env:
   GOOGLE_CLIENT_ID=new_client_id
   GOOGLE_CLIENT_SECRET=new_client_secret
```

---

### Step 2: Remove Keys from Git History

⚠️ **WARNING**: This will rewrite your git history!

```bash
# Option 1: Using BFG Repo-Cleaner (Recommended)
# Download from: https://rtyley.github.io/bfg-repo-cleaner/

# Remove the sensitive file from ALL commits
java -jar bfg.jar --delete-files config.php
git reflog expire --expire=now --all
git gc --prune=now --aggressive
git push --force
```

```bash
# Option 2: Using git filter-branch (if you can't use BFG)
git filter-branch --force --index-filter \
  "git rm --cached --ignore-unmatch bootstrap/cache/config.php" \
  --prune-empty --tag-name-filter cat -- --all

git push --force --all
```

```bash
# Option 3: Nuclear Option - Start Fresh (Easiest)
# If repo is relatively new and you don't mind losing history:

# 1. Delete .git folder
Remove-Item -Recurse -Force .git

# 2. Reinitialize
git init
git add .
git commit -m "Initial commit with security fixes"
git remote add origin YOUR_GITHUB_URL
git push -u --force origin main
```

---

### Step 3: Verify .env is Protected

Check your `.env` file exists and has correct keys:

```bash
# Open .env and verify:
GEMINI_API_KEY=your_new_gemini_key
SUPABASE_SERVICE_ROLE_KEY=your_new_service_role_key
SUPABASE_ANON_KEY=your_new_anon_key
GOOGLE_CLIENT_ID=your_new_client_id
GOOGLE_CLIENT_SECRET=your_new_client_secret
```

Verify `.env` is in `.gitignore`:
```bash
# Check:
cat .gitignore | Select-String ".env"

# Should show:
# .env
# .env.backup
# .env.production
```

---

### Step 4: Clear Local Cache

```bash
# Clear the cached config
php artisan config:clear
php artisan cache:clear

# Verify the cache file is regenerated with NEW keys
php artisan config:cache

# Check it's not tracked by git
git status
# Should NOT show bootstrap/cache/config.php
```

---

### Step 5: Security Audit

Check what was potentially compromised:

#### Database Access Log (Supabase)
```
1. Go to: https://supabase.com/dashboard/project/ppsdvdrnvquykxsmwjmg/logs
2. Check for suspicious queries
3. Look for unexpected IP addresses
4. Review last 7 days of activity
```

#### Gemini API Usage
```
1. Go to: https://console.cloud.google.com/apis/dashboard
2. Check quota usage
3. Look for unusual spikes
```

#### Google OAuth Audit
```
1. Check if any unauthorized apps accessed user data
2. Review recent sign-ins
```

---

## 📋 Security Checklist

After completing all steps:

- [ ] Regenerated Gemini API key
- [ ] Regenerated Supabase service_role_key
- [ ] Regenerated Supabase anon_key  
- [ ] Regenerated Google OAuth credentials
- [ ] Removed keys from git history
- [ ] Verified `.env` is in `.gitignore`
- [ ] Cleared Laravel config cache
- [ ] Pushed force update to GitHub
- [ ] Checked Supabase logs for suspicious activity
- [ ] Updated keys in Render environment variables (if deployed)
- [ ] Notified team members (if applicable)
- [ ] Reviewed GitHub security alerts

---

## 🛡️ Prevention for Future

### 1. Never Cache Config in Production
```bash
# In .gitignore (already done ✅)
/bootstrap/cache/

# Never run this locally and commit:
# php artisan config:cache
```

### 2. Use Environment Variables Everywhere
```php
// Good ✅
'api_key' => env('GEMINI_API_KEY'),

// Bad ❌
'api_key' => 'AIzaSyDevKLgC0brDaUs8TUCcRjygtuJaqxF4Bk',
```

### 3. Enable Pre-commit Hooks
```bash
# Install git-secrets
# Prevents committing secrets
```

### 4. Regular Security Audits
- Enable GitHub secret scanning
- Use tools like `truffleHog` to scan commits
- Review `.gitignore` regularly

---

## 🆘 If You Need Help

1. **Can't regenerate keys**: Contact the service provider support
2. **Don't have access**: Ask the project owner
3. **Unsure about git commands**: Backup your code first!

---

## 📊 Impact Assessment

**Severity**: 🔴 CRITICAL

**Exposed Keys Allow**:
- ✅ Full database read/write access (Supabase service_role_key)
- ✅ User data access (Google OAuth)
- ✅ API quota exhaustion (Gemini)
- ✅ Financial charges to your accounts

**Time to Remediate**: 15-30 minutes
**Downtime**: None (if done correctly)

---

## ✅ Verification

After completing all steps, verify:

```bash
# 1. Check git history is clean
git log --all --full-history -- bootstrap/cache/config.php
# Should return nothing

# 2. Check GitHub
# Go to your repo and search for old keys
# They should not appear

# 3. Test your app
php artisan serve
# Visit http://127.0.0.1:8000
# Everything should work with NEW keys
```

---

**Last Updated**: January 19, 2026
**Priority**: 🚨 CRITICAL - DO IMMEDIATELY
**Estimated Time**: 30 minutes
