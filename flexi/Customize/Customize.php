<?php
namespace Flexi\Customize;

/**
 * Class Customize
 * @package Flexi\Customize
 */
class Customize
{
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
     */
    public function __construct()
    {
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
    static public function instance()
    {
        if (is_null(self::$instance)) {
            self::$instance = new self();
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

    /**
     * @return mixed|null
     */
    public function getAdminSettingItems()
    {
        return $this->getConfig()->get('settingMenu');
    }
}
