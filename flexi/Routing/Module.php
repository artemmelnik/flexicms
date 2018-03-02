<?php
namespace Flexi\Routing;

use Exception;
use Flexi\Config\Config;

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
     * @var string
     */
    public $viewPath = '';

    /**
     * Constructor.
     *
     * @param array $config
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
        return path('modules') . DIRECTORY_SEPARATOR . $this->module . DIRECTORY_SEPARATOR;
    }

    public function url()
    {
        return Config::item('baseUrl') . DIRECTORY_SEPARATOR . 'modules' . DIRECTORY_SEPARATOR . $this->module . DIRECTORY_SEPARATOR;
    }

    /**
     * @return string
     */
    public function pathView(): string
    {
        return $this->path() . 'View' . DIRECTORY_SEPARATOR;
    }

    /**
     * @return string
     */
    public function pathTheme(): string
    {
        $theme = \Setting::value('active_theme', 'theme');

        if ($theme == '') {
            $theme = Config::item('defaultTheme');
        }

        return path_content('themes') . DIRECTORY_SEPARATOR . $theme . DIRECTORY_SEPARATOR;
    }

    /**
     * Runs the active controller action.
     */
    public function run()
    {
        // Build the class name.
        $class = '\\Modules\\' . $this->module . '\Controller\\' . $this->controller;

        // Ensure the class exists.
        if (class_exists($class)) {
            // Instantiate class.
            $this->instance = new $class;

            $parents = class_parents($this->instance);

            if (in_array('Modules\Front\Controller\FrontController', $parents)) {
                $this->viewPath = $this->pathTheme();
            } else {
                $this->viewPath = $this->pathView();
            }

            $this->response = call_user_func_array([$this->instance, $this->action], $this->parameters);

            // Return the response.
            return $this->response;
        } else {
            throw new Exception(
                sprintf('Controller <strong>%s</strong> does not exist.', $class)
            );
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

        foreach (scandir(path('modules')) as $module) {
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

    /**
     * @return mixed|null
     */
    public function current()
    {
        $path   = path('modules') . $this->module . DIRECTORY_SEPARATOR . 'module.php';
        $module = null;

        if (is_file($path)) {
            $module = require_once $path;
        }

        return $module;
    }
}
