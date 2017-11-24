<?php
namespace Flexi\Cms\Admin\Controller;

use Flexi\Auth\Auth;
use Flexi\Http\Redirect;
use Flexi\Routing\Controller;
use Flexi\Template\View;
use Flexi\Localization\I18n;

/**
 * Class AdminController
 * @package Flexi\Cms\Admin\Controller
 */
class AdminController extends Controller
{
    /**
     * @var string
     */
    public $layout = 'admin';

    /**
     * AdminController constructor.
     */
    public function __construct()
    {
        if (!Auth::authorized()) {
            Redirect::go('/admin/login/');
        }

        I18n::instance()
            ->load('dashboard/main')
            ->load('dashboard/menu')
        ;
    }

    /**
     * @return View
     */
    public function dashboard()
    {
        return View::make('dashboard');
    }

    public function logout()
    {
        Auth::unauthorize();
        Redirect::go('/admin/login/');
    }
}
