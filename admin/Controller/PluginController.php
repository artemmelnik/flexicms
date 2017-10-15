<?php
namespace Admin\Controller;

/**
 * Class PluginController
 * @package Admin\Controller
 */
class PluginController extends AdminController
{
    public function listPlugins()
    {
        $this->load->model('Plugin');

        $installedPlugins = $this->model->plugin->getPlugins();
        $plugins = getPlugins();

        foreach ($installedPlugins as $plugin) {
            $plugins[$plugin->directory]['is_active'] = $plugin->is_active;
            $plugins[$plugin->directory]['is_install'] = true;
            $plugins[$plugin->directory]['plugin_id'] = $plugin->id;
        }

        $this->data['plugins'] = $plugins;

        $this->view->render('plugins/list', $this->data);
    }

    public function ajaxInstall()
    {
        $directory = $this
            ->getRequest()
            ->post('directory')
        ;

        if ($directory !== null) {
            $this->getPlugin()->install($directory);
        }
    }

    public function ajaxActivate()
    {
        $pluginId = $this
            ->getRequest()
            ->post('id')
        ;

        $active = $this
            ->getRequest()
            ->post('active')
        ;

        if ($pluginId !== null) {
            $this->getPlugin()->activate($pluginId, $active);
        }
    }
}
