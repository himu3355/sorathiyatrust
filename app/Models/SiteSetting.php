<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cache;

class SiteSetting extends Model
{
    use HasFactory;

    protected $fillable = ['key', 'value', 'group'];

    public static function get(string $key, mixed $default = null): mixed
    {
        return Cache::remember("site_setting_{$key}", 3600, function () use ($key, $default) {
            $setting = static::where('key', $key)->first();
            if (!$setting) return $default;

            $decoded = json_decode($setting->value, true);
            return json_last_error() === JSON_ERROR_NONE ? $decoded : $setting->value;
        });
    }

    public static function set(string $key, mixed $value, string $group = 'general'): void
    {
        $encoded = is_array($value) || is_object($value) ? json_encode($value) : (string) $value;

        static::updateOrCreate(
            ['key' => $key],
            ['value' => $encoded, 'group' => $group]
        );

        Cache::forget("site_setting_{$key}");
    }
}
