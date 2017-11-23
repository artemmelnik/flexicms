<?php
namespace Flexi\Cms\Front\Controller;

use View;

/**
 * Class HomeController
 * @package Flexi\Cms\Front\Controller
 */
class HomeController extends FrontController
{
    /**
     * @return \Flexi\Template\View
     */
    public function index()
    {
        return View::make('index');
    }
}
