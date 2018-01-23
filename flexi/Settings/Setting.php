<?php
namespace Flexi\Settings;

/**
 * Class Setting
 * @package Flexi\Settings
 */
class Setting
{
    /**
     * Retrieves a setting item.
     *
     * @param  string  $key
     * @param  string  $section
     * @return mixed
     */
    public static function item($key, $section = 'general')
    {
        if (!Repository::retrieve($section, $key)) {
            self::get($section);
        }

        return Repository::retrieve($section, $key);
    }

    /**
     * Retrieves a setting item value.
     *
     * @param string $key
     * @param string $section
     * @return mixed
     */
    public static function value($key, $section = 'general')
    {
        /** @var \Flexi\Orm\Model $item */
        $item = static::item($key, $section);

        return $item ? $item->getAttribute('value') : '';
    }

    /**
     * @param string $section
     * @return bool
     */
    public static function get(string $section): bool
    {
        $settings = \Modules\Admin\Model\Setting::select()
            ->where('section', '=', $section)
            ->all()
        ;

        // Items must be an array.
        if (is_array($settings) && !empty($settings)) {
            // Store items.
            foreach ($settings as $key => $value) {
                Repository::store($section, $value);
            }

            // Successful settings load.
            return true;
        }

        // Settings load unsuccessful.
        return false;
    }
}
