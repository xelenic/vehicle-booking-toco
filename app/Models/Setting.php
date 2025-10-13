<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cache;

class Setting extends Model
{
    protected $fillable = [
        'key',
        'value',
        'type',
        'group',
        'label',
        'description',
        'sort_order'
    ];

    protected $casts = [
        'sort_order' => 'integer'
    ];

    /**
     * Get a setting value by key
     */
    public static function get($key, $default = null)
    {
        $cacheKey = "setting.{$key}";
        
        return Cache::remember($cacheKey, 3600, function () use ($key, $default) {
            $setting = static::where('key', $key)->first();
            return $setting ? $setting->value : $default;
        });
    }

    /**
     * Set a setting value by key
     */
    public static function set($key, $value)
    {
        $setting = static::updateOrCreate(
            ['key' => $key],
            ['value' => $value]
        );

        // Clear cache
        Cache::forget("setting.{$key}");
        
        return $setting;
    }

    /**
     * Get settings by group
     */
    public static function getByGroup($group)
    {
        return static::where('group', $group)
            ->orderBy('sort_order')
            ->get();
    }

    /**
     * Get all settings as key-value pairs
     */
    public static function getAll()
    {
        return Cache::remember('settings.all', 3600, function () {
            return static::pluck('value', 'key')->toArray();
        });
    }

    /**
     * Clear all settings cache
     */
    public static function clearCache()
    {
        Cache::forget('settings.all');
        $settings = static::pluck('key');
        foreach ($settings as $key) {
            Cache::forget("setting.{$key}");
        }
    }
}
