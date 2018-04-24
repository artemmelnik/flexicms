<?php
namespace Modules\Backend\Controller;

use Flexi\Http\Input;
use Flexi\Http\Redirect;
use Flexi\Localization\I18n;
use Flexi\Routing\Controller;
use Flexi\Auth\Auth;
use Flexi\Template\View;
use Modules;

/**
 * Class LoginController
 * @package Modules\Backend\Controller
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
            Redirect::go('/backend/');
        }

        I18n::instance()
            ->load('dashboard/main')
            ->load('dashboard/login')
        ;
    }

    /**
     * @return View
     */
    public function form()
    {
        return View::make('login');
    }

    /**
     * Auth in Backend panel.
     */
    public function auth()
    {
        $params    = Input::post();
        $userModel = new Modules\Backend\Model\User();
        $user      = $userModel->getUserByParams($params);

        if ($user) {
            if ($user->getAttribute('role') == 'admin') {
                Auth::authorize($user);
                Redirect::go('/backend/login/');
            }
        }

        echo 'Incorrect email or password.';
        exit;
    }
}
