<?php

use App\Models\Setting;
use Illuminate\Support\Facades\Cache;

function setting(string $key, mixed $default = null): mixed {
    $value = Cache::rememberForever(
        "setting.{$key}",
        fn() => Setting::where('key', $key)->value('value')
    );

    return $value ?? $default;
}

function featured_image_url(?string $path): ?string {
    if (blank($path)) {
        return null;
    }

    if (str_starts_with($path, 'http://') || str_starts_with($path, 'https://')) {
        return $path;
    }

    return asset($path);
}
