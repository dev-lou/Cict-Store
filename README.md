# Laravel IGP — E-Commerce Platform

[![License: MIT](https://img.shields.io/badge/License-MIT-green.svg)](LICENSE)
[![Laravel 11](https://img.shields.io/badge/Laravel-11.46.1-FF2D20?style=flat&logo=laravel)](https://laravel.com)
[![PHP 8.2](https://img.shields.io/badge/PHP-8.2.12-8892BF?style=flat&logo=php)](https://www.php.net)
[![PostgreSQL](https://img.shields.io/badge/PostgreSQL-16-336791?style=flat&logo=postgresql)](https://www.postgresql.org)
[![Vite](https://img.shields.io/badge/Vite-5.0-646CFF?style=flat&logo=vite)](https://vitejs.dev)
[![Tailwind](https://img.shields.io/badge/Tailwind-3.4-38B2AC?style=flat&logo=tailwind-css)](https://tailwindcss.com)

A modern, high-performance e-commerce platform built with Laravel 11 for merchandise management, order processing, and customer service. Features include advanced inventory management, real-time notifications, AI-powered chatbot support, and comprehensive admin controls.

---

## 🚀 Overview

Laravel IGP is a full-featured e-commerce solution designed for scalability and performance. The platform provides seamless shopping experiences for customers while offering powerful management tools for administrators.

### Key Features

**Customer Experience**
- 🛍️ **Product Catalog** — Browse products with advanced filtering, sorting, and search
- 🛒 **Shopping Cart** — Real-time cart management with session persistence
- 📦 **Order Tracking** — Monitor order status from placement to delivery
- ⭐ **Reviews & Ratings** — Verified purchase reviews with photo uploads
- 💬 **AI Chatbot** — Google Gemini-powered support assistant
- 📱 **Mobile Responsive** — Optimized for all devices with lazy loading
- 🔔 **Notifications** — Real-time order updates and status changes

**Admin Dashboard**
- 📊 **Analytics** — Sales reports, revenue tracking, and performance metrics
- 📦 **Inventory Management** — Product variants, stock tracking, low stock alerts
- 🛍️ **Order Management** — Process orders, update status, manage fulfillment
- 👥 **User Management** — Customer accounts, roles, and permissions
- 🎨 **Product Editor** — Rich product management with Supabase image storage
- 📈 **Audit Logs** — Complete activity tracking for accountability
- 🔐 **Security** — IP blocking, rate limiting, and session management

**Performance Optimizations**
- ⚡ **Query Caching** — 5-10 minute TTL for frequently accessed data
- 🗄️ **Database Indexes** — Optimized queries for reviews, products, notifications
- 🖼️ **Image Optimization** — Lazy loading with priority hints
- 📦 **Smart Cache Invalidation** — Automatic cache clearing on updates
- 🚀 **95+ Performance Score** — Optimized for speed on both admin and customer pages

---

## 🛠️ Tech Stack

| Component | Technology |
|-----------|-----------|
| **Backend** | Laravel 11.46.1 (PHP 8.2.12) |
| **Database** | PostgreSQL 16 (Neon/Supabase) |
| **Frontend** | Vite 5.0, Alpine.js 3.x, Tailwind CSS 3.4 |
| **Storage** | Supabase S3-compatible storage |
| **Cache** | Database driver with query result caching |
| **AI Integration** | Google Gemini API |
| **UI Components** | SweetAlert2 11.10.0 |
| **Deployment** | Docker, Render, CloudFlare CDN |

---

## 📋 Prerequisites

Before installation, ensure you have:

- **PHP** 8.2 or higher
  - Extensions: `pdo`, `pdo_pgsql`, `mbstring`, `openssl`, `zlib`, `curl`, `xml`
- **Composer** 2.x
- **Node.js** 18+ and npm
- **PostgreSQL** 14+ (or Supabase/Neon cloud database)
- **Git** for version control
- **Docker** (optional, for containerized deployment)

---

## ⚙️ Installation

### 1. Clone the Repository

```bash
git clone https://github.com/your-username/laravel_igp.git
cd laravel_igp
```

### 2. Install Dependencies

```bash
# Install PHP dependencies
composer install

# Install Node.js dependencies
npm install
```

### 3. Environment Configuration

```bash
# Copy environment file
cp .env.example .env

# Generate application key
php artisan key:generate
```

### 4. Configure Environment Variables

Edit `.env` with your database and service credentials:

```env
# Application
APP_NAME="Laravel IGP"
APP_ENV=production
APP_KEY=base64:your-generated-key
APP_DEBUG=false
APP_URL=https://your-domain.com

# Database (PostgreSQL)
DB_CONNECTION=pgsql
DB_HOST=your-database-host.neon.tech
DB_PORT=5432
DB_DATABASE=your_database_name
DB_USERNAME=your_username
DB_PASSWORD=your_password

# Supabase Storage
AWS_ACCESS_KEY_ID=your_supabase_access_key
AWS_SECRET_ACCESS_KEY=your_supabase_secret_key
AWS_DEFAULT_REGION=us-east-1
AWS_BUCKET=products
AWS_ENDPOINT=https://your-project.supabase.co/storage/v1/s3
AWS_URL=https://your-project.supabase.co/storage/v1/object/public/products

# Google Gemini AI
GEMINI_API_KEY=your_gemini_api_key
GEMINI_MODEL=gemini-3-flash-preview

# Cache & Session
CACHE_STORE=database
SESSION_DRIVER=database
QUEUE_CONNECTION=database
```

### 5. Database Setup

```bash
# Run migrations
php artisan migrate --force

# (Optional) Seed sample data
php artisan db:seed
```

### 6. Build Assets

```bash
# Development
npm run dev

# Production
npm run build
```

### 7. Storage Setup

```bash
# Create storage symlink
php artisan storage:link

# Set proper permissions (Linux/Mac)
chmod -R 775 storage bootstrap/cache
```

### 8. Start Development Server

```bash
# Start PHP server
php artisan serve --host=0.0.0.0 --port=8000

# In another terminal, start Vite
npm run dev
```

Visit `http://localhost:8000` to access the application.

---

## 🐳 Docker Deployment

### Local Development with Docker

```bash
# Build the image
docker build -t laravel-igp .

# Run the container
docker run -d \
  -p 8000:8000 \
  --env-file .env \
  --name laravel-igp \
  laravel-igp

# Run migrations
docker exec laravel-igp php artisan migrate --force
```

### Docker Compose

```yaml
version: '3.8'

services:
  app:
    build: .
    ports:
      - "8000:8000"
    env_file:
      - .env
    volumes:
      - ./storage:/var/www/html/storage
    depends_on:
      - postgres

  postgres:
    image: postgres:16
    environment:
      POSTGRES_DB: laravel_igp
      POSTGRES_USER: laravel
      POSTGRES_PASSWORD: secret
    volumes:
      - postgres_data:/var/lib/postgresql/data

volumes:
  postgres_data:
```

Run with: `docker-compose up -d`

---

## 🚢 Production Deployment

### Render Deployment

1. **Create New Web Service** on Render dashboard
2. **Connect GitHub repository**
3. **Configure Build Settings:**
   - Build Command: `composer install && npm install && npm run build`
   - Start Command: `php artisan serve --host=0.0.0.0 --port=${PORT}`
4. **Add Environment Variables** (copy from `.env`)
5. **Deploy!**

### Post-Deployment Steps

```bash
# SSH into production server
render shell

# Run migrations
php artisan migrate --force

# Clear caches
php artisan cache:clear
php artisan config:clear
php artisan route:clear
php artisan view:clear

# Optimize for production
php artisan config:cache
php artisan route:cache
php artisan view:cache
```

---

## 🔧 Configuration

### Cache Configuration

The application uses database caching for optimal performance:

- **Shop Listings:** 5-minute TTL
- **Product Details:** On-demand with smart invalidation
- **Featured Products:** 10-minute TTL
- **Related Products:** 10-minute TTL

Cache is automatically cleared when:
- Products are created/updated/deleted
- Orders are placed
- Inventory is adjusted

### Performance Indexes

The following database indexes are created for optimal query performance:

```sql
-- Reviews
CREATE INDEX reviews_product_rating_idx ON reviews (product_id, rating);
CREATE INDEX reviews_user_product_idx ON reviews (user_id, product_id);

-- Products
CREATE INDEX products_name_idx ON products (name);
CREATE INDEX products_badge_idx ON products (badge_text);

-- Notifications
CREATE INDEX notifications_user_created_idx ON notifications (user_id, created_at);
```

### Security Configuration

```env
# Rate Limiting
RATE_LIMIT_PER_MINUTE=60

# Session Security
SESSION_SECURE_COOKIE=true
SESSION_SAME_SITE=lax
SESSION_LIFETIME=120

# Debug Mode (NEVER enable in production)
APP_DEBUG=false
```

---

## 👨‍💻 Development Workflow

### Common Commands

```bash
# Clear all caches
php artisan optimize:clear

# View routes
php artisan route:list

# Generate IDE helper (for autocomplete)
php artisan ide-helper:generate

# Run queue worker
php artisan queue:work

# Monitor logs
tail -f storage/logs/laravel.log
```

### Code Quality

```bash
# Run tests
php artisan test

# Code formatting (if configured)
./vendor/bin/pint

# Static analysis (if configured)
./vendor/bin/phpstan analyse
```

### Git Workflow

```bash
# Create feature branch
git checkout -b feature/your-feature-name

# Make changes and commit
git add .
git commit -m "Description of changes"

# Push to GitHub
git push origin feature/your-feature-name

# Create Pull Request on GitHub
```

---

## 📁 Project Structure

```
laravel_igp/
├── app/
│   ├── Console/          # Artisan commands
│   ├── Http/
│   │   ├── Controllers/  # Request handlers
│   │   ├── Middleware/   # HTTP middleware
│   │   └── Requests/     # Form requests
│   ├── Models/           # Eloquent models
│   ├── Services/         # Business logic
│   └── Traits/           # Reusable traits
├── config/               # Configuration files
├── database/
│   ├── migrations/       # Database migrations
│   ├── seeders/          # Database seeders
│   └── factories/        # Model factories
├── public/               # Public assets
│   ├── css/
│   ├── js/
│   └── images/
├── resources/
│   ├── css/              # Source CSS (Tailwind)
│   ├── js/               # Source JavaScript
│   └── views/            # Blade templates
├── routes/
│   ├── web.php           # Web routes
│   ├── api.php           # API routes
│   └── console.php       # Console routes
├── storage/              # Generated files
│   ├── app/
│   ├── framework/
│   └── logs/
├── tests/                # Test files
├── .env.example          # Environment template
├── composer.json         # PHP dependencies
├── package.json          # Node dependencies
├── Dockerfile            # Docker configuration
└── README.md             # This file
```

---

## 🔌 API Documentation

### Public Endpoints

#### Products
```http
GET /shop                     # Product listing with filters
GET /shop/product/{slug}      # Product details
POST /cart/add                # Add to cart
GET /cart                     # View cart
```

#### Orders
```http
POST /checkout                # Place order
GET /orders                   # User orders
GET /orders/{id}              # Order details
```

#### Reviews
```http
POST /reviews                 # Submit review
GET /products/{id}/reviews    # Product reviews
```

### Admin Endpoints

```http
GET /admin/dashboard          # Admin dashboard
GET /admin/inventory          # Product management
GET /admin/orders             # Order management
GET /admin/users              # User management
GET /admin/analytics          # Sales analytics
```

---

## 🐛 Troubleshooting

### Common Issues

**Issue: "Class not found" error**
```bash
composer dump-autoload
php artisan clear-compiled
```

**Issue: "Permission denied" on storage**
```bash
chmod -R 775 storage bootstrap/cache
chown -R www-data:www-data storage bootstrap/cache
```

**Issue: "SQLSTATE connection refused"**
- Verify database credentials in `.env`
- Check if PostgreSQL is running
- Confirm firewall rules allow connection

**Issue: Images not uploading**
- Verify Supabase credentials in `.env`
- Check bucket permissions (public access)
- Confirm storage disk configuration in `config/filesystems.php`

**Issue: Cache not clearing**
```bash
php artisan cache:clear
php artisan config:clear
php artisan route:clear
php artisan view:clear
```

---

## 📊 Performance Monitoring

### Expected Performance Metrics

| Page Type | Load Time | Database Queries | Performance Score |
|-----------|-----------|------------------|-------------------|
| Homepage | <1s | 2-3 (cached) | 95+ |
| Shop Listing | <1s | 1-2 (cached) | 95+ |
| Product Detail | <1.5s | 3-4 | 90+ |
| Admin Dashboard | <2s | 5-8 | 95+ |

### Monitoring Tools

```bash
# Enable query logging
DB_LOG_QUERIES=true

# View slow queries
php artisan telescope:install  # Optional
```

---

## 🤝 Contributing

We welcome contributions! Please follow these guidelines:

1. **Fork the repository**
2. **Create a feature branch** (`git checkout -b feature/amazing-feature`)
3. **Commit your changes** (`git commit -m 'Add amazing feature'`)
4. **Push to the branch** (`git push origin feature/amazing-feature`)
5. **Open a Pull Request**

### Coding Standards

- Follow PSR-12 coding standards
- Write descriptive commit messages
- Add tests for new features
- Update documentation as needed
- Keep PRs focused and atomic

---

## 📝 License

This project is licensed under the MIT License - see the [LICENSE](LICENSE) file for details.

---

## 👥 Credits

**Developed by:** Laravel IGP Team  
**Contact:** support@laravel-igp.com

### Built With

- [Laravel](https://laravel.com) - The PHP Framework
- [Tailwind CSS](https://tailwindcss.com) - Utility-first CSS
- [Alpine.js](https://alpinejs.dev) - Lightweight JavaScript framework
- [Vite](https://vitejs.dev) - Next generation frontend tooling
- [Google Gemini](https://ai.google.dev) - AI integration
- [Supabase](https://supabase.com) - Open source Firebase alternative

---

## 📞 Support

For support and questions:

- 🐛 Issues: [GitHub Issues](https://github.com/your-username/laravel_igp/issues)
- 📖 Documentation: [Project Wiki](https://github.com/your-username/laravel_igp/wiki)

---

## 🗺️ Roadmap

- [ ] Multi-language support
- [ ] PayPal/Stripe payment gateway integration
- [ ] Advanced analytics dashboard
- [ ] Email marketing integration
- [ ] Mobile app (React Native)
- [ ] Wishlist functionality
- [ ] Product recommendations engine
- [ ] Live chat support

---

**⭐ If you find this project useful, please consider giving it a star on GitHub!**

---

*Last Updated: January 21, 2026*
