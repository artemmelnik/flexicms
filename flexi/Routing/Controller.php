<?php
namespace Flexi\Routing;

/**
 * Class Controller
 * @package Flexi\Routing
 */
abstract class Controller
{
    /**
     * @var string|null
     */
    public $theme = null;

    /**
     * @var array
     */
    public $data = [];

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
