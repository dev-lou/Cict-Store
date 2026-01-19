<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cache;

class Setting extends Model
{
    protected $fillable = ['key', 'value'];
    
    public $timestamps = false;

    /**
     * Get a setting value by key with caching
     */
    public static function get($key, $default = null)
    {
        return Cache::remember("setting.{$key}", now()->addHours(1), function () use ($key, $default) {
            $setting = self::where('key', $key)->first();
            return $setting ? $setting->value : $default;
        });
    }

    /**
     * Set a setting value and clear cache
     */
    public static function set($key, $value)
    {
        Cache::forget("setting.{$key}");
        return self::updateOrCreate(
            ['key' => $key],
            ['value' => $value]
        );
    }
    
    /**
     * Boot method to clear cache on model events
     */
    protected static function boot()
    {
        parent::boot();
        
        static::saved(function ($setting) {
            Cache::forget("setting.{$setting->key}");
        });
        
        static::deleted(function ($setting) {
            Cache::forget("setting.{$setting->key}");
        });
    }
}
