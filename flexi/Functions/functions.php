<?php

/**
 * Returns path to a Flexi CMS folder.
 *
 * @param  string $section
 * @return string
 */
function path($section)
{
    // Return path to correct section.
    switch (strtolower($section))
    {
        case 'config':
            return $_SERVER['DOCUMENT_ROOT'] . '/config/';
        case 'modules':
            return $_SERVER['DOCUMENT_ROOT'] . '/modules/';
        case 'content':
            return $_SERVER['DOCUMENT_ROOT'] . 'content/';
        default:
            return $_SERVER['DOCUMENT_ROOT'];
    }
}

/**
 * @param string $section
 * @return string
 */
function path_content($section = '')
{
    // Return path to correct section.
    switch (strtolower($section))
    {
        case 'themes':
            return path('content') . 'themes';
        case 'plugins':
            return path('content') . 'plugins';
        case 'uploads':
            return path('content') . 'uploads';
        default:
            return path('content');
    }
}

/**
 * Return list themes.
 *
 * @return array
 */
function getThemes()
{
    $themesPath = path_content('themes');
    $list       = scandir($themesPath);
    $themes     = [];

    if (!empty($list)) {
        foreach ($list as $dir) {
            // Ignore hidden directories.
            if ($dir === '.' || $dir === '..') continue;

            $pathThemeDir = $themesPath . '/' . $dir;
            $pathConfig   = $pathThemeDir . '/theme.json';
            $pathScreen   = '/content/themes/' . $dir . '/screen.jpg';

            if (is_dir($pathThemeDir) && is_file($pathConfig)) {
                $config = file_get_contents($pathConfig);
                $info   = json_decode($config);

                $info->screen   = $pathScreen;
                $info->dirTheme = $dir;

                $themes[] = $info;
            }
        }
    }

    return $themes;
}

/**
 * Return list plugins.
 *
 * @return array
 */
function getPlugins()
{
    $pluginsPath = path_content('plugins');
    $list        = scandir($pluginsPath);
    $plugins     = [];

    if (!empty($list)) {
        foreach ($list as $namePlugin) {
            // Ignore hidden directories.
            if ($namePlugin === '.' || $namePlugin === '..') continue;

            $namespace = '\\Plugin\\' . $namePlugin . '\\Plugin';

            if (class_exists($namespace)) {
                /** @var Flexi\Plugin $plugin */
                $plugin = new $namespace();
                $plugins[$namePlugin] = $plugin->details();
            }
        }
    }

    return $plugins;
}

/**
 * @param string $switch
 * @return array
 */
function getTypes($switch = 'page')
{
    $themePath = path_content('themes') . '/' . \Setting::value('active_theme', 'theme');
    $list      = scandir($themePath);
    $types     = [];

    if (!empty($list)) {
        foreach ($list as $name) {
            // Ignore hidden directories.
            if ($name === '.' || $name === '..') continue;

            if (\Flexi\Helper\Common::searchMatchString($name, $switch)) {
                $chunk = explode('.', $name, 3);

                if ($chunk[0] == $switch && $chunk[1] == 'phtml') continue;

                list($switch, $key, $extension) = $chunk;

                // Ignore files.
                if ($key === $switch || $key === 'layout') continue;

                if (!empty($key)) {
                    $types[$key] = ucfirst($key);
                }
            }
        }
    }

    return $types;
}

function getLayouts()
{
    $themePath = path_content('themes') . '/' . \Setting::value('active_theme', 'theme');
    $list      = scandir($themePath);
    $layouts   = [];

    if (!empty($list)) {
        foreach ($list as $name) {
            // Ignore hidden directories.
            if ($name === '.' || $name === '..') continue;

            if (\Flexi\Helper\Common::searchMatchString($name, 'layout')) {
                $chunk = explode('.', $name, 3);

                list($switch, $key, $extension) = $chunk;

                // Ignore files.
                if ($switch === 'main' || $key !== 'layout') continue;

                if (!empty($key)) {
                    $layouts[$switch] = ucfirst($switch);
                }
            }
        }
    }

    return $layouts;
}
