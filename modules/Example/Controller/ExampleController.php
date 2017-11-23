<?php
namespace Modules\Example\Controller;

use Controller;
use View;

/**
 * Class ExampleController
 * @package Modules\Example
 */
class ExampleController extends Controller
{
    /**
     * @return \Flexi\Template\View
     */
    public function index()
    {
        return View::make('welcome');
    }
}
