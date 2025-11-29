# Safe Local Development and Render Deployment Guide

This document describes the recommended safe workflow for developing locally (XAMPP or Docker), testing offline, and deploying to Render only after thorough local testing.

⚠️ Important: Do NOT push local `.env` credentials or any sensitive values to `main`.

---

## Overview
- Stack: Laravel 11 (PHP 8.2), Vite, TailwindCSS, Neon PostgreSQL, Supabase storage
- Goal: Local-first development. Do not deploy untested code to `main`.

---

## 1. Branching: Always work on a safe, isolated branch
```powershell
# Start a new feature/test branch from remote main
git fetch origin
git checkout -b local-test
```
- Keep `main` protected and require PRs.

---

## 2. .env and .gitignore setup
- `config/` files should read env variables; never commit `.env`.
- Your `.env.example` is already in the repo and is safe to commit.

### Recommended `.env` for local testing (copy locally; DO NOT COMMIT):
- Copy `.env.example` to `.env` and set these values for offline testing:
```env
APP_ENV=local
APP_DEBUG=true
LOCAL_DEV=true         # Toggle used by config/database.php to pick local DB
LOG_CHANNEL=stack
DB_CONNECTION_LOCAL=sqlite
DB_CONNECTION=pgsql
DB_DATABASE=./database/database.sqlite
QUEUE_CONNECTION=sync
SESSION_DRIVER=file
FILESYSTEM_DISK=local
GEMINI_API_KEY=
```
- If you prefer to use XAMPP (MySQL), set `DB_CONNECTION_LOCAL=mysql` and corresponding `DB_HOST`, `DB_PORT`, `DB_USERNAME`, `DB_PASSWORD` pointing to your XAMPP server. Your Laravel app will detect the local connection via `LOCAL_DEV`.

### `.gitignore` best practices
Ensure `.gitignore` contains these entries (this repo already excludes them):
```
.env
.env.*
.env.local
database/*.sqlite
storage/logs/
node_modules/
vendor/
public/build
```
This prevents local secrets and binaries from leaking into commits.

---

## 3. Choose your local database strategy
- SQLite (recommended for fastest offline dev & no extra installs): set `DB_CONNECTION_LOCAL=sqlite` and `DB_DATABASE=./database/database.sqlite`.
- Local PostgreSQL (recommended for parity with production) via:
  - Install locally and set `DB_HOST=127.0.0.1 DB_PORT=5432 DB_DATABASE=...`.
  - Or use Docker/Postgres image for exact parity.
- XAMPP (MySQL) — if you want to use XAMPP's MySQL server, set `DB_CONNECTION_LOCAL=mysql`.

---

## 4. Exact commands: Setup, run & test locally (Windows Powershell)
This sequence assumes you already have PHP, Composer, Node, and NPM installed. If you want Docker, see the Docker section below.

### Setup
```powershell
# Create and switch to local branch
git checkout -b local-test

# Copy local env (DO NOT commit .env)
Copy-Item .env.example .env
notepad .env   # Edit: set LOCAL_DEV=true, DB_CONNECTION_LOCAL=sqlite, DB_DATABASE=database/database.sqlite

# Prepare filesystem for Laravel
New-Item -ItemType Directory -Force -Path ./database
if (!(Test-Path ./database/database.sqlite)) { New-Item -ItemType File -Path ./database/database.sqlite }
php -v
composer install --no-interaction
npm ci

php artisan key:generate
php artisan storage:link

# Run DB migrations and seed
php artisan migrate --force
php artisan db:seed --force   # Optional, for demo data
```

### Run dev servers (Vite + Laravel)
```powershell
# Option A: Local (development server + vite dev server)
npm run dev
php artisan serve --host=127.0.0.1 --port=8000

# Option B: Production-like assets (build assets)
npm run build:production
php artisan serve --host=127.0.0.1 --port=8000
```
- Visit: http://127.0.0.1:8000 and verify behavior.

### Tests
```powershell
# run phpunit if available
composer test

# Sanity check endpoints
curl http://127.0.0.1:8000/healthz
```

---

## 5. Docker-based local run (optional, for parity)
- Use Docker if you want the full stack locally including Postgres and Supabase.

```powershell
# Build docker images
docker-compose build --no-cache
# Bring up services
docker-compose up -d
# Enter container
docker exec -it <app-container-name> bash
# Inside container
php artisan migrate --force
php artisan db:seed --force

# Access app URL per docker-compose (typically http://localhost:8080)
```

---

## 6. Avoiding build-time DB queries
- Keep `app/providers` and service providers dry from DB access in `boot()` if possible.
- If a provider requires DB access, guard it with `if (!app()->runningInConsole()) {...}` or `if (!env('LOCAL_DEV')) {...}` to avoid DB calls during composer / artisan CLI.

---

## 7. Render preview/staging & how to deploy only tested code
**Step 1: Push your test branch**
```powershell
git add .
git commit -m "feat: implement example X"
git push -u origin local-test
```
**Step 2: Create a Render preview service or configure a staging service**
- In Render, create a new web service using the repo and set the branch to `local-test`. Use a separate (non-prod) DB.
- Set environment variables for the staging environment (copy from production but use test DB and keys). Use `APP_ENV=staging` and `APP_DEBUG=true` for testing only.

**Step 3: Validate on staging preview**
- Confirm all tests pass and do full manual flows (checkout, admin, notifications, AI feature is stubbed for staging if needed).

**Step 4: Merge to `main` only when ready**
```powershell
# Create a PR on GitHub (local-test -> main), wait for CI checks
# When ready and approved + CI green
git checkout main
git merge --no-ff local-test
git push origin main
```
- Render production service can be configured to deploy automatically on `main` (but only after PR checks pass).

---

## 8. Debug & Health Commands
- DB checks:
```powershell
# Inspect DB using tinker
php artisan tinker
>>> DB::select('SELECT 1');
```
- Logs are in `storage/logs/laravel.log`. If you use Render, rely on Render logs or configure `LOG_CHANNEL=errorlog`.

---

## 9. Recommended CI & safeguards (High level)
- Run: Linting, `composer test`, `npm run build` on PRs.
- Add a `gitleaks` stage to CI to prevent prod secret leaks.
- Use branch protection rules to require CI and code review before merging.

---

## 10. Quick Troubleshooting Tips
- If `php artisan migrate` fails due to DB not ready, use a retry or increase DB timeout in `docker-entrypoint.sh`.
- If Monolog cannot write logs: ensure `storage/logs/laravel.log` exists and is owned by web user (`www-data`) or fallback to `LOG_CHANNEL=errorlog`.

---

## 11. Example `git` workflow
1. New feature:
```powershell
# from main
git checkout -b feature/cool-change
# make changes
# test locally
git add .
git commit -m "feat: add cool change"
git push origin feature/cool-change
```
2. Create PR -> link Render preview -> test.
3. Merge only when safe.

---

## 12. Offline walkthrough for beginners
- Make sure `composer install` and `npm ci` are run while online and `node_modules` and `vendor` are present. You can then work offline. Use `DB_CONNECTION_LOCAL=sqlite` to avoid network DB calls.

---

If you want, I will:
- Add a `LOCAL_DEV` hint in `.env.example`.
- Add a small `scripts/dev-setup.ps1` to perform dev setup automatically.
- Create a GitHub Actions workflow for CI.

Please tell me which of these you'd like next and I'll implement it for you.
