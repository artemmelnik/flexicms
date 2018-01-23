<?php
namespace Modules\Front\Classes;

use Flexi;
use Modules;

/**
 * Class Page
 * @package Flexi\Cms\Front\Classes
 */
class Page
{
    /**
     * @var Modules\Front\Model\Page
     */
    protected static $page;

    /**
     * @param Modules\Front\Model\Page $page
     */
    public static function setPage(Modules\Front\Model\Page $page)
    {
        static::$page = $page;
    }

    /**
     * @return Modules\Front\Model\Page
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
