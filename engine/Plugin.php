<?php
namespace Engine;

use Engine\Core\Database\Connection;
use Engine\Core\Router\Router;
use Engine\DI\DI;

/**
 * Class Plugin
 * @package Engine
 */
abstract class Plugin
{
    /**
     * @var DI
     */
    protected $di;

    /**
     * @var Connection
     */
    protected $db;

    /**
     * @var Router
     */
    protected $router;

    /**
     * Plugin constructor.
     * @param DI $di
     */
    public function __construct(DI $di)
    {
        $this->di     = $di;
        $this->db     = $this->di->get('db');
        $this->router = $this->di->get('router');
        $this->customize = $this->di->get('customize');
    }

    abstract public function details();

    /**
     * @return DI
     */
    public function getDI()
    {
        return $this->di;
    }

    /**
     * @return Connection
     */
    public function getDb()
    {
        return $this->db;
    }

    /**
     * @return Router
     */
    public function getRouter()
    {
        return $this->router;
    }
}
