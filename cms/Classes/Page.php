<?php
namespace Cms\Classes;

/**
 * Class Page
 * @package Cms\Classes
 */
class Page
{
    /**
     * @var object
     */
    protected static $store;

    /**
     * @param object $store
     */
    public static function setStore($store)
    {
        self::$store = $store;
    }

    /**
     * @return object
     */
    public static function getStore()
    {
        return self::$store;
    }

    public static function title()
    {
        echo static::$store->title;
    }

    public static function content()
    {
        echo static::$store->content;
    }
}
