<?php
namespace Engine\Core\Plugin;

use Admin\Model\Plugin\PluginRepository;
use Engine\Service;

/**
 * Class Plugin
 * @package Engine\Core\Plugin
 */
class Plugin extends Service
{
    /**
     * @param $directory
     */
    public function install($directory)
    {
        $this->getLoad()->model('Plugin');

        /** @var PluginRepository $pluginModel */
        $pluginModel = $this->getModel('plugin');

        if (!$pluginModel->isInstallPlugin($directory)) {
            $pluginModel->addPlugin($directory);
        }
    }

    public function activate($id, $active)
    {
        $this->getLoad()->model('Plugin');

        /** @var PluginRepository $pluginModel */
        $pluginModel = $this->getModel('plugin');
        $pluginModel->activatePlugin($id, $active);
    }

    /**
     * @return object
     */
    public function getActivePlugins()
    {
        $this->getLoad()->model('Plugin');

        /** @var PluginRepository $pluginModel */
        $pluginModel = $this->getModel('plugin');

        return $pluginModel->getActivePlugins();
    }
}
