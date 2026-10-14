<?php

namespace App\Support;

class Media
{
    /**
     * Turn a stored image path into a public URL.
     *
     *  - "images/burger.jpg"      -> {host}/site/images/burger.jpg   (the original static website assets)
     *  - "storage/products/x.jpg" -> {host}/storage/products/x.jpg   (admin uploads; needs `php artisan storage:link`)
     *  - full http(s) URLs are returned unchanged
     */
    public static function url(?string $path): ?string
    {
        if (! $path) {
            return null;
        }

        if (preg_match('#^https?://#i', $path)) {
            return $path;
        }

        $relative = str_starts_with($path, 'images/') ? 'site/' . $path : $path;
        $encoded = implode('/', array_map('rawurlencode', explode('/', $relative)));

        return asset($encoded);
    }
}
