<?php
namespace Engine\Service\Customize;

use Engine\Service\AbstractProvider;
use Engine\Core\Customize\Customize;

class Provider extends AbstractProvider
{

    /**
     * @var string
     */
    public $serviceName = 'customize';

    /**
     * @return mixed
     */
    public function init()
    {
        $customize = new Customize($this->di);

        $this->di->set($this->serviceName, $customize);

        return $this;
    }
}
