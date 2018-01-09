<?php
namespace Flexi\Cms\Front\Classes;

use Flexi;

/**
 * Class Page
 * @package Flexi\Cms\Front\Classes
 */
class Page
{
    /**
     * @var Flexi\Cms\Front\Model\Page
     */
    protected static $page;

    /**
     * @param Flexi\Cms\Front\Model\Page $page
     */
    public static function setPage(Flexi\Cms\Front\Model\Page $page)
    {
        static::$page = $page;
    }

    /**
     * @return Flexi\Cms\Front\Model\Page
     */
    public static function getPage()
    {
        return static::$page;
    }

    /**
     * Display page title.
     */
    public static function title()
    {
        echo static::getPage()->getAttribute('title');
    }

    /**
     * Display page content.
     */
    public static function content()
    {
        echo static::getPage()->getAttribute('content');
    }
}
