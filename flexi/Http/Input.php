<?php
namespace Flexi\Http;

/**
 * Class Input
 * @package Flexi\Http
 */
class Input
{
    /**
     * @param bool|mixed $key
     * @return array|mixed
     */
    public static function get($key = false)
    {
        return $key ? static::getParam($key, $_GET) : $_GET;
    }

    /**
     * @param bool|mixed $key
     * @return array|mixed
     */
    public static function post($key = false)
    {
        return $key ? static::getParam($key, $_POST) : $_POST;
    }

    /**
     * @param bool|mixed $key
     * @return array|mixed
     */
    public static function files($key = false)
    {
        return $key ? static::getParam($key, $_FILES) : $_FILES;
    }

    /**
     * @param string $key
     * @param array $array
     * @return mixed
     */
    private static function getParam(string $key, array $array)
    {
        return $array[$key] ?? null;
    }
}
