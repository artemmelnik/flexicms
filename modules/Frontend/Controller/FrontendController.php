<?php
namespace Modules\Frontend\Controller;

use Controller;
use Flexi\Config\Config;
use Modules\Frontend;
use Modules\Backend;

/**
 * Class FrontendController
 * @package Modules\Frontend\Controller
 */
class FrontendController extends Controller
{
    /**
     * FrontendController constructor.
     */
    public function __construct()
    {
        $this->loadThemeFunctions();

        $resourceModel = new Backend\Model\ResourceType();
        $resourceTypes = $resourceModel->getResourcesType();

        foreach ($resourceTypes as $resourceType) {
            $resources = new Frontend\Classes\Resources($resourceType->id);

            if ($resourceType->id == 4) {
                $this->setData('hotels', $resources->get());
            }

            $this->setData($resourceType->name, $resources);
        }
    }

    /**
     * Load functions.php file in theme.
     */
    private function loadThemeFunctions()
    {
        $theme = \Setting::value('active_theme', 'theme');

        if ($theme == '') {
            $theme = Config::item('defaultTheme');
        }

        $path = path_content('themes') . DIRECTORY_SEPARATOR . $theme . DIRECTORY_SEPARATOR . 'functions';

        foreach (scandir($path) as $file) {
            if ($file === '.' || $file === '..') continue;

            if (is_file($path . DIRECTORY_SEPARATOR . $file)) {
                require_once $path . DIRECTORY_SEPARATOR . $file;
            }
        }
    }

    /**
     * @param string $name
     * @return bool
     */
    public function isController(string $name)
    {
        return "Modules\\Frontend\\Controller\\{$name}Controller" === $this->getNameController();
    }
}
