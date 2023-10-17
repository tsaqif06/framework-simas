<?php

namespace FrameworkSimas\Cache;


/**
 * @ Contoh penggunaan
 *  Cache::put('data_key', 'data_value', 60); // Tambahkan waktu kadaluarsa 60 detik
 */
class Cache
{
    private static $cache = [];

    public static function get($key)
    {
        if (isset(self::$cache[$key]['expiration']) && time() > self::$cache[$key]['expiration']) {
            self::forget($key);
            return null;
        }
        return isset(self::$cache[$key]) ? self::$cache[$key]['data'] : null;
    }

    public static function put($key, $value, $expiration = null)
    {
        $cacheItem = ['data' => $value];
        if ($expiration !== null) {
            $cacheItem['expiration'] = time() + $expiration;
        }
        self::$cache[$key] = $cacheItem;
    }

    public static function has($key)
    {
        return isset(self::$cache[$key]);
    }

    public static function forget($key)
    {
        if (isset(self::$cache[$key])) {
            unset(self::$cache[$key]);
        }
    }
}
