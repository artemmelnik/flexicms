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
     * @var string
     */
    public $layout = 'main';

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
        //$functions = \View::path() . 'functions.php';

        /*if (is_file($functions)) {
            require_once $functions;
        }*/
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
