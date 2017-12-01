<?php
namespace Flexi\Template;

use Flexi\Config\Config;
use Flexi\Http\Uri;
use Flexi\Routing\ResponderInterface;
use Flexi\Routing\Router;

/**
 * Class View
 * @package Flexi\Template
 */
class View implements ResponderInterface
{

    /**
     * @var string The view file.
     */
    protected $file = '';

    /**
     * @var array The view data.
     */
    protected $data = [];

    /**
     * @var Engine
     */
    protected static $engine;

    /**
     * View constructor.
     */
    public function __construct()
    {
        static::$engine = new Engine();
    }

    /**
     * @return Engine
     */
    public static function engine(): Engine
    {
        if (static::$engine == null) {
            return new Engine();
        }

        return static::$engine;
    }

    /**
     * Returns the view data.
     *
     * @return array
     */
    public function data(): array
    {
        return $this->data;
    }

    /**
     * @return string
     */
    public static function theme(): string
    {
        return static::engine()->detectViewDirectory();
    }

    /**
     * @return string
     */
    public static function path(): string
    {
        return ROOT_DIR . static::engine()->detectViewDirectory();
    }

    /**
     * {@inheritdoc}
     */
    public function respond()
    {
        // Get the module action instance.
        $instance = Router::module()->instance();
        // If we have no layout, then directly output the view.
        if (is_object($instance) && isset($instance->layout) && $instance->layout === '') {
            echo $this->render();
        } else {
            Layout::view($this);
        }
    }

    /**
     * Render the view.
     *
     * @return string
     */
    public function render(): string
    {
        // Get path for the views.
        $path = static::path() . $this->file . '.php';

        // Render the view.
        return Component::load($path, $this->data);
    }

    /**
     * Instantiates the view.
     *
     * @param  string  $file
     * @param  array   $data
     * @return \Flexi\Template\View
     */
    public static function make(string $file, array $data = []): View
    {
        // Instantiate class.
        $name           = get_called_class();
        $class          = new $name;
        $class->file    = $file;
        $class->data    = $data;

        // Return new object.
        return $class;
    }
}
