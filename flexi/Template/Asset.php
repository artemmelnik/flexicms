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
    public static function get(string $file): string
    {
        if (Router::module()->module === 'Front') {
            return Router::module()->urlTheme() . $file;
        }

        return Router::module()->url() . 'View' . DIRECTORY_SEPARATOR . $file;
    }
}
