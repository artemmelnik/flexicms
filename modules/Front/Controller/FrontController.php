<?php
namespace Modules\Front\Controller;

use Controller;

/**
 * Class FrontController
 * @package Modules\Front\Controller
 */
class FrontController extends Controller
{
    /**
     * FrontController constructor.
     */
    public function __construct()
    {
        $this->loadThemeFunctions();
    }

    /**
     * Load functions.php file in theme.
     */
    private function loadThemeFunctions()
    {
        $functions = \View::pathTemplates() . 'functions.php';

        if (is_file($functions)) {
            require_once $functions;
        }
    }

    /**
     * @param string $name
     * @return bool
     */
    public function isController(string $name)
    {
        return "Modules\\Front\\Controller\\{$name}Controller" === $this->getNameController();
    }
}
