<?php
namespace Flexi\Template\Extension;

use Modules\Front\Classes\Menu;
use Twig_Extension;
use Twig_SimpleFunction;

/**
 * Class MenuExtension
 * @package Flexi\Template\Extension
 */
class MenuExtension extends Twig_Extension
{
    /**
     * @return string
     */
    public function getName()
    {
        return 'TwigMenuExtensions';
    }

    /**
     * @return array
     */
    public function getFunctions()
    {
        return [
            new Twig_SimpleFunction('menu_items', array($this, 'getMenuItems'))
        ];
    }

    /**
     * @param int $menuId
     * @return array|mixed|null
     */
    public function getMenuItems(int $menuId)
    {
        return Menu::getMenuItems($menuId);
    }
}
