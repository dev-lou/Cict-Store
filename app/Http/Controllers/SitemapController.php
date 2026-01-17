<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Log;

class SitemapController extends Controller
{
    public function index()
    {
        try {
            $products = Product::where('is_active', true)->get();

            $sitemap = '<?xml version="1.0" encoding="UTF-8"?>' . "\n";
            $sitemap .= '<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">' . "\n";

            // Static pages with priority and change frequency
            $staticPages = [
                ['url' => url('/'), 'priority' => '1.0', 'changefreq' => 'daily'],
                ['url' => url('/shop'), 'priority' => '0.9', 'changefreq' => 'daily'],
                ['url' => url('/services'), 'priority' => '0.8', 'changefreq' => 'weekly'],
                ['url' => url('/contact'), 'priority' => '0.7', 'changefreq' => 'monthly'],
                ['url' => url('/login'), 'priority' => '0.5', 'changefreq' => 'monthly'],
                ['url' => url('/register'), 'priority' => '0.5', 'changefreq' => 'monthly'],
            ];

            foreach ($staticPages as $page) {
                $sitemap .= $this->generateUrlEntry($page['url'], $page['priority'], $page['changefreq']);
            }

            // Product pages
            foreach ($products as $product) {
                $sitemap .= $this->generateUrlEntry(
                    url('/shop/' . $product->id),
                    '0.8',
                    'weekly',
                    $product->updated_at
                );
            }

            $sitemap .= '</urlset>';

            return response($sitemap, 200)
                ->header('Content-Type', 'application/xml')
                ->header('Cache-Control', 'public, max-age=3600');
                
        } catch (\Exception $e) {
            Log::error('Sitemap generation failed: ' . $e->getMessage());
            
            // Return a minimal valid sitemap
            $fallbackSitemap = '<?xml version="1.0" encoding="UTF-8"?>' . "\n";
            $fallbackSitemap .= '<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">' . "\n";
            $fallbackSitemap .= "  <url>\n";
            $fallbackSitemap .= "    <loc>" . url('/') . "</loc>\n";
            $fallbackSitemap .= "    <lastmod>" . now()->format('Y-m-d') . "</lastmod>\n";
            $fallbackSitemap .= "    <changefreq>daily</changefreq>\n";
            $fallbackSitemap .= "    <priority>1.0</priority>\n";
            $fallbackSitemap .= "  </url>\n";
            $fallbackSitemap .= '</urlset>';
            
            return response($fallbackSitemap, 200)
                ->header('Content-Type', 'application/xml');
        }
    }

    private function generateUrlEntry($url, $priority, $changefreq, $lastmod = null)
    {
        $entry = "  <url>\n";
        $entry .= "    <loc>" . htmlspecialchars($url, ENT_XML1, 'UTF-8') . "</loc>\n";
        
        if ($lastmod) {
            $entry .= "    <lastmod>" . $lastmod->format('Y-m-d') . "</lastmod>\n";
        } else {
            $entry .= "    <lastmod>" . now()->format('Y-m-d') . "</lastmod>\n";
        }
        
        $entry .= "    <changefreq>{$changefreq}</changefreq>\n";
        $entry .= "    <priority>{$priority}</priority>\n";
        $entry .= "  </url>\n";

        return $entry;
    }
}
