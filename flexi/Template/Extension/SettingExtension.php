<?php
namespace Flexi\Template\Extension;

use Twig_Extension;
use Twig_SimpleFunction;

/**
 * Class AssetExtension
 * @package Flexi\Template\Extension
 */
class SettingExtension extends Twig_Extension
{
    /**
     * @return string
     */
    public function getName()
    {
        return 'TwigSettingExtensions';
    }

    /**
     * @return array
     */
    public function getFunctions()
    {
        return [
            new Twig_SimpleFunction('setting', array($this, 'getSettingValue'))
        ];
    }

    /**
     * @param string $key
     * @param string $section
     * @return mixed
     */
    public function getSettingValue(string $key, string $section = 'general')
    {
        return \Setting::value($key, $section);
    }
}
