<?php
namespace Flexi\DI;

/**
 * Dependency Injection Class.
 *
 * Class Container
 * @package Flexi\DI
 */
class Container
{
    /**
     * @var Container
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
     * @return Container
     */
    public static function instance(): Container
    {
        if (self::$instance == null) {
            self::$instance = new Container();
        }
        return self::$instance;
    }
}
