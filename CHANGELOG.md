# Changelog

All notable changes to the **CICT Store** (ISUFST Department E-Commerce Platform) are documented here.

> **Versioning:** Each monthly release cycle since project inception is tagged sequentially (v1–v7).  
> Current version: **v7.0.0** (May 2026)

---

## v7.0.0 — May 2026
*Release date: 2026-05-24*

### ⚠️ Security
- **Redact secrets from repository** — Stop tracking `.env`, add `.env.example` with placeholders, add pre-commit hook to prevent secret leaks
- Add Gitleaks CI workflow for automated secret scanning
- Add Socket Security workflow for npm supply chain protection

### 🏗️ Dev Tooling & CI/CD
- **Add complete dev tooling stack:**
  - Commitlint — Enforce conventional commits (11 types, 17 project-specific scopes)
  - ESLint — Flat config for JavaScript linting
  - lint-staged — Auto-run Pint + ESLint on staged files
  - Renovate — Automated dependency updates
  - Husky — Git hooks (`pre-commit` → lint-staged, `commit-msg` → commitlint)
- **Add 5 GitHub Actions workflows:**
  - **CI** — Pint → PHPUnit (SQLite in-memory) → Frontend Build (Vite)
  - **Gitleaks** — Secret scanning on every push/PR
  - **Commitlint** — PR commit message validation
  - **Socket Security** — npm supply chain audit
  - **PR Agent** — AI-powered code reviews via Qodo
- Add `TOOLING.md` with comprehensive developer onboarding documentation
- Add `CODEOWNERS` for repository governance

### 🧹 Codebase Cleanup
- Remove 9 orphaned controllers and 1 debug console command
- Delete temporary/backup files (`tmp_update_homepage.ps1`, `PROJECT_DOCUMENTATION.md`, `.backup` files)
- Move documentation assets to `docs/` directory
- Remove debug `console.log` statements from admin views
- Clean up routes — remove `GeminiDiag` and `/debug-db` temp endpoints
- **Fix 105 PHP code style violations** across 157 files via Laravel Pint
- Fix Duplicate lint-staged config in `package.json`

### 📁 Scripts Reorganization
- Reorganize `scripts/` into structured subdirectories:
  - `scripts/deploy/` — Post-deployment cache busting
  - `scripts/diagnostics/` — 10 diagnostic utilities (DB, config, Gemini checks)
  - `scripts/examples/` — 7 example scripts for Gemini, Supabase, chat
- Fix `__DIR__` relative paths in all 15 moved scripts

### 🔧 CI Fixes
- Fix `composer install` failure in CI — Add `bootstrap/cache/.gitkeep` for fresh checkouts
- Migrate PHPUnit to **SQLite in-memory** — Remove PostgreSQL service container, eliminating cloud database risk
- Create test directory structure — Fix "Test directory not found" PHPUnit errors

---

## v6.0.0 — April 2026
*Release date: 2026-04-18*

### 🎨 User Experience
- **Global navigation loader** — Initialize persistent loading indicator for page transitions
- **Premium UX updates** — Refined animations and interaction feedback
- **Restore SweetAlert2** — Fix add-to-cart success notifications with proper mobile button layout
- **Homepage CTA** — Center call-to-action section for better visual balance
- **Hero adjustments** — Reduce hero height so featured products are visible on page load
- **Spacing fixes** — Increase top padding on Shop, Services, and Contact heroes for proper navbar clearance
- **Badge visibility** — Improve sale/badge visibility on product cards with increased hero spacing

---

## v5.0.0 — March 2026
*Release date: 2026-03-01*

No notable changes — Infrastructure stabilization period.

---

## v4.0.0 — February 2026
*Release date: 2026-02-10*

### 🐛 Critical Bug Fixes
- **Fix ALL PostgreSQL boolean comparison issues** across the entire codebase (19 fixes)
  - Use PostgreSQL `IS TRUE`/`IS FALSE` syntax for all boolean queries
  - Fix `whereNull` for PostgreSQL compatibility in login cleanup
  - Fix last boolean query in `ServiceManagementController`
- Fix automatic migrations to prevent deployment failures
- Fix Blade helper usage in error pages to ensure they render when app is broken

### 🚀 Performance & SEO
- **WebP image support** — Convert images to WebP format for faster loading
- **SEO meta tags** — Add comprehensive meta descriptions and Open Graph tags
- **Mobile performance** — Disable particles.js and GSAP animations on mobile devices
- **Resource hints** — Add preconnect/preload hints for critical third-party resources
- Fix `transition:all` to use specific properties for better rendering performance
- Remove debug file and diagnostic endpoint

### 🎨 UI/UX
- **Professional error pages** — Redesigned 500, 404, and 503 pages
- **Blocked and DB-unavailable pages** — Professional design for maintenance mode
- Add Persistent Database Connection (PDO) fix for Supabase port 6543
- Standardize Vite assets loading across all layouts
- Add Render build script with automatic cache clearing

---

## v3.0.0 — January 2026
*Release date: 2026-01-27*

### 🏗️ Infrastructure & Deployment
- Transition from Vercel serverless to **Render Docker container** architecture
- Configure Neon PostgreSQL with IPv4-compatible connection pooling
- Implement Content Security Policy (CSP) for Supabase and external scripts
- Debug and resolve routing/redirect loops in admin dashboard

### 🔒 Security
- **IP blocking** — Implement IP-based access control
- **Session encryption** — Enable encrypted sessions for sensitive data
- **Security headers** — Add comprehensive HTTP security headers
- **Remove exposed API keys** — Audit and remove secrets from version control

### ✨ Features
- **Google OAuth** — Add Google Single Sign-On authentication
- **Service management system** — Complete CRUD with admin interface
- **Bento grid layouts** — Redesign admin and user dashboard pages
- **SEO optimization** — Add sitemap generation, meta tags, structured data

### 🎨 Branding & UI
- **Rebrand to "ISUFST CICT"** — Update all branding assets, homepage, footer, and logo
- Mobile-responsive admin panel with sidebar navigation
- Order count indicators in admin sidebar

### 🛠️ Database & Migrations
- Extensive PostgreSQL schema migrations for services, options, officers
- Settings system with key-value configuration store
- Performance indexes for customer-facing pages
- Add price labels to service options

---

## v2.0.0 — December 2025
*Release date: 2025-12-26*

### 🐳 Docker & Deployment
- Fix Docker entrypoint UTF-8 encoding (resolve exec format errors)
- Force `eol=lf` gitattributes for entrypoint script
- Add explicit view cache clearing to entrypoint
- Strip CRLF from entrypoint during Docker build

### 📱 Mobile UI Optimization
- **Shop page** — Optimized mobile hero with proper navbar spacing and text sizing
- **Product details** — Adjusted red banner height (250px), breadcrumb positioning, and layout
- **Homepage** — Reduced mobile text sizes for readability
- **Admin sidebar** — Add order count indicators with pending count badge
- **2-column grids** — For steps, officers, and merchandise on mobile
- **Chatbot UI** — Enhance chatbot and order interface with dropdown readability fixes

### 🤖 AI Integration
- Update Gemini model to **gemini-2.5-flash-live** / **gemini-2.5-flash**
- Improve Gemini error handling and diagnostics
- Add secure `/debug/gemini` diagnostic route

### 🆕 Services Module
- Add full services management module
- UI refinements for service listings and checkout steps

---

## v1.0.0 — November 2025
*Release date: 2025-11-29*

### 🚀 Initial Release
Production-ready launch of the **ISUFST CICT Department E-Commerce Platform**.

### 🏛️ Architecture
- **Laravel 11** application with PostgreSQL (Neon) database
- **Vercel → Render migration** — Transition to Docker container-based hosting
- **Degraded mode middleware** — Storefront remains functional when database is unreachable
- **Supabase REST API fallback** — Read-only data fallback for products and shop pages
- **Static HTML fallbacks** — Graceful degradation when all backend services are down

### 🛒 E-Commerce Features
- **Product management** — CRUD with categories, badges, variants, and inventory tracking
- **Order system** — Full checkout flow with order items, snapshots, and history
- **Shopping cart** — Add/remove items, quantity updates, persistent cart
- **Buy list** — Purchase request system for department procurement
- **Inventory history** — Track stock changes with variant-level granularity

### 🤖 AI Chatbot (Gemini)
- **Gemini-powered chatbot** — Real-time AI assistance for customers
- Integration with **gemini-1.5-flash** and **gemini-2.0-flash** models
- Chat context management with identity, order, and bullying detection
- Chat history with Supabase persistence

### 👤 User System
- User authentication with role-based access control
- Supplier management for product sourcing
- Review system for product feedback
- Notifications system for orders and updates

### 🖼️ Media & Storage
- **Supabase S3-compatible storage** for product images
- Local storage fallback when cloud storage is unavailable
- Image URL generation with deduplication

### 🛠️ Admin Panel
- Full admin dashboard with sidebar navigation
- Order management (pending, processing, completed)
- Product and inventory management
- User and supplier administration
- Activity logging and audit trails

### 🎨 UI/UX
- Decorative red header banners and branding elements
- Responsive mobile-first design
- Admin order count indicators
- Vite asset compilation with hot module replacement
