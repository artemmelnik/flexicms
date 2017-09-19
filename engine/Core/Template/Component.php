<?php

namespace Engine\Core\Template;

class Component
{
    /**
     * @param $name
     * @param array $data
     * @throws \Exception
     */
    public static function load($name, $data = [])
    {
        $templateFile = ROOT_DIR . '/content/themes/default/' . $name . '.php';

        if (ENV == 'Admin') {
            $templateFile = path('view') . '/' . $name . '.php';
        }

        if (is_file($templateFile)) {
            extract(array_merge($data, Theme::getData()));
            require($templateFile);
        } else {
            throw new \Exception(
                sprintf('View file %s does not exist!', $templateFile)
            );
        }
    }
}