<?php
namespace Flexi;

/**
 * Class Define
 * @package Flexi
 */
class Define
{
    const NAME    = 'FlexiCMS';
    const VERSION = '0.0.1';
    const EXEC    = true;
    const PHP_MIN = '7.0.0';

    const DEFAULT_MODULE = [
        'admin' => 'Admin',
        'front' => 'Front'
    ];

    const VIEW_PATH_MASK = [
        'module' => '%s/View/%s',
        'theme'  => '%s/content/themes/%s'
    ];
}
