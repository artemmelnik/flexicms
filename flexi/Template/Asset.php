<?php
namespace Flexi\Template;

use Flexi\Routing\Router;

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
        return Router::module()->url() . 'View' . DIRECTORY_SEPARATOR . $file;
    }
}
