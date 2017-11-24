<?php
namespace Flexi\Routing;

use Exception;

/**
 * Class Module
 * @package Flexi\Routing
 */
class Module
{
    /**
     * @var \Flexi\Routing\Controller Controller instance.
     */
    protected $instance;

    /**
     * @var mixed The action response.
     */
    protected $response;

    /**
     * @var string The active module.
     */
    public $module = '';

    /**
     * @var string The active controller.
     */
    public $controller = '';

    /**
     * @var string The active action.
     */
    public $action = '';

    /**
     * @var string The active parameters.
     */
    public $parameters = [];

    /**
     * @var string
     */
    public $theme = '';

    /**
     * @var array
     */
    public $current = [];

    /**
     * Constructor.
     *
     * @return void
     */
    public function __construct(array $config = [])
    {
        foreach ($config as $key => $value) {
            $this->$key = $value;
        }

        $this->current = $this->current();

        if (isset($this->current['theme'])) {
            $this->theme = $this->current['theme'];
        }
    }

    /**
     * Returns the controller instance.
     *
     * @return \Flexi\Routing\Controller
     */
    public function instance()
    {
        return $this->instance;
    }

    /**
     * Returns the module path.
     *
     * @return string
     */
    public function path(): string
    {
        return path('modules') . $this->module . '/';
    }

    /**
     * Runs the active controller action.
     */
    public function run()
    {
        // Build the class name.
        $class = '\\Modules\\' . $this->module . '\Controller\\' . $this->controller;

        if (in_array($this->module, ['Admin', 'Front'])) {
            $class = '\\Flexi\\Cms\\' . $this->module . '\Controller\\' . $this->controller;
        }

        // Ensure the class exists.
        if (class_exists($class)) {
            // Instantiate class.
            $this->instance = new $class;
            $this->response = call_user_func_array([$this->instance, $this->action], $this->parameters);

            // Return the response.
            return $this->response;
        } else {
            throw new Exception(sprintf(
                'Controller <strong>%s</strong> does not exist.'
            , $class));
        }
    }

    /**
     * Gets all the valid modules.
     *
     * @return array
     */
    public static function all(): array
    {
        $modules = [];

        foreach (scandir(path('modules')) as $module)
        {
            // Ignore hidden directories.
            if ($module === '.' || $module === '..') continue;

            // Does the module have a valid module.php?
            if (is_file(path('modules') . 'module.php')) {
                // Add it to the modules array.
                array_push($modules, $module);
            }
        }

        return $modules;
    }

    public function current()
    {
        $path   = path('modules') . $this->module . '/module.php';
        $module = null;

        if (is_file($path)) {
            $module = require_once $path;
        }

        return $module;
    }
}
