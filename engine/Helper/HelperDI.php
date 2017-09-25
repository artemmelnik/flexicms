<?php
namespace Engine\Helper;

/**
 * Class HelperDI
 * @package Engine\Helper
 */
class HelperDI
{
    /**
     * @return \Engine\DI\DI
     */
    public static function get()
    {
        global $di;

        return $di;
    }
}
