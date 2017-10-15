<?php
namespace Engine;

use Engine\Core\Database\Connection;
use Engine\DI\DI;

/**
 * Class Service
 * @package Engine
 */
abstract class Service
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
     * @var Load
     */
    protected $load;

    /**
     * @var Model
     */
    protected $model;

    /**
     * Service constructor.
     * @param DI $di
     */
    public function __construct(DI $di)
    {
        $this->di    = $di;
        $this->db    = $this->di->get('db');
        $this->load  = $this->di->get('load');
        $this->model = $this->di->get('model');
    }

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
     * @return Load
     */
    public function getLoad()
    {
        return $this->load;
    }

    /**
     * @param $name
     * @return object
     */
    public function getModel($name)
    {
        $this->load->model(ucfirst($name), false, 'Admin');

        $model = $this->getDI()->get('model');

        return $model->{lcfirst($name)};
    }
}
