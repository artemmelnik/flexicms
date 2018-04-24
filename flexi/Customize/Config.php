<?php
namespace Flexi\Customize;

/**
 * Class Config
 * @package Flexi\Customize
 */
class Config
{
    /**
     * @var array
     */
    protected $config = [
        'dashboardMenu' => [
            'home' => [
                'classIcon' => 'icon-speedometer icons',
                'urlPath'   => '/backend/',
                'title'     => 'Home'
            ],
            'resource' => [
                'classIcon' => 'folder outline icon',
                'urlPath'   => '#',
                'title'     => 'Resources',
                'parents'   => []
            ],
            'plugins' => [
                'classIcon' => 'icon-wrench icons',
                'urlPath'   => '/backend/plugins/',
                'title'     => 'Plugins'
            ],
            'settings' => [
                'classIcon' => 'icon-equalizer icons',
                'urlPath'   => '/backend/settings/general/',
                'title'     => 'Settings'
            ]
        ],
        'settingMenu' => [
            'general' => [
                'urlPath'   => '/backend/settings/general/',
                'title'     => 'General'
            ],
            'themes' => [
                'urlPath'   => '/backend/settings/appearance/themes/',
                'title'     => 'Themes'
            ],
            'menus' => [
                'urlPath'   => '/backend/settings/appearance/menus/',
                'title'     => 'Menus'
            ],
            'custom_fields' => [
                'urlPath'   => '/backend/settings/custom_fields/',
                'title'     => 'Custom Fields'
            ]
        ]
    ];

    /**
     * @param string $key
     * @return bool
     */
    public function has($key)
    {
        return isset($this->config[$key]);
    }

    /**
     * @param string $key
     * @return mixed|null
     */
    public function get($key)
    {
        return $this->has($key) ? $this->config[$key] : null;
    }

    /**
     * @param string $key
     * @param mixed $value
     */
    public function set($key, $value)
    {
        $this->config[$key] = $value;
    }
}
