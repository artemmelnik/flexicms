<?php

namespace Engine;

use Engine\DI\DI;

abstract class Controller
{
    /**
     * @var DI
     */
    protected $di;

    protected $db;

    protected $view;

    protected $config;

    protected $request;

    protected $load;

    /**
     * Controller constructor.
     * @param DI $di
     */
    public function __construct(DI $di)
    {
        $this->di      = $di;
        $this->db      = $this->di->get('db');
        $this->view    = $this->di->get('view');
        $this->config  = $this->di->get('config');
        $this->request = $this->di->get('request');
        $this->load    = $this->di->get('load');

        $this->initVars();
    }

    /**
     * @param $key
     * @return mixed
     */
    public function __get($key)
    {
        return $this->di->get($key);
    }

    /**
     * @return Controller
     */
    public function initVars()
    {
        $vars = array_keys(get_object_vars($this));

        foreach ($vars as $var) {
            if ($this->di->has($var)) {
                $this->{$var} = $this->di->get($var);
            }
        }

        return $this;
    }
}