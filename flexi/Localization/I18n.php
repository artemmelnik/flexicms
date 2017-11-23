<?php
namespace Flexi\Localization;

use Flexi\Config\Config;
use Flexi\Routing\Module;

/**
 * Class I18n
 * @package Flexi\Localization
 */
class I18n
{
    private static $instance;

    /**
     * @return I18n
     */
    public static function instance(): I18n
    {
        if (self::$instance == null) {
            self::$instance = new I18n();
        }
        return self::$instance;
    }

    /**
     * @param string $key
     * @return string
     */
    public function get(string $key): string
    {
        $lang = \DI::instance()->get('lang');
        return isset($lang[$key]) ? $lang[$key] : '';
    }

    /**
     * @param string $file
     * @return I18n
     */
    public function load(string $file)
    {
        $path    = static::path() . $file . '.ini';
        $content = parse_ini_file($path, true);

        $lang = \DI::instance()->get('lang') ?: [];

        foreach ($content as $key => $value) {
            $lang[str_replace('/', '.', $file) . '.' . $key] = $value;
        }

        \DI::instance()->set('lang', $lang);

        return $this;
    }

    /**
     * Gets all the valid modules.
     *
     * @return array
     */
    public function all(): array
    {
        /** @var Module $module */
        $module = \DI::instance()->get('module');

        $localizations = [];
        $path = path('modules') . sprintf('%s/Language/', $module->module);
        if (in_array($module->module, ['Admin', 'Front'])) {
            $path = sprintf('%s/flexi/Cms/%s/Language/', ROOT_DIR, $module->module);
        }
        foreach (scandir($path) as $localization) {
            // Ignore hidden directories.
            if ($localization === '.' || $localization === '..') continue;

            // Does the language have a valid lang.php?
            $local = $path . $localization . '/lang.json';
            if (is_file($local)) {
                // Add it to the lang array.
                array_push($localizations, json_decode(
                    file_get_contents($local)
                ));
            }
        }

        return $localizations;
    }

    /**
     * @return string
     */
    private static function path(): string
    {
        /** @var Module $module */
        $module = \DI::instance()->get('module');
        $path = path('modules') . sprintf('%s/Language/%s/', $module->module, Config::item('defaultLang'));
        if (in_array($module->module, ['Admin', 'Front'])) {
            $path = sprintf('%s/flexi/Cms/%s/Language/%s/', ROOT_DIR, $module->module, Config::item('defaultLang'));
        }

        return $path;
    }
}
