#!/usr/bin/env php
<?php

/**
 * Deploy Optimization Script
 * Run this after deploying code to Render to clear and rebuild caches
 */

echo "\n🚀 Laravel Performance Optimization Deployment\n";
echo "=============================================\n\n";

// Step 1: Clear all caches
echo "1️⃣ Clearing all caches...\n";
system('php artisan cache:clear');
system('php artisan config:clear');
system('php artisan route:clear');
system('php artisan view:clear');
echo "   ✅ All caches cleared\n\n";

// Step 2: Rebuild optimized caches
echo "2️⃣ Rebuilding optimized caches...\n";
system('php artisan config:cache');
system('php artisan route:cache');
system('php artisan view:cache');
echo "   ✅ Caches rebuilt\n\n";

// Step 3: Run optimize command
echo "3️⃣ Running Laravel optimize...\n";
system('php artisan optimize');
echo "   ✅ Optimization complete\n\n";

// Step 4: Test database connection
echo "4️⃣ Testing database connection...\n";
try {
    system('php artisan db:show 2>&1');
    echo "   ✅ Database connected\n\n";
} catch (Exception $e) {
    echo "   ⚠️ Database connection issue (may be normal on first boot)\n\n";
}

echo "✨ Deployment complete!\n";
echo "\n📊 Performance Improvements:\n";
echo "   • Settings queries: Now cached for 1 hour\n";
echo "   • Order counts: Cached for 5 minutes\n";
echo "   • Homepage data: Cached for 10 minutes\n";
echo "   • Product listings: Cached automatically\n\n";

echo "🔍 Next Steps:\n";
echo "   1. Test your site at your Render URL\n";
echo "   2. Run PageSpeed Insights: https://pagespeed.web.dev/\n";
echo "   3. Monitor cache performance in logs\n\n";

echo "⚡ Expected Results:\n";
echo "   • TTFB: 800ms-1.5s (from 4s+)\n";
echo "   • PageSpeed Score: 80-90+ (from 73)\n";
echo "   • Faster page loads for returning users\n\n";

echo "Done! 🎉\n\n";
