<?php
namespace Engine;

use Engine\Core\Router\DispatchedRoute;
use Engine\DI\DI;
use Engine\Helper\Common;

/**
 * Class Cms
 * @package Engine
 */
class Cms
{
    /**
     * @var DI
     */
    private $di;

    /**
     * @var Core\Router\Router
     */
    public $router;

    /**
     * Cms constructor.
     * @param $di
     */
    public function __construct($di)
    {
        $this->di = $di;
        $this->router = $this->di->get('router');
    }

    /**
     * Run cms
     */
    public function run()
    {
        try {
            require_once __DIR__ . '/../' . mb_strtolower(ENV) . '/route.php';

            /** @var \Engine\Core\Plugin\Plugin $pluginService */
            $pluginService = $this->di->get('plugin');
            $plugins = $pluginService->getActivePlugins();

            /** @var \Admin\Model\Plugin\Plugin $plugin */
            foreach ($plugins as $plugin) {
                $pluginClass  = '\\Plugin\\' . $plugin->directory . '\\Plugin';
                $pluginObject = new $pluginClass($this->di);

                if (method_exists($pluginClass, 'init')) {
                    $pluginObject->init();
                }
            }

            $routerDispatch = $this->router->dispatch(Common::getMethod(), Common::getPathUrl());

            if ($routerDispatch == null) {
                $routerDispatch = new DispatchedRoute('ErrorController:page404');
            }

            list($class, $action) = explode(':', $routerDispatch->getController(), 2);

            $controller = '\\' . ENV . '\\Controller\\' . $class;
            $parameters = $routerDispatch->getParameters();

            call_user_func_array([new $controller($this->di), $action], $parameters);
        } catch (\Exception $e) {
            echo $e->getMessage();
            exit;
        }
    }
}
