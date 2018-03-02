<?php
namespace Flexi\Template;

use Flexi;
use Exception;

/**
 * Class Component
 * @package Flexi\Template
 */
class Component
{
    /**
     * @var \Twig_Environment
     */
    public static $twig;

    /**
     * @param $twig
     */
    public static function setTwig(\Twig_Environment $twig)
    {
        static::$twig = $twig;
    }

    /**
     * Gets a component.
     *
     * @param  $template  The component.
     * @param  array   $data  The component data.
     * @return string
     */
    public static function get($template, array $data = []): string
    {
        return $template->render($data);
    }

    /**
     * Loads a view component.
     *
     * @param  string  $name  The file to the component.
     * @return string
     */
    public static function load(string $name): string
    {
        return static::$twig->load($name);
    }

}
