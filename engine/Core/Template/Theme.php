<?php

namespace Engine\Core\Template;

use Engine\Core\Config\Config;

class Theme
{
    /**
     * Rules template name
     */
    const RULES_NAME_FILE = [
        'header'  => 'header-%s',
        'footer'  => 'footer-%s',
        'sidebar' => 'sidebar-%s',
    ];

    const URL_THEME_MASK = '%s/content/themes/%s';

    /**
     * Url current theme
     * @type string
     */
    protected static $url = '';

    /**
     * @var array
     */
    protected static $data = [];

    /**
     * @var Asset
     */
    public $asset;

    /**
     * @var Theme
     */
    public $theme;

    /**
     * Theme constructor.
     */
    public function __construct()
    {
        $this->asset = new Asset();
        $this->theme = $this;
    }

    /**
     * @return string
     */
    public static function getUrl()
    {
        $currentTheme = Config::item('defaultTheme', 'main');
        $baseUrl      = Config::item('baseUrl', 'main');

        return sprintf(self::URL_THEME_MASK, $baseUrl, $currentTheme);
    }

    /**
     * Show title
     */
    public static function title()
    {
        $nameSite    = Setting::get('name_site');
        $description = Setting::get('description');

        echo $nameSite . ' | ' . $description;
    }

    /**
     * @param null $name
     */
    public static function header($name = null)
    {
        $name = (string) $name;
        $file = self::detectNameFile($name, __FUNCTION__);

        Component::load($file);
    }

    /**
     * @param string $name
     */
    public static function footer($name = '')
    {
        $name = (string) $name;
        $file = self::detectNameFile($name, __FUNCTION__);

        Component::load($file);
    }

    /**
     * @param string $name
     */
    public static function sidebar($name = '')
    {
        $name = (string) $name;
        $file = self::detectNameFile($name, __FUNCTION__);

        Component::load($file);
    }

    /**
     * @param string $name
     * @param array $data
     */
    public static function block($name = '', $data = [])
    {
        $name = (string) $name;

        if ($name !== '') {
            Component::load($name, $data);
        }
    }

    /**
     * @param string $name
     * @param string $function
     * @return string
     */
    private static function detectNameFile($name, $function)
    {
        return empty(trim($name)) ? $function : sprintf(self::RULES_NAME_FILE[$function], $name);
    }

    /**
     * @return array
     */
    public static function getData()
    {
        return static::$data;
    }

    /**
     * @param array $data
     */
    public static function setData($data)
    {
        static::$data = $data;
    }

    /**
     * @return string
     */
    public static function getThemePath()
    {
        return ROOT_DIR . '/content/themes/default';
    }
}