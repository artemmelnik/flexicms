<?php
namespace Flexi\Template\Extension;

use Flexi;
use Twig_Extension;
use Twig_SimpleFunction;

/**
 * Class LocalizationExtension
 * @package Flexi\Template\Extension
 */
class LocalizationExtension extends Twig_Extension
{
    /**
     * @return string
     */
    public function getName()
    {
        return 'TwigLocalizationExtensions';
    }

    /**
     * @return array
     */
    public function getFunctions()
    {
        return [
            new Twig_SimpleFunction('__', array($this, 'getLang'))
        ];
    }

    /**
     * @param string $key
     * @param array $data
     * @return string
     */
    public function getLang(string $key, array $data = [])
    {
        return Flexi\Localization\I18n::instance()->get($key, $data);
    }
}