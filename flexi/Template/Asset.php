<?php
namespace Flexi\Template;

/**
 * Class Asset
 * @package Flexi\Template
 */
class Asset
{
    /**
     * @var array
     */
    public static $container = [];

    /**
     * @param string $file
     * @return string
     */
    public static function get($file): string
    {
        return View::theme() . $file;
    }
}
