<?php
namespace Modules\Front\Classes;

use Flexi;
use Modules;

/**
 * Class Menu
 * @package Flexi\Cms\Front\Classes
 */
class Menu
{
    /**
     * @param int $menuId
     * @return array|mixed|null
     */
    public static function getMenuItems(int $menuId)
    {
        $menuItems = Flexi\DI\Container::instance()->get('menuItems');

        if ($menuItems !== null) {
            return $menuItems;
        }

        $menuModel = new Modules\Front\Model\MenuItem;
        $menuItems = $menuModel->getItemsByMenuId($menuId);

        Flexi\DI\Container::instance()->set('menuItems', $menuItems);

        return $menuItems;
    }
}
