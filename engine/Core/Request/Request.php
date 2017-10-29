<?php
namespace Engine\Core\Request;

/**
 * Class Request
 * @package Engine\Core\Request
 */
class Request
{
    /**
     * @var array
     */
    public $get = [];

    /**
     * @var array
     */
    public $post = [];

    /**
     * @var array
     */
    public $request = [];

    /**
     * @var array
     */
    public $cookie = [];

    /**
     * @var array
     */
    public $files = [];

    /**
     * @var array
     */
    public $server = [];

    /**
     * Request constructor.
     */
    public function __construct()
    {
        $this->get     = $_GET;
        $this->post    = $_POST;
        $this->request = $_REQUEST;
        $this->cookie  = $_COOKIE;
        $this->files   = $_FILES;
        $this->server  = $_SERVER;
    }

    /**
     * @param bool|mixed $key
     * @return array|mixed
     */
    public function get($key = false)
    {
        return $key ? $this->get[$key] : $this->get;
    }

    /**
     * @param bool|mixed $key
     * @return array|mixed
     */
    public function post($key = false)
    {
        return $key ? $this->post[$key] : $this->post;
    }
}
