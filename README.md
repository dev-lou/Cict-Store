<!--
   README: Updated on 2025-11-28
   Purpose: Developer-facing quickstart, setup instructions, and references.
-->

# TheWerk — CICT Student Council Merchandise & Services Platform

[![License: MIT](https://img.shields.io/badge/License-MIT-green.svg)](LICENSE)
[![Laravel 11](https://img.shields.io/badge/Laravel-11.x-FF2D20?style=flat&logo=laravel)](https://laravel.com)
[![PHP 8.2](https://img.shields.io/badge/PHP-8.2-8892BF?style=flat&logo=php)](https://www.php.net)
[![Vite](https://img.shields.io/badge/Vite-7.0-646CFF?style=flat&logo=vite)](https://vitejs.dev)
[![Tailwind](https://img.shields.io/badge/Tailwind-4.0-38B2AC?style=flat&logo=tailwind-css)](https://tailwindcss.com)

An e-commerce and service management platform powering the CICT Student Council’s merchandise and printing services. Built with Laravel and modern JS tooling, it includes inventory, order processing, a responsive UI, an admin dashboard, and Gemini AI chatbot integration for support.
---

## What is TheWerk?

TheWerk is a production-ready platform that enables the CICT Student Council to sell merchandise, manage inventory, process orders, and provide AI-assisted customer support. It ships with an admin UI for manager workflows and a responsive storefront optimized for accessibility.

---

## Tech Stack

- Backend: Laravel 11 (PHP 8.2+)
- Frontend: Vite, Alpine.js, Tailwind CSS
- DB: PostgreSQL (Neon / Supabase recommended)
- Storage: Supabase S3-compatible storage (via Flysystem)
- AI: Google Gemini generative models via API
- Deploy: Docker-ready for Render or other container platforms

---

## Setup & Installation (Developer Friendly)

Prerequisites
- PHP 8.2+ (with required extensions: pdo, pdo_pgsql, mbstring, openssl, zlib)
- Composer
- Node.js 18+ and npm/yarn
- Docker (optional for local containerized testing)

Clone the repository

```bash
git clone https://github.com/your-username/ctrl-p.git
cd ctrl-p
```

Install dependencies

```bash
# PHP (Composer)
composer install

# Node.js (Vite)
npm install
```

Environment configuration

1. Copy ` .env.example` to `.env`:

```bash
cp .env.example .env
```

2. Generate an application key

```bash
php artisan key:generate
```

3. Update your `.env` with the correct database credentials and third-party API keys. See the `Environment Variables` section below for required keys and details.

Database setup

```bash
php artisan migrate
# Optional seeding
php artisan db:seed
```

Build & run (local)

```bash
# Run Vite dev server
npm run dev

# Run the PHP server (or, use Docker)
php artisan serve --host=0.0.0.0 --port=8000
```

---

## Environment Variables

The repo uses `.env` for local and deployment configuration. For onboarding and source control safety:

- Copy `.env.example` to `.env` and add your own credentials.
- **Do not** commit `.env`. The repository `.gitignore` excludes `.env` and other sensitive files.
- Keep secrets in your environment provider (Render, GitHub Actions secrets, or Secret Manager).

Key settings you’ll typically configure in `.env` (short list):
```text
APP_KEY, APP_URL, APP_ENV, APP_DEBUG
DB_* or DATABASE_URL (Neon or Supabase) and DB_NEON_ENDPOINT
AWS_ACCESS_KEY_ID, AWS_SECRET_ACCESS_KEY, AWS_ENDPOINT
SUPABASE_SERVICE_ROLE_KEY, SUPABASE_ANON_KEY
GEMINI_API_KEY, GEMINI_MODEL
SESSION_DRIVER, CACHE_STORE, QUEUE_CONNECTION
```

> **Warning:** If you accidentally commit secrets (e.g., API keys or DB passwords), rotate them immediately and follow the repo history purge instructions.

---

## Developer Experience & Workflow

- Use feature branches from `main` for development and PRs for code review.
- Write tests and add regression coverage for new features.
- Keep config in `.env` and avoid committing secrets.

Common developer commands:

```bash
# Install deps
composer install
npm install

# Dev server
npm run dev    # Vite HMR
php artisan serve

# Build & Test
npm run build:production
composer test

# DB
php artisan migrate --seed

# Clean caches
php artisan cache:clear && php artisan config:clear && php artisan view:clear
```

---

## Running in Docker (Render / Local)

The repository includes a Dockerfile and Docker Compose example for local testing. For Render, use the Docker build flow and set your environment variables in the Render dashboard.

Local (Docker Compose) quickstart:
```bash
docker-compose build
docker-compose up -d
# Run migrations inside container if needed
docker exec -it <app_container> php artisan migrate --force
```

Render Deploy tips:
- Add environment variables in Render’s Dashboard Secrets section.
- Ensure `APP_KEY` is generated and `APP_DEBUG=false` for production.
- Migrations can run in a deploy hook or from a Render shell using `php artisan migrate --force`.

---


## Tests & Quality

- The project uses PHPUnit for backend tests and scripts for tooling checks.
- Run the test suite with:
```bash
composer test
```

Add CI (GitHub Actions) to run `composer test`, style checks, and a secret scanning job as part of PR checks.

> NOTE: Active PHPUnit tests were archived to `archived-tests/`. Ad-hoc `scripts/test_*.php` were renamed to `*.example.php` to discourage committing real credentials — copy the example, set env vars, then run.

---


## Contributing

We welcome contributions — please follow these steps:

1. Fork and create a feature branch.
2. Add tests for new behavior and update documentation where appropriate.
3. Format code and run tests before creating a PR.
4. A maintainer will review. Keep PRs focused and self-contained.

Please follow the GitHub `Contributing` and `Code of Conduct` guidelines in this repo if they exist.

---


---

## Additional Resources & Support

If you need help or want to report a bug, open an issue in the repo or contact the repo owner.

**Thank you for contributing to TheWerk!**


---

If you need any help setting up or running, open an issue or reach out to the repository owner.


**Built with ❤️ for the CICT Student Council**
