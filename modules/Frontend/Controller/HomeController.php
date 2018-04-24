<?php
namespace Modules\Frontend\Controller;

use View;

/**
 * Class HomeController
 * @package Modules\Frontend\Controller
 */
class HomeController extends FrontendController
{
    /**
     * @return \Flexi\Template\View
     */
    public function index()
    {
        return View::make('main');
    }
}
