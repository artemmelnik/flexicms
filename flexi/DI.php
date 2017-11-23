<?php
namespace Flexi;

/**
 * Dependency Injection Class
 * @package Flexi
 */
class DI
{
    /**
     * @var DI
     */
    protected static $instance;

    /**
     * Dependency container.
     *
     * @var array
     */
    private $container = [];
    
    /**
     * Get dependency from the container.
     *
     * @param $key
     * @return mixed|null
     */
    public function get($key)
    {
        return $this->has($key) ? $this->container[$key] : null;
    }
    
    /**
     * Add dependency to container.
     *
     * @param $key
     * @param $value
     * @return $this
     */
    public function set($key, $value)
    {
        $this->container[$key] = $value;

        return $this;
    }

    /**
     * See if there is a dependency in the container.
     *
     * @param $key
     * @return bool
     */
    public function has($key)
    {
        return isset($this->container[$key]);
    }

    /**
     * @return DI
     */
    public static function instance(): DI
    {
        if (self::$instance == null) {
            self::$instance = new DI();
        }
        return self::$instance;
    }
}
