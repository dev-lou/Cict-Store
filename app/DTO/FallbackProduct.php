<?php

namespace App\DTO;

use Illuminate\Support\Collection;

/**
 * A lightweight data object that mimics the properties and minimal methods
 * expected by views and controllers when a DB-based Product model isn't available.
 */
class FallbackProduct
{
    public $id;
    public $name;
    public $slug;
    public $description;
    public $base_price;
    public $current_stock;
    public $low_stock_threshold;
    public $status;
    public $image_path; // Local storage path
    public $image_url; // Full public URL
    public $variants; // Collection of variant stdClass or arrays

    public function __construct($data)
    {
        // Accept either stdClass or array
        $arr = is_array($data) ? $data : (array) $data;
        $this->id = $arr['id'] ?? ($arr['ID'] ?? null);
        $this->name = $arr['name'] ?? '';
        $this->slug = $arr['slug'] ?? '';
        $this->description = $arr['description'] ?? '';
        $this->base_price = isset($arr['base_price']) ? (float)$arr['base_price'] : 0.0;
        $this->current_stock = isset($arr['current_stock']) ? (int)$arr['current_stock'] : 0;
        $this->low_stock_threshold = isset($arr['low_stock_threshold']) ? (int)$arr['low_stock_threshold'] : 20; // default
        $this->status = $arr['status'] ?? 'inactive';
        $this->image_path = $arr['image_path'] ?? null;
        $this->image_url = $arr['image_url'] ?? null;
        // If image_path seems to be a full URL, set image_url
        if (!$this->image_url && $this->image_path && (str_starts_with($this->image_path, 'http://') || str_starts_with($this->image_path, 'https://'))) {
            $this->image_url = $this->image_path;
            $this->image_path = null;
        }
        // Map variants to Collection of stdClass
        $variants = $arr['variants'] ?? [];
        if ($variants instanceof Collection) {
            $this->variants = $variants;
        } else {
            $this->variants = collect($variants)->map(fn($v) => (object)$v);
        }
    }

    // Provide compatibility methods used in some controllers/views
    public function reviews()
    {
        return collect([]);
    }

    public function averageRating()
    {
        return 0;
    }
}
