<?php
namespace Flexi\Template;

use Flexi\Routing\Router;
use Exception;

/**
 * Class Component
 * @package Flexi\Template
 */
class Component
{

    /**
     * Gets a component.
     *
     * @param  string  $name  The component name.
     * @param  array   $data  The component data.
     * @return string
     */
    public static function get(string $name, array $data = []): string
    {
        // Merge the data.
        $data = array_merge_recursive(Layout::data(), $data);

        // Get the component path.
        $path = View::path() . $name . View::TEMPLATE_EXTENSION;

        // Return the loaded component.
        return static::load($path, $data);
    }

    /**
     * Loads a view component.
     *
     * @param  string  $path  The path to the component.
     * @param  array   $data  The component data.
     * @throws Exception
     * @return string
     */
    public static function load(string $path, array $data = []): string
    {
        // Ensure the data is available in the view as variables.
        extract($data);

        // Ensure the file exists.
        if (is_file($path)) {
            // Load component into a variable.
            ob_start();
            include $path;
            $component = ob_get_clean();

            // Return loaded component.
            return $component;
        } else {
            throw new Exception(
                sprintf('View file <strong>%s</strong> does not exist!', $path)
            );
        }
    }

}
