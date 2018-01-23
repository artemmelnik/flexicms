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

        $directory = sprintf('/modules/%s/View/', $module->module);

        return $directory;
    }

    public function detectThemeDirectory(): string
    {
        $module = Router::module();
        $theme = \Setting::value('active_theme', 'theme');

        if ($module->instance()->theme !== null) {
            $theme = $module->instance()->theme;
        }

        $directory = sprintf('/content/themes/%s/', $theme);

        return $directory;
    }
}
