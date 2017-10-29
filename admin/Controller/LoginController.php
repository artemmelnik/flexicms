<?php

namespace Admin\Controller;

use Engine\Controller;
use Engine\DI\DI;
use Engine\Core\Auth\Auth;
use Engine\Core\Database\QueryBuilder;

class LoginController extends Controller
{
    /**
     * @var Auth
     */
    protected $auth;

    /**
     * LoginController constructor.
     * @param DI $di
     */
    public function __construct(DI $di)
    {
        parent::__construct($di);

        $this->auth = new Auth();

        if ($this->auth->hashUser() !== null) {
            // redirect
            header('Location: /admin/');
            exit;
        }
    }

    public function form()
    {
        $this->view->render('login');
    }

    public function authAdmin()
    {
        $params       = $this->request->post;
        $queryBuilder = new QueryBuilder();

        $sql = $queryBuilder
             ->select()
             ->from('user')
             ->where('email', $params['email'])
             ->where('password', md5($params['password']))
             ->limit(1)
             ->sql();
        $values = $queryBuilder->getValues();

        $query = $this->db->query($sql, $values);

        if (!empty($query)) {
            $user = $query[0];

            if ($user->role == 'admin') {
                $hash = md5($user->id . $user->email . $user->password . $this->auth->salt());

                $sql = $queryBuilder
                     ->update('user')
                     ->set(['hash' => $hash])
                     ->where('id', $user->id)->sql();
                $values = $queryBuilder->getValues();
                
                $this->db->execute($sql, $values);

                $this->auth->authorize($hash);

                header( 'Location: /admin/login/');
                exit;
            }
        }

        echo 'Incorrect email or password.';
    }
}
