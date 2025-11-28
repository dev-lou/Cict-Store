# Ctrl+P — CICT Student Council Merchandise & Services Platform

Ctrl+P is a full-stack, Laravel-based e-commerce and services platform built for the CICT Student Council. It enables product cataloging, inventory management, order processing, and an AI-powered customer support assistant (Gemini). This README is focused on the developer workflow for setting up, contributing, and safely deploying the application.

---

## Project Title & Description

- Title: Ctrl+P
- Description: A modern web application that manages student council merchandise and printing services with a polished admin dashboard, customer-facing store, secure checkout, and an AI chat assistant for support.

This project includes product and inventory management, order processing, user management, notifications, and a Gemini-based chatbot integration for helpful answers and customer support.

---

## Tech Stack

- PHP 8.2+, Laravel 11
- Composer for PHP dependencies
- MySQL / PostgreSQL (Neon or Supabase for production)
- JavaScript, Vite, Alpine.js
- Tailwind CSS for styling
- Docker for containerized deployments
- Hosting: Render (Docker) examples provided
- Google Gemini — AI assistant

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

The project uses `.env` for all local and deployment settings. The `.env.example` file lists all environment variable names and default values (if any). To protect your secrets and credentials, follow these rules:

- Copy `.env.example` to `.env` and fill in values (API keys, database connection, etc.).
- NEVER commit `.env` to the repository or push it to any shared repos. The `.gitignore` is already configured to ignore `.env` and common sensitive files.
- Use the `.env.example` with placeholders for onboarding new developers.

Common variables (example placeholders in `.env.example`)
- `APP_NAME`, `APP_ENV`, `APP_KEY`, `APP_URL`
- `DB_CONNECTION`, `DB_HOST`, `DB_DATABASE`, `DB_USERNAME`, `DB_PASSWORD` or `DATABASE_URL`
- `SUPABASE` / `AWS_*` keys, `FILESYSTEM_DISK` (if using Supabase storage)
- `SUPABASE_SERVICE_ROLE_KEY` and `SUPABASE_ANON_KEY` (server & client keys)
- `GEMINI_API_KEY` and `GEMINI_MODEL` for the Gemini integration

Bold Warning:
**DO NOT COMMIT** your `.env` with secrets to the repository or any CI/CD logs. If sensitive keys are ever committed, rotate them immediately.

---

## Development Workflow

- Branch from `main` for new features or bug fixes following your repo's branching & PR conventions.
- Use `composer` and `npm` scripts for code style & tests.
- Add any environment-specific configuration to the `.env` file and include a corresponding `.env.example` entry for devs.

Helpful commands

```bash
# Clear caches
php artisan cache:clear
php artisan config:clear
php artisan view:clear

# Migrations & seeds
php artisan migrate --seed

# Run tests
composer test
```

---

## Deployment Notes

This repo has Docker assets and examples for deploying on Render. A typical Docker-based deployment involves building images, setting runtime environment variables in Render, and running `php artisan migrate --force` during their deploy lifecycle.

Key deployment reminders
- Ensure environment variables for production are configured with secret values in your platform's environment store (Render Dashboard, GitHub Secrets, etc.).
- Rotate API keys if they were ever stored in the repo.
- For Gemini API usage: confirm model & key are valid for your account and the key is restricted according to your security policy.

---

## Security & Best Practices

- Do not store `APP_KEY`, `GEMINI_API_KEY`, `AWS_SECRET_ACCESS_KEY`, or DB credentials in source control.
- Use secure secret storage or environment variable management in production (Render Secrets, AWS Secrets Manager, Google Secret Manager).
- Add pre-commit or CI checks for secrets scanning (e.g., `gitleaks`, `git-secrets`) and ensure PR pipelines fail on discovery.
- Disable debug output in production (`APP_DEBUG=false`).

---

## Contributing

Please follow the `CONTRIBUTING.md` guidelines if one exists in the repo. Otherwise:

1. Fork the repository and create a feature branch from `main`.
2. Implement changes and add tests where applicable.
3. Run static linters, tests, and create a PR describing your changes.
4. A reviewer will review, and after approval, it can be merged to `main`.

---

## License

MIT — see `LICENSE` for details.

---

If you need any help setting up or running, open an issue or reach out to the repository owner.

**Thank you — built with care for the CICT Student Council.**
# 🛒 Ctrl+P - CICT Student Council Merchandise & Services Platform

[![Laravel](https://img.shields.io/badge/Laravel-11.x-FF2D20?style=flat&logo=laravel)](https://laravel.com)
[![Vite](https://img.shields.io/badge/Vite-7.0-646CFF?style=flat&logo=vite)](https://vitejs.dev)
[![Tailwind CSS](https://img.shields.io/badge/Tailwind-4.0-38B2AC?style=flat&logo=tailwind-css)](https://tailwindcss.com)
[![License](https://img.shields.io/badge/License-MIT-green.svg)](LICENSE)

A modern, full-stack e-commerce platform built for the **CICT Student Council** to manage merchandise sales and printing services. Features include real-time inventory management, order tracking, AI-powered chatbot support, and comprehensive admin dashboard.

---

## ✨ Features

### 🛍️ Customer Features
- **Browse Products** - View merchandise and printing services with variant selection (size, color)
- **Shopping Cart** - Add items, adjust quantities, and manage cart with real-time price updates
- **Secure Checkout** - Enter shipping address and payment details
- **Order Tracking** - View order history with status updates (Pending → Processing → Completed)
- **User Profile** - Manage personal information and profile picture
- **Notifications** - Receive order status updates
- **AI Chatbot** - Get instant support via Gemini-powered assistant

### 🔧 Admin Features
- **Inventory Management** - Track stock levels, add/edit products, manage variants
- **Order Management** - Update order statuses, view customer details
- **Analytics Dashboard** - Sales reports, revenue tracking, low-stock alerts
- **User Management** - Manage customer accounts, assign roles (Admin/Staff/Customer)
- **Audit Logs** - Track all system changes with full audit trail

---

## 🚀 Tech Stack

| Technology | Version | Purpose |
|------------|---------|---------|
| **Laravel** | 11.x | Backend framework (MVC, ORM, routing) |
| **PHP** | 8.2+ | Server-side language |
| **Vite** | 7.0 | Frontend build tool (HMR, minification) |
| **Tailwind CSS** | 4.0 | Utility-first CSS framework |
| **Alpine.js** | 3.x | Lightweight JavaScript framework |
| **MySQL** | 8.0+ | Relational database |
| **PostgreSQL** | 13+ | Production database (Neon) |
| **Gemini API** | 2.0 | AI chatbot integration (Google) |
| **Docker** | - | Containerized deployment |
| **Render** | - | Cloud hosting platform |

---

## 📦 Installation & Setup

### Prerequisites
- PHP 8.2 or higher
- Composer
- Node.js 18+ & npm
- MySQL 8.0+ or PostgreSQL 13+

### Step 1: Clone Repository
```bash
git clone https://github.com/your-username/ctrl-p.git
cd ctrl-p
```

### Step 2: Install Dependencies
```bash
# Install PHP dependencies
composer install

# Install Node.js dependencies
npm install
```

### Step 3: Environment Configuration
```bash
# Copy environment file
cp .env.example .env

# Generate application key
php artisan key:generate
```

### Step 4: Configure `.env` File
```env
APP_NAME="Ctrl+P"
APP_ENV=local
APP_KEY=base64:YOUR_GENERATED_KEY
APP_DEBUG=true
APP_URL=http://localhost:8000

# Database Configuration
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=laravel_igp
DB_USERNAME=root
DB_PASSWORD=

# Gemini AI Chatbot
GEMINI_API_KEY=your-gemini-api-key-here
GEMINI_MODEL=gemini-2.0-flash
```

**Get Gemini API Key:** [Google AI Studio](https://aistudio.google.com/app/apikey)

### Step 5: Database Setup
```bash
# Run migrations
php artisan migrate

# (Optional) Seed demo data
php artisan db:seed
```

### Step 6: Build Frontend Assets
```bash
# Development build with hot reload
npm run dev

# Production build (minified)
npm run build:production
```

### Step 7: Run Application
```bash
# Start Laravel development server
php artisan serve

# Application will run at: http://localhost:8000
```

---

## 🐳 Deployment to Render (Docker)

### Step 1: Push to GitHub
```bash
git add .
git commit -m "Prepare for Docker deployment"
git push origin main
```

### Step 2: Create Render Web Service
1. Go to [Render Dashboard](https://dashboard.render.com)
2. Click **New** → **Web Service**
3. Connect your GitHub repository
4. Configure:
   - **Environment**: Docker
   - **Branch**: main
   - **Instance Type**: Free or Starter

### Step 3: Configure Environment Variables
In Render dashboard (Environment → Environment Variables):

```env
APP_NAME="Ctrl+P"
APP_ENV=production
APP_DEBUG=false
APP_KEY=base64:YOUR_PRODUCTION_KEY
APP_URL=https://your-app.onrender.com

# Database (Neon PostgreSQL)
DB_CONNECTION=pgsql
DATABASE_URL=postgresql://user:pass@host/db?sslmode=require

# Gemini API
GEMINI_API_KEY=your-production-gemini-key
GEMINI_MODEL=gemini-2.0-flash

# Session & Cache
SESSION_DRIVER=database
CACHE_STORE=database
```

### Step 4: Run Migrations
After deployment, open **Shell** in Render dashboard:
```bash
php artisan migrate --force
php artisan db:seed --force  # Optional
```

### Local Docker Testing
```bash
# Build the image
docker build -t ctrl-p .

# Run the container
docker run -p 8080:80 --env-file .env ctrl-p

# Access at http://localhost:8080
```

---

## 📂 Project Structure

```
ctrl-p/
├── app/
│   ├── Http/
│   │   ├── Controllers/         # Business logic
│   │   └── Middleware/          # Request filters
│   ├── Models/                  # Database models
│   ├── Services/                # Business logic helpers
│   └── Providers/               # Service providers
├── database/
│   ├── migrations/              # Database schema
│   └── seeders/                 # Sample data
├── resources/
│   ├── views/                   # Blade templates
│   ├── css/                     # Tailwind styles
│   └── js/                      # Alpine.js components
├── routes/
│   └── web.php                  # Application routes
├── public/
│   ├── build/                   # Compiled assets (Vite)
│   ├── images/                  # Static images
│   └── storage/                 # Symlink to storage/app/public
├── .env.example                 # Environment template
├── Dockerfile                   # Docker configuration for Render
├── .dockerignore                # Docker build exclusions
└── composer.json                # PHP dependencies
```

---

## 🎨 Key Features Walkthrough

### Shopping Flow
1. **Browse Products** → Customer views merchandise catalog
2. **Add to Cart** → Select product variants (size, color)
3. **Checkout** → Enter shipping address and payment method
4. **Order Confirmation** → Receive order number and status updates

### Admin Workflow
1. **Dashboard** → View sales analytics and low-stock alerts
2. **Inventory** → Add/edit products, manage stock levels
3. **Orders** → Update order statuses (Pending → Processing → Completed)
4. **Audit Logs** → Track all system changes

### AI Chatbot
- **Gemini 2.0 Flash** integration for customer support
- Answers questions about orders, products, and navigation
- Security-hardened system prompt (no jailbreak vulnerabilities)
- Real-time response with typing indicators

---

## 🔒 Security Features

- ✅ **CSRF Protection** - Laravel's built-in token validation
- ✅ **SQL Injection Prevention** - Eloquent ORM parameterized queries
- ✅ **XSS Protection** - Blade template escaping
- ✅ **Role-Based Access Control** - Admin/Staff/Customer permissions
- ✅ **Audit Logging** - Track all database changes
- ✅ **Password Hashing** - Bcrypt with 12 rounds
- ✅ **Session Security** - HTTP-only cookies, HTTPS enforcement

---

## 📊 Database Schema

### Core Tables
- `users` - Customer accounts with role-based access
- `products` - Merchandise and services catalog
- `product_variants` - Size/color options for products
- `orders` - Customer order records
- `order_items` - Line items for each order
- `inventory_history` - Stock movement tracking
- `audit_logs` - System change history

---

## 🛠️ Development Scripts

```bash
# Development server with hot reload
npm run dev
php artisan serve

# Production build
npm run build:production

# Run database migrations
php artisan migrate

# Seed demo data
php artisan db:seed

# Clear application cache
php artisan cache:clear
php artisan config:clear
php artisan route:clear
php artisan view:clear

# Code quality checks
composer check:route-params  # Validate route parameters
```

---

## 🐛 Troubleshooting

### Issue: Assets Not Loading
```bash
npm run build:production
php artisan cache:clear
```

### Issue: Docker Build Failed
```bash
# Rebuild without cache
docker build --no-cache -t ctrl-p .

# Check build logs for missing dependencies
```

### Issue: Database Connection Failed
```bash
# Verify database credentials in .env
php artisan tinker
>>> DB::connection()->getPdo();
```

### Issue: Render 502/504 Error
```bash
# Check logs in Render dashboard
# Ensure DATABASE_URL is set correctly
# Verify APP_KEY is generated
```

---

## 📄 License

This project is licensed under the **MIT License** - see the [LICENSE](LICENSE) file for details.

---

## 👨‍💻 Author

**Lou Vincent Baroro**  
CICT Student Council - Information Systems Developer

---

## 🙏 Acknowledgments

- **Laravel** - PHP framework
- **Tailwind CSS** - Utility-first CSS
- **Google Gemini** - AI chatbot integration
- **Render** - Cloud hosting platform
- **Neon** - Serverless PostgreSQL

---

## 📞 Support

For issues or questions:
- Open an issue on GitHub
- Contact CICT Student Council office
- Email: support@ctrl-p.com

---

**Built with ❤️ for the CICT Student Council**
