<?php
namespace Cms\Helper\Http;

class Request
{

    /**
     * Check if the request is a particular method.
     *
     * @param  string  $method  The request method to check for.
     * @return bool
     */
    public static function is($method)
    {
        switch (strtolower($method))
        {
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
    public static function method()
    {
        return strtolower($_SERVER['REQUEST_METHOD']);
    }

    /**
     * Check if the request is over a https connection.
     *
     * @return bool
     */
    public static function https()
    {
        return $_SERVER['HTTPS'] === 'on';
    }

    /**
     * Check if the request is an AJAX request.
     *
     * @return bool
     */
    public static function ajax()
    {
        return $_SERVER['HTTP_X_REQUESTED_WITH'] === 'xmlhttprequest';
    }

    /**
     * Check if the request is a CLI request.
     *
     * @return bool
     */
    public static function cli()
    {
        return (PHP_SAPI === 'cli' || defined('STDIN'));
    }

}
