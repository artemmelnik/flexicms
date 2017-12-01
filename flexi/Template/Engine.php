<?php
namespace Flexi\Template;

use Flexi\Define;
use Flexi\Routing\Router;

/**
 * Class Engine
 * @package Flexi\Template
 */
class Engine
{
    /**
     * @var string
     */
    public $viewPath = '';

    /**
     * @var string
     */
    public $viewUri = '';

    /**
     * @return string
     */
    public function detectViewDirectory(): string
    {
        $module = Router::module();
        $theme = \Setting::value('active_theme', 'theme');

        $directory = sprintf('/content/themes/%s/', $theme);

        if ($module->module == Define::DEFAULT_MODULE['admin']) {
            $directory = '/flexi/Cms/Admin/View/';
        }

        return $directory;
    }
}
