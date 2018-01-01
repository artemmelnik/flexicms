<?php
namespace Flexi\Routing;

/**
 * Class Controller
 * @package Flexi\Routing
 */
abstract class Controller
{
    /**
     * @var string The layout to use.
     */
    public $layout = 'main';

    public function setLayout($layout)
    {
        $this->layout = $layout;
    }
}
