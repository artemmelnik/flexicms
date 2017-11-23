<?php
namespace Flexi\Http;

/**
 * Class Request
 * @package Flexi\Http
 */
class Request
{
    /**
     * Check if the request is a particular method.
     *
     * @param  string  $method  The request method to check for.
     * @return bool
     */
    public static function is(string $method): bool
    {
        switch (strtolower($method)) {
            case 'https':
                return self::https();
            case 'ajax':
                return self::ajax();
            case 'cli':
                return self::cli();
            default:
                return $method === self::method();
        }
    }

    /**
     * Get the current request method.
     *
     * @return string
     */
    public static function method(): string
    {
        return strtolower($_SERVER['REQUEST_METHOD'] ?? 'get');
    }

    /**
     * Check if the request is over a https connection.
     *
     * @return bool
     */
    public static function https(): bool
    {
        return ($_SERVER['HTTPS'] ?? '') === 'on';
    }

    /**
     * Check if the request is an AJAX request.
     *
     * @return bool
     */
    public static function ajax(): bool
    {
        return ($_SERVER['HTTP_X_REQUESTED_WITH'] ?? '') === 'xmlhttprequest';
    }

    /**
     * Check if the request is a CLI request.
     *
     * @return bool
     */
    public static function cli(): bool
    {
        return (PHP_SAPI === 'cli' || defined('STDIN'));
    }
}
