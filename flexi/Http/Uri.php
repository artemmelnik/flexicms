<?php
namespace Flexi\Http;

/**
 * Class Uri
 * @package Flexi\Http
 */
class Uri
{
    /**
     * @var string The base URL.
     */
    protected static $base = '';

    /**
     * @var string The active URI.
     */
    protected static $uri = '';

    /**
     * @var array URI segments.
     */
    protected static $segments = [];

    /**
     * Initialize the URI class.
     *
     * @return void
     */
    public static function initialize()
    {
        // We need to get the different sections from the URI to process the
        // correct route.

        // Standard request in the browser?
        if (isset($_SERVER['REQUEST_URI'])) {
            // Get the active URI.
            $request    = $_SERVER['REQUEST_URI'];
            $host       = $_SERVER['HTTP_HOST'];
            $protocol   = 'http' . (Request::https() ? 's' : '');
            $base       = $protocol . '://' . $host;
            $uri        = $base . $request;

            // Build the URI segments.
            $length     = strlen($base);
            $str        = (string) substr($uri, $length);
            $arr        = (array) explode('/', trim($str, '/'));
            $segments   = [];

            foreach ($arr as $segment) {
                if ($segment !== '') {
                    array_push($segments, $segment);
                }
            }

            // Assign properties.
            static::$base       = $base;
            static::$uri        = $uri;
            static::$segments   = $segments;
        } else if (isset($_SERVER['argv'])) {
            $segments = [];
            foreach ($_SERVER['argv'] as $arg) {
                if ($arg !== $_SERVER['SCRIPT_NAME']) {
                    array_push($segments, $arg);
                }
            }

            static::$segments = $segments;
        }

    }

    /**
     * Get the base URI.
     *
     * @return string
     */
    public static function base(): string
    {
        return static::$base;
    }

    /**
     * Get the current URI.
     *
     * @return string
     */
    public static function uri(): string
    {
        return static::$uri;
    }

    /**
     * Get the URI segments.
     *
     * @return array
     */
    public static function segments(): array
    {
        return static::$segments;
    }

    /**
     * Returns a built site URL.
     *
     * @param  string  $uri  The URI to append onto the base.
     * @return string
     */
    public function url(string $uri = ''): string
    {
        return static::base() . ltrim($uri, '/');
    }

    /**
     * Gets a segment from the URI.
     *
     * @param  int  $num  The segment number.
     * @return string
     */
    public static function segment(int $num): string
    {
        // Normalize the number.
        $num = $num - 1;

        // Attempt to find the segment.
        if (isset(static::$segments[$num])) {
            return static::$segments[$num];
        } else {
            return '';
        }
    }

    /**
     * Get the URI segments as a string.
     *
     * @return string
     */
    public static function segmentString(): string
    {
        return (string) implode('/', static::$segments);
    }
}
