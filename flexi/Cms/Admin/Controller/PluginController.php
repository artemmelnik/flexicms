<?php
namespace Flexi\Cms\Admin\Controller;

use View;
use  Flexi\Cms\Admin\Model\Plugin as PluginModel;

/**
 * Class PluginController
 * @package Flexi\Cms\Admin\Controller
 */
class PluginController extends AdminController
{
    /**
     * @return \Flexi\Template\View
     */
    public function listPlugins()
    {
        $pluginModel = new PluginModel();
        $installedPlugins = $pluginModel->getPlugins();
        $plugins = getPlugins();

        foreach ($plugins as $key => $plugin) {
            $plugins[$key]['is_active'] = 0;
            $plugins[$key]['is_install'] = false;
            $plugins[$key]['plugin_id'] = 0;
        }

        foreach ($installedPlugins as $plugin) {
            $plugins[$plugin->directory]['is_active'] = $plugin->is_active;
            $plugins[$plugin->directory]['is_install'] = true;
            $plugins[$plugin->directory]['plugin_id'] = $plugin->id;
        }

        return View::make('plugins/list', [
            'plugins' => $plugins,
        ]);
    }
}
