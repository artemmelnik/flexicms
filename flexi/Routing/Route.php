<?php
namespace Flexi\Routing;

use \Closure;

/**
 * Class Route
 * @package Flexi\Routing
 */
class Route
{
    /**
     * @var string Route prefix.
     */
    private static $prefix = '';

    /**
     * @var string The module we're settings routes for.
     */
    public static $module;

    /**
     * Sets a GET route.
     *
     * @param  string  $uri      The URI to route.
     * @param  array   $options  The route options.
     * @return bool
     */
    public static function get(string $uri, array $options): bool
    {
        return static::add('get', $uri, $options);
    }

    /**
     * Sets a POST route.
     *
     * @param  string  $uri      The URI to route.
     * @param  array   $options  The route options.
     * @return bool
     */
    public static function post(string $uri, array $options): bool
    {
        return static::add('post', $uri, $options);
    }

    /**
     * Creates a group of routes with a particular prefix.
     *
     * @param  string    $prefix  The route prefix.
     * @param  function  $routes  The routes callback.
     * @return void
     */
    public static function group(string $prefix, Closure $routes)
    {
        // Define the prefix.
        static::$prefix = $prefix;

        // Set the routes.
        $routes();

        // Empty the prefix.
        $prefix = '';
    }

    /**
     * Sets a route.
     *
     * @param  string  $method   The route method,
     * @param  string  $uri      The URI to route.
     * @param  array  $options  The route options.
     * @return bool
     */
    public static function add(string $method, string $uri, array $options): bool
    {
        if (static::validateOptions($options)) {
            // Set module.
            if (!isset($options['module'])) $options['module'] = static::$module;

            // Set route.
            Repository::store($method, static::prefixed($uri), $options);
            return true;
        }

        return false;
    }

    /**
     * Preprends the prefix to the URI.
     *
     * @param  string  $uri  The URI to prefix.
     * @return string
     */
    public static function prefixed(string $uri): string
    {
        // Normalize the URI.
        $uri = trim($uri, '/');

        // Prepend prefix if its set.
        if (static::$prefix !== '') {
            $uri = trim(static::$prefix, '/') . '/' . $uri;
        }

        return $uri;
    }

    /**
     * Validates the route options.
     *
     * @param  array  $options  Route options to validate.
     * @return bool
     */
    private static function validateOptions(array $options): bool
    {
        return isset($options['controller'], $options['action']);
    }
}
