<?php

use App\Models\Setting;

if (!function_exists('setting')) {
    function setting($key, $default = null)
    {
        static $settingsCache = [];

        if (array_key_exists($key, $settingsCache)) {
            return $settingsCache[$key];
        }

        $setting = Setting::where('slug', $key)->first();
        return $settingsCache[$key] = $setting->value ?? $default;
    }
}

function normalize_url($url)
{
    if (!preg_match('#^https?://#', $url)) {
        return 'https://' . $url;
    }

    return $url;
}
