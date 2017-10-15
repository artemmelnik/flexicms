<?php
namespace Plugin\ExamplePlugin;

/**
 * Class Plugin
 * @package Content\Plugins\ExamplePlugin
 */
class Plugin extends \Engine\Plugin
{
    /**
     * @return array
     */
    public function details()
    {
        return [
            'name'        => 'Plugin Demo',
            'description' => 'Demonstration plugin.',
            'author'      => 'Artem Melnik',
            'icon'        => 'icon-leaf'
        ];
    }

    public function init()
    {
    }
}
