<?php
namespace Flexi\Template\Extension;

use Twig_Extension;
use Twig_SimpleFunction;

/**
 * Class AssetExtension
 * @package Flexi\Template\Extension
 */
class AssetExtension extends Twig_Extension
{
    /**
     * @return string
     */
    public function getName()
    {
        return 'TwigAssetExtensions';
    }

    /**
     * @return array
     */
    public function getFunctions()
    {
        return [
            new Twig_SimpleFunction('asset', array($this, 'getAsset'))
        ];
    }

    /**
     * @param string $file
     * @return string
     */
    public function getAsset(string $file)
    {
        return \Asset::get($file);
    }
}
