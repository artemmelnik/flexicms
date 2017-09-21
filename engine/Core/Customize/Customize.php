<?php
namespace Engine\Core\Customize;

use Engine\DI\DI;

/**
 * Class Customize
 * @package Engine\Core\Customize
 */
class Customize
{
    /**
     * @var \Engine\DI\DI
     */
    public static $di;

    /**
     * @var Config
     */
    protected $config;

    /**
     * @var null|Customize
     */
    private static $instance = null;

    /**
     * Customize constructor.
     * @param DI $di
     */
    public function __construct(DI $di)
    {
        static::$di = $di;
        $this->config = new Config();
    }

    /**
     * @return Config
     */
    public function getConfig()
    {
        return $this->config;
    }

    protected function __clone()
    {
    }

    /**
     * @return Customize|null
     */
    static public function getInstance()
    {
        if (is_null(self::$instance)) {
            self::$instance = new self(static::$di);
        }

        return self::$instance;
    }

    /**
     * @return mixed|null
     */
    public function getAdminMenuItems()
    {
        return $this->getConfig()->get('dashboardMenu');
    }
}
