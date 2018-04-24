<?php
namespace Modules\Frontend\Classes;

use Flexi;
use Modules;

/**
 * Class Page
 * @package Flexi\Cms\Frontend\Classes
 */
class Page
{
    /**
     * @var Modules\Frontend\Model\Page
     */
    protected static $page;

    /**
     * @param Modules\Frontend\Model\Page $page
     */
    public static function setPage(Modules\Frontend\Model\Page $page)
    {
        static::$page = $page;
    }

    /**
     * @return Modules\Frontend\Model\Page
     */
    public static function getPage()
    {
        return static::$page;
    }

    /**
     * @return int
     */
    public static function getId()
    {
        return static::getPage()->getAttribute('id');
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
