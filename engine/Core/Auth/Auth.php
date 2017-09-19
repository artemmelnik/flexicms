<?php

namespace Engine\Core\Auth;

use Engine\Helper\Cookie;

class Auth implements AuthInterface
{
    /**
     * @var bool
     */
    protected $authorized = false;
    protected $hash_user;

    /**
     * @return bool
     */
    public function authorized()
    {
        return $this->authorized;
    }

    public function setAuthorized()
    {
        $this->authorized = true;
    }

    /**
     * @return mixed
     */
    public function hashUser()
    {
        return Cookie::get('auth_user');
    }

    /**
     * User authorization
     * @param $user
     */
    public function authorize($user)
    {
        Cookie::set('auth_authorized', true);
        Cookie::set('auth_user', $user);
    }

    /**
     * User unAuthorization
     * @return void
     */
    public function unAuthorize()
    {
        Cookie::delete('auth_authorized');
        Cookie::delete('auth_user');
    }

    /**
     * Generates a new random password salt
     * @return int
     */
    public static function salt()
    {
        return (string) rand(10000000, 99999999);
    }

    /**
     * Generates a hash
     * @param string $password
     * @param string $salt
     * @return string
     */
    public static function encryptPassword($password, $salt = '')
    {
        return hash('sha256', $password . $salt);
    }
}