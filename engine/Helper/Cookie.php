<?php
namespace Engine\Helper;

/**
 * Class Cookie
 * @package Engine\Helper
 */
class Cookie {
    /**
     * Add cookies
     * @param string $key
     * @param mixed $value
     * @param int $time
     */
    public static function set($key, $value, $time = 31536000)
    {
        setcookie($key, $value, time() + $time, '/') ;
    }

    /**
     * Get cookies by key
     * @param string $key
     * @return mixed
     */
    public static function get($key)
    {
        if (isset($_COOKIE[$key])) {
            return $_COOKIE[$key];
        }
        return null;
    }

    /**
     * Delete cookies by key
     * @param string $key
     */
    public static function delete($key)
    {
        if (isset($_COOKIE[$key])) {
            self::set($key, '', -3600);
            unset($_COOKIE[$key]);
        }
    }
}
