<?php
namespace Engine\Service\Plugin;

use Engine\Service\AbstractProvider;
use Engine\Core\Plugin\Plugin;

class Provider extends AbstractProvider
{

    /**
     * @var string
     */
    public $serviceName = 'plugin';

    /**
     * @return mixed
     */
    public function init()
    {
        $plugin = new Plugin($this->di);

        $this->di->set($this->serviceName, $plugin);

        return $this;
    }
}