<?php
namespace Flexi\Mokko;

/**
 * Class AbstractEngine
 * @package Flexi\Mokko
 */
abstract class AbstractEngine
{
    /**
     * @var string
     */
    protected $left;

    /**
     * @var string
     */
    protected $right;

    /**
     * @param string $left  The left delimiter
     * @param string $right The right delimiter
     */
    public function __construct($left = '{{', $right = '}}')
    {
        $this->left = $left;
        $this->right = $right;
    }

    /**
     * @param string $template      The template string
     * @param string|array $value   The value the template will be rendered with
     *
     * @return string The rendered template
     */
    abstract public function render($template, $value);
}
