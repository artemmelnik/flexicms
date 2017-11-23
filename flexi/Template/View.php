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
        $module = Router::module();
        $theme = \Setting::value('active_theme', 'theme');

        $uriTheme = sprintf('%s/content/themes/%s', Uri::base(), $theme);

        if ($module->module == 'Admin') {
            $uriTheme = '/flexi/Cms/Admin/View';
        }

        return $uriTheme;
    }

    /**
     * @return string
     */
    public static function pathTheme(): string
    {
        $module = Router::module();
        $theme = \Setting::value('active_theme', 'theme');

        $path = sprintf('%s/%s/', path_content('themes'), $theme);

        if (in_array($module->module, ['Admin'])) {
            $path = sprintf('%s/flexi/Cms/%s/View/', ROOT_DIR, $module->module);
        }

        return $path;
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
        $path = static::pathTheme() . $this->file . '.php';

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
