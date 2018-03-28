<?php
namespace Modules\Front\Controller;

use View;

/**
 * Class HomeController
 * @package Modules\Front\Controller
 */
class HomeController extends FrontController
{
    /**
     * @return \Flexi\Template\View
     */
    public function index()
    {
        return View::make('main');
    }
}
