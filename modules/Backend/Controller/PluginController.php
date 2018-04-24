<?php
namespace Modules\Backend\Controller;

use Flexi\Localization\I18n;
use View;
use  Modules\Backend\Model\Plugin as PluginModel;

/**
 * Class PluginController
 * @package Modules\Backend\Controller
 */
class PluginController extends BackendController
{
    /**
     * @return \Flexi\Template\View
     */
    public function listPlugins()
    {
        I18n::instance()->load('plugins/list');

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

        $this->setData('plugins', $plugins);

        return View::make('plugins/list', $this->data);
    }
}
