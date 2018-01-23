<?php
namespace Flexi\Routing;

use Flexi\Http\Request;
use Flexi\Http\Uri;
use Flexi\Template\Layout;
use Flexi\Flexi;

/**
 * Class Router
 * @package Flexi\Routing
 */
class Router
{

    /**
     * @var \Flexi\Routing\Module The active module.
     */
    protected static $module;

    /**
     * Returns the active module.
     *
     * @return \Flexi\Routing\Module
     */
    public static function module(): \Flexi\Routing\Module
    {
        return static::$module;
    }

    /**
     * Initializes the Flexi framework.
     *
     * @return void
     */
    public static function initialize()
    {
        // Start the system.
        Flexi::start();

        // Load routes.
        static::routes();

        // Find the current route.
        $route = Repository::retrieve(Request::method(), Uri::segmentString());

        // If no route was found, show a 404.
        if (empty($route)) {
            exit('404');
        }

        // Instantiate the module.
        static::$module = $module = new Module($route);

        // Set module in DI
        \DI::instance()->set('module', static::$module);

        // Run the module.
        $response = $module->run();

        // Run the response.
        if (is_object($response) && method_exists($response, 'respond')) {
            $response->respond();
        }

        // Do we have a layout to process?
        $layout = $module->instance()->layout;

        // Process layout.
        if ($layout !== '') {
            echo Layout::get($layout);
        }

        // Close Flexi.
        Flexi::close();
    }

    /**
     * Load the application routes.
     *
     * @return void
     */
    private static function routes()
    {
        // Load the routes file from each module that has it.
        foreach (scandir(path('modules')) as $module) {
            // Ensure its not a hidden folder.
            if (in_array($module, ['.', '..'], true)) continue;

            // Set the module.
            Route::$module = $module;

            // Load file is exists.
            if (is_file($path = path('modules') . '/' . $module . '/routes.php')) {
                require_once $path;
            }
        }

        // Rewrite the application routes.
        static::rewrite();
    }

    /**
     * Rewrites the application routes.
     *
     * @return void
     */
    private static function rewrite()
    {
        foreach (Repository::stored() as $method => $routes) {
            foreach ($routes as $uri => $options) {
                $segments   = explode('/', $uri);
                $rewrite    = false;

                foreach ($segments as $key => $segment) {
                    $matches = [];

                    // Get route URI segments we need to rewrite.
                    preg_match('/\(([0-9a-z]+)\:([a-z]+)\)/i', $segment, $matches);

                    // Do we have matches?
                    if (!empty($matches)) {
                        // Get the real value for this segment and validate it
                        // against the rule.
                        $value  = Uri::segment(($key + 1));
                        $rule   = $matches[2];
                        $valid  = false;

                        // Validate the rule.
                        if ($rule === 'numeric' && is_numeric($value)) {
                            $valid = true;
                        } else if ($rule === 'any') {
                            $valid = true;
                        }

                        // If the segment is valid, assign the value.
                        if ($valid === true) {
                            $segments[$key] = $value;
                        }

                        // Add the parameters.
                        if (!isset($options['parameters'])) {
                            $options['parameters'] = [$value];
                        } else {
                            array_push($options['parameters'], $value);
                        }

                        // We will need to rewrite this URL.
                        $rewrite = true;
                    }
                }

                // Do we need to rewrite the URI value.
                if ($rewrite) {
                    // Remove the old URI.
                    Repository::remove($method, $uri);

                    // Add the new one.
                    Repository::store($method, implode('/', $segments), $options);
                }
            }
        }
    }
}
