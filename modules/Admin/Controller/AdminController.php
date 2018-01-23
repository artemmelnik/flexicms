<?php
namespace Modules\Admin\Controller;

use Flexi\Auth\Auth;
use Flexi\Http\Redirect;
use Flexi\Routing\Controller;
use Flexi\Template\View;
use Flexi\Localization\I18n;

/**
 * Class AdminController
 * @package Modules\Admin\Controller
 */
class AdminController extends Controller
{
    /**
     * @var string
     */
    public $layout = 'admin';

    /**
     * @var string
     */
    public $theme = 'admin';

    /**
     * AdminController constructor.
     */
    public function __construct()
    {
        if (!Auth::authorized()) {
            Redirect::go('/admin/login/');
        }

        I18n::instance()
            ->load('dashboard/main', 'Admin')
            ->load('dashboard/menu', 'Admin')
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
