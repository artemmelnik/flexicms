<?php
namespace Modules\Front\Controller;

use Controller;
use Modules\Front\Classes\Resource;

/**
 * Class FrontController
 * @package Modules\Front\Controller
 */
class FrontController extends Controller
{
    /**
     * FrontController constructor.
     */
    public function __construct()
    {
        $this->loadThemeFunctions();

        $resourceModel = new \Modules\Admin\Model\ResourceType();
        $resourceTypes = $resourceModel->getResourcesType();

        /**
         * @var $resourceType \Modules\Admin\Model\ResourceType
         */
        foreach ($resourceTypes as $resourceType) {
            $this->setData($resourceType->getAttribute('name'), new Resource($resourceType->getAttribute('id')));
        }
    }

    /**
     * Load functions.php file in theme.
     */
    private function loadThemeFunctions()
    {
        $functions = \View::pathTemplates() . 'functions.php';

        if (is_file($functions)) {
            require_once $functions;
        }
    }

    /**
     * @param string $name
     * @return bool
     */
    public function isController(string $name)
    {
        return "Modules\\Front\\Controller\\{$name}Controller" === $this->getNameController();
    }
}
