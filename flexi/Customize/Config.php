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
                'urlPath'   => '/admin/',
                'title'     => 'Home'
            ],
            'resource' => [
                'classIcon' => 'folder outline icon',
                'urlPath'   => '#',
                'title'     => 'Resources',
                'parents'   => []
            ],
            'geotrip' => [
                'classIcon' => 'folder outline icon',
                'urlPath'   => '#',
                'title'     => 'Geotrip',
                'parents'   => [
                    'transport' => [
                        'classIcon' => 'folder outline icon',
                        'urlPath'   => '/admin/geotrip/transport/list/',
                        'title'     => 'Транспорт',
                    ],
                    'activity' => [
                        'classIcon' => 'folder outline icon',
                        'urlPath'   => '/admin/geotrip/activity/list/',
                        'title'     => 'Активности',
                    ],
                    'hotel' => [
                        'classIcon' => 'folder outline icon',
                        'urlPath'   => '/admin/geotrip/hotel/list/',
                        'title'     => 'Гостиницы',
                    ],
                    'ready_tour' => [
                        'classIcon' => 'folder outline icon',
                        'urlPath'   => '/admin/ready-tour/listing/',
                        'title'     => 'Готовые туры',
                    ],
                ]
            ],
            'plugins' => [
                'classIcon' => 'icon-wrench icons',
                'urlPath'   => '/admin/plugins/',
                'title'     => 'Plugins'
            ],
            'settings' => [
                'classIcon' => 'icon-equalizer icons',
                'urlPath'   => '/admin/settings/general/',
                'title'     => 'Settings'
            ]
        ],
        'settingMenu' => [
            'general' => [
                'urlPath'   => '/admin/settings/general/',
                'title'     => 'General'
            ],
            'themes' => [
                'urlPath'   => '/admin/settings/appearance/themes/',
                'title'     => 'Themes'
            ],
            'menus' => [
                'urlPath'   => '/admin/settings/appearance/menus/',
                'title'     => 'Menus'
            ],
            'custom_fields' => [
                'urlPath'   => '/admin/settings/custom_fields/',
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
