<?php

namespace Engine\Core\Template;

use Cms\Model\MenuItem\MenuItemRepository;
use Engine\DI\DI;
use Cms\Model\Menu\MenuRepository;

/**
 * Class Menu
 * @package Engine\Core\Template
 */
class Menu
{
    /**
     * @var DI
     */
    protected static $di;

    /**
     * @var MenuRepository
     */
    protected static $menuRepository;

    /**
     * @var MenuItemRepository
     */
    protected static $menuItemRepository;

    /**
     * Menu constructor.
     * @param $di
     */
    public function __construct($di)
    {
        self::$di = $di;
        self::$menuRepository = new MenuRepository(self::$di);
        self::$menuItemRepository = new MenuItemRepository(self::$di);
    }

    /**
     * @param int $menuId
     * @return mixed
     */
    public static function getItems($menuId)
    {
        return self::$menuItemRepository->getItems($menuId);
    }
}
