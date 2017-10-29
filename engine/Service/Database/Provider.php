<?php
namespace Engine\Service\Database;

use Engine\Core\Config\Config;
use Engine\Service\AbstractProvider;
use Engine\Core\Database\Connection;

/**
 * Class Provider
 * @package Engine\Service\Database
 */
class Provider extends AbstractProvider
{

    /**
     * @var string
     */
    public $serviceName = 'db';

    /**
     * @return mixed
     */
    public function init()
    {
        $config = Config::group('database');

        $this->di->set($this->serviceName, new Connection($config));

        return $this;
    }
}
