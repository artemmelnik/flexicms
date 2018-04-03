<?php
namespace Flexi\Template\Extension;

use Flexi;
use Twig_Extension;
use Twig_SimpleFunction;

/**
 * Class HelperExtension
 * @package Flexi\Template\Extension
 */
class HelperExtension extends Twig_Extension
{
    /**
     * @return string
     */
    public function getName()
    {
        return 'TwigHelperExtensions';
    }

    /**
     * @return array
     */
    public function getFunctions()
    {
        return [
            new Twig_SimpleFunction('uniqid', array($this, 'getUniqid'))
        ];
    }

    /**
     * @return string
     */
    public function getUniqid()
    {
        return uniqid();
    }
}