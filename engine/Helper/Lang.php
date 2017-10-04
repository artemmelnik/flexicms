<?php
namespace Engine\Helper;

/**
 * Class Lang
 * @package Engine\Helper
 */
class Lang
{
    public static function e()
    {
        //$language = HelperDI::get()->get('language');
    }

    /**
     * @param string $section
     * @param string $key
     * @return void
     */
    public static function _e($section, $key)
    {
        $language = HelperDI::get()->get('language');

        echo isset($language->{$section}[$key]) ? $language->{$section}[$key] : '';
    }
}
