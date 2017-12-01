<?php
namespace Flexi\Cms\Admin\Controller;

use Flexi\Http\Input;
use Flexi\Http\Redirect;
use Flexi\Routing\Controller;
use Flexi\Auth\Auth;
use Flexi\Template\View;
use Flexi\Cms;

/**
 * Class LoginController
 * @package Flexi\Cms\Admin\Controller
 */
class LoginController extends Controller
{
    /**
     * @var string
     */
    public $layout = 'login';

    /**
     * LoginController constructor.
     */
    public function __construct()
    {
        if (Auth::authorized()) {
            Redirect::go('/admin/');
        }
    }

    /**
     * @return View
     */
    public function form()
    {
        return View::make('login');
    }

    /**
     * Auth in admin panel.
     */
    public function authAdmin()
    {
        $params    = Input::post();
        $userModel = new Cms\Admin\Model\User();
        $user      = $userModel->getUserByParams($params);

        if ($user) {
            if ($user->getAttribute('role') == 'admin') {
                Auth::authorize($user);
                Redirect::go('/admin/login/');
            }
        }

        echo 'Incorrect email or password.';
        exit;
    }
}
