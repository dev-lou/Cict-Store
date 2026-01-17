<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Response;

class SitemapController extends Controller
{
    public function index()
    {
        $products = Product::where('is_active', true)->get();

        $sitemap = '<?xml version="1.0" encoding="UTF-8"?>' . "\n";
        $sitemap .= '<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">' . "\n";

        // Static pages with priority and change frequency
        $staticPages = [
            ['url' => route('home'), 'priority' => '1.0', 'changefreq' => 'daily'],
            ['url' => route('shop.index'), 'priority' => '0.9', 'changefreq' => 'daily'],
            ['url' => route('services.index'), 'priority' => '0.8', 'changefreq' => 'weekly'],
            ['url' => route('contact.index'), 'priority' => '0.7', 'changefreq' => 'monthly'],
            ['url' => route('login'), 'priority' => '0.5', 'changefreq' => 'monthly'],
            ['url' => route('register'), 'priority' => '0.5', 'changefreq' => 'monthly'],
        ];

        foreach ($staticPages as $page) {
            $sitemap .= $this->generateUrlEntry($page['url'], $page['priority'], $page['changefreq']);
        }

        // Product pages
        foreach ($products as $product) {
            $sitemap .= $this->generateUrlEntry(
                route('shop.show', $product->id),
                '0.8',
                'weekly',
                $product->updated_at
            );
        }

        $sitemap .= '</urlset>';

        return response($sitemap, 200)
            ->header('Content-Type', 'application/xml');
    }

    private function generateUrlEntry($url, $priority, $changefreq, $lastmod = null)
    {
        $entry = "  <url>\n";
        $entry .= "    <loc>" . htmlspecialchars($url) . "</loc>\n";
        
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
