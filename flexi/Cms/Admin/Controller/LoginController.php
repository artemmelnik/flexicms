<?php
namespace Flexi\Cms\Admin\Controller;

use Flexi\Http\Input;
use Flexi\Http\Redirect;
use Flexi\Routing\Controller;
use Flexi\Auth\Auth;
use Flexi\Template\View;

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

    public function form()
    {
        return View::make('login');
    }

    public function authAdmin()
    {
        $params    = Input::post();
        $userModel = new \Flexi\Cms\Admin\Model\User();
        $user      = $userModel->getUserByParams($params);

        if ($user) {
            if ($user->getAttribute('role') == 'admin') {
                Auth::authorize($user);
                Redirect::go('/admin/login/');
            }
        }

        echo 'Incorrect email or password.';
    }
}
