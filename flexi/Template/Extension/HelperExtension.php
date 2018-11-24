<?php
namespace Flexi\Template\Extension;

use Flexi;
use Twig\TwigFilter;
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
            new Twig_SimpleFunction('uniqid', array($this, 'getUniqid')),
            new Twig_SimpleFunction('json_decode', array($this, 'jsonDecode')),
        ];
    }

    /**
     * @return array
     */
    public function getFilters()
    {
        return [
            new TwigFilter('json_decode', array($this, 'jsonDecode')),
        ];
    }

    /**
     * @param string $json
     * @return mixed
     */
    public function jsonDecode(string $json)
    {
        return json_decode($json);
    }

    /**
     * @return string
     */
    public function getUniqid()
    {
        return uniqid();
    }
}