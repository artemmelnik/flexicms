<?php
namespace Flexi\Template\Extension;

use Twig_Extension;
use Twig_SimpleFunction;

/**
 * Class CustomFieldExtension
 * @package Flexi\Template\Extension
 */
class CustomFieldExtension extends Twig_Extension
{
    /**
     * @return string
     */
    public function getName()
    {
        return 'TwigCustomFieldExtensions';
    }

    /**
     * @return array
     */
    public function getFunctions()
    {
        return [
            new Twig_SimpleFunction('field', array($this, 'getValueField')),
            new Twig_SimpleFunction('field_object', array($this, 'getField')),
        ];
    }

    /**
     * @param int $id
     * @param string $name
     * @return string
     */
    public function getValueField(int $id, string $name)
    {
        return \Field::get($id, $name);
    }

    public function getField(int $id, string $name)
    {
        return \Field::getField($id, $name);
    }
}
