<?php
namespace Flexi\Http;

/**
 * Class Redirect
 * @package Flexi\Http
 */
class Redirect
{
    /**
     * @param string $url
     * @param bool $permanent
     */
    public static function go(string $url, $permanent = false)
    {
        if ($permanent) {
            header('HTTP/1.1 301 Moved Permanently');
        }

        header('Location: ' . $url);
        exit();
    }
}
