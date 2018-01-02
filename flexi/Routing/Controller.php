<?php
namespace Flexi\Routing;

/**
 * Class Controller
 * @package Flexi\Routing
 */
abstract class Controller
{
    /**
     * @var string The layout to use.
     */
    public $layout = 'main';

    /**
     * @var array
     */
    public $data = [];

    /**
     * @param string $layout
     */
    public function setLayout(string $layout)
    {
        $this->layout = $layout;
    }

    /**
     * @param string $key
     * @param mixed $value
     */
    public function setData(string $key, $value)
    {
        $this->data[$key] = $value;
    }

    /**
     * @return string
     */
    public function getNameController()
    {
        return get_called_class();
    }
}
