# Supabase Migration Guide

This guide covers migrating from Neon Database to Supabase for both **PostgreSQL Database** and **Object Storage (S3-compatible)**.

---

## Prerequisites

### 1. Enable PHP Zip Extension (Local Development)

For local development on Windows/XAMPP, enable the zip extension in `php.ini`:

```ini
; Find this line and remove the semicolon
extension=zip
```

Then restart Apache.

### 2. Install AWS S3 Flysystem Package

Run this command to install the required package:

```bash
composer require league/flysystem-aws-s3-v3 "^3.0"
```

---

## Step 1: Create a Supabase Project

1. Go to [https://supabase.com](https://supabase.com) and sign up/log in
2. Click **"New Project"**
3. Choose a name, password, and region (choose closest to your users)
4. Wait for the project to provision (~2 minutes)

---

## Step 2: Get Database Credentials

Navigate to: **Project Settings → Database**

You'll need:
- **Host**: `db.YOUR_PROJECT_REF.supabase.co`
- **Port**: `5432`
- **Database name**: `postgres`
- **User**: `postgres`
- **Password**: (the password you set during project creation)

---

## Step 3: Update `.env` for Database

Replace your current database configuration with:

```env
# =============================================================================
# SUPABASE DATABASE CONFIGURATION
# =============================================================================
DB_CONNECTION=pgsql
DB_HOST=db.YOUR_PROJECT_REF.supabase.co
DB_PORT=5432
DB_DATABASE=postgres
DB_USERNAME=postgres
DB_PASSWORD=YOUR_SUPABASE_DB_PASSWORD
DB_SSLMODE=require
```

> **Note**: Replace `YOUR_PROJECT_REF` with your actual Supabase project reference (found in the URL or Project Settings → General).

---

## Step 4: Create a Storage Bucket

1. Go to **Storage** in the left sidebar
2. Click **"New bucket"**
3. Name it: `products`
4. Toggle **"Public bucket"** to ON (for public product images)
5. Click **"Create bucket"**

---

## Step 5: Get Storage Credentials

Navigate to: **Project Settings → API**

You'll need:
- **Project URL**: `https://YOUR_PROJECT_REF.supabase.co`
- **Project Reference ID**: `YOUR_PROJECT_REF` (in the URL)
- **service_role key**: (under "Project API keys" - this is your secret key)

---

## Step 6: Update `.env` for Storage

Add these environment variables:

```env
# =============================================================================
# SUPABASE STORAGE CONFIGURATION (S3-Compatible)
# =============================================================================
AWS_ACCESS_KEY_ID=YOUR_PROJECT_REF
AWS_SECRET_ACCESS_KEY=YOUR_SERVICE_ROLE_KEY
AWS_DEFAULT_REGION=ap-southeast-1
AWS_BUCKET=products
AWS_ENDPOINT=https://YOUR_PROJECT_REF.supabase.co/storage/v1/s3
AWS_URL=https://YOUR_PROJECT_REF.supabase.co/storage/v1/object/public/products
AWS_USE_PATH_STYLE_ENDPOINT=true

FILESYSTEM_DISK=supabase
```

### Example with real values:

```env
AWS_ACCESS_KEY_ID=abcdefghijklmnop
AWS_SECRET_ACCESS_KEY=eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9...
AWS_DEFAULT_REGION=ap-southeast-1
AWS_BUCKET=products
AWS_ENDPOINT=https://abcdefghijklmnop.supabase.co/storage/v1/s3
AWS_URL=https://abcdefghijklmnop.supabase.co/storage/v1/object/public/products
AWS_USE_PATH_STYLE_ENDPOINT=true

FILESYSTEM_DISK=supabase
```

---

## Step 7: Run Migrations

After updating your `.env`, run migrations to create tables in Supabase:

```bash
php artisan migrate
```

---

## Step 8: Seed Data (Optional)

If you have seeders:

```bash
php artisan db:seed
```

---

## File Changes Summary

### `config/filesystems.php`

Added the `supabase` disk configuration:

```php
'supabase' => [
    'driver' => 's3',
    'key' => env('AWS_ACCESS_KEY_ID'),
    'secret' => env('AWS_SECRET_ACCESS_KEY'),
    'region' => env('AWS_DEFAULT_REGION', 'ap-southeast-1'),
    'bucket' => env('AWS_BUCKET', 'products'),
    'url' => env('AWS_URL'),
    'endpoint' => env('AWS_ENDPOINT'),
    'use_path_style_endpoint' => env('AWS_USE_PATH_STYLE_ENDPOINT', true),
    'visibility' => 'public',
    'throw' => true,
],
```

### `app/Http/Controllers/Admin/InventoryProductController.php`

Updated the `store()`, `update()`, and `destroy()` methods to:
- Upload images to Supabase Storage using the S3-compatible API
- Store the **full public URL** in the `image_path` database column
- Delete images from Supabase when products are deleted or images are replaced

---

## How It Works

### Image Upload Flow

1. User uploads an image via the product form
2. Laravel receives the file and uploads it to Supabase Storage:
   ```php
   Storage::disk('supabase')->put($storagePath, file_get_contents($file), 'public');
   ```
3. The public URL is constructed and saved to the database:
   ```php
   $imagePath = env('AWS_URL') . '/' . $storagePath;
   // Result: https://xxx.supabase.co/storage/v1/object/public/products/products/1234_image.jpg
   ```

### Image Display in Views

Since `image_path` now contains the full URL, you can use it directly:

```blade
<img src="{{ $product->image_path }}" alt="{{ $product->name }}">
```

Or with a fallback:

```blade
<img 
    src="{{ $product->image_path ?? asset('images/placeholder.png') }}" 
    alt="{{ $product->name }}"
>
```

---

## Render Deployment

For Render, add these environment variables in your Render dashboard:

| Variable | Value |
|----------|-------|
| `DB_CONNECTION` | `pgsql` |
| `DB_HOST` | `db.YOUR_PROJECT_REF.supabase.co` |
| `DB_PORT` | `5432` |
| `DB_DATABASE` | `postgres` |
| `DB_USERNAME` | `postgres` |
| `DB_PASSWORD` | `your-supabase-password` |
| `DB_SSLMODE` | `require` |
| `AWS_ACCESS_KEY_ID` | `YOUR_PROJECT_REF` |
| `AWS_SECRET_ACCESS_KEY` | `your-service-role-key` |
| `AWS_DEFAULT_REGION` | `ap-southeast-1` |
| `AWS_BUCKET` | `products` |
| `AWS_ENDPOINT` | `https://YOUR_PROJECT_REF.supabase.co/storage/v1/s3` |
| `AWS_URL` | `https://YOUR_PROJECT_REF.supabase.co/storage/v1/object/public/products` |
| `AWS_USE_PATH_STYLE_ENDPOINT` | `true` |
| `FILESYSTEM_DISK` | `supabase` |

---

## Migrating Existing Images

If you have existing products with images stored locally, you'll need to migrate them:

```php
// Run this in tinker or create an artisan command
use App\Models\Product;
use Illuminate\Support\Facades\Storage;

Product::whereNotNull('image_path')
    ->where('image_path', 'not like', 'http%')
    ->chunk(100, function ($products) {
        foreach ($products as $product) {
            $localPath = $product->image_path;
            
            // Check if local file exists
            if (Storage::disk('public')->exists($localPath)) {
                $contents = Storage::disk('public')->get($localPath);
                
                // Upload to Supabase
                $newPath = $localPath; // Keep same path structure
                Storage::disk('supabase')->put($newPath, $contents, 'public');
                
                // Update database with full URL
                $product->update([
                    'image_path' => env('AWS_URL') . '/' . $newPath
                ]);
                
                echo "Migrated: {$product->name}\n";
            }
        }
    });
```

---

## Troubleshooting

### "Could not connect to database"

1. Check that your IP is allowed in Supabase (Project Settings → Database → Connection Pooling)
2. Verify SSL mode is set to `require`
3. Double-check credentials

### "Unable to upload file"

1. Ensure the bucket exists and is set to **public**
2. Verify `AWS_USE_PATH_STYLE_ENDPOINT=true`
3. Check that `AWS_SECRET_ACCESS_KEY` contains the **service_role** key (not the anon key)

### "Images not displaying"

1. Confirm the bucket is public
2. Check that `AWS_URL` matches your bucket configuration
3. Verify the stored `image_path` is a valid URL

---

## Security Notes

- **Never expose `service_role` key** to the client/frontend
- The `service_role` key bypasses Row Level Security (RLS) - use only server-side
- For public buckets, images are accessible to anyone with the URL
- Consider using signed URLs for private/sensitive files

---

## Free Tier Limits (Supabase)

- **Database**: 500 MB
- **Storage**: 1 GB
- **Bandwidth**: 2 GB/month
- **API Requests**: Unlimited (within fair use)

Monitor usage at: **Project Settings → Usage**
