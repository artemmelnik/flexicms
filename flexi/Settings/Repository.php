<?php
namespace Flexi\Settings;

/**
 * Class Repository
 * @package Flexi\Settings
 */
class Repository
{
    /**
     * @var array Stored setting items.
     */
    protected static $stored = [];

    /**
     * Stores a setting item.
     *
     * @param  string  $section  The item group.
     * @param  mixed   $data   The item data.
     * @return void
     */
    public static function store($section, $data)
    {
        // Ensure the group is a valid array.
        if (!isset(static::$stored[$section])) {
            static::$stored[$section] = [];
        }

        /**
         * Store the data.
         * @var \Flexi\Orm\Model $data
         */
        static::$stored[$section][$data->getAttribute('key_field')] = $data;
    }

    /**
     * Retrieves a setting item.
     *
     * @param  string  $section  The item group.
     * @param  string  $key    The item key.
     * @return mixed
     */
    public static function retrieve($section, $key)
    {
        return isset(static::$stored[$section][$key]) ? static::$stored[$section][$key] : false;
    }

    /**
     * Retrieves a settings item.
     *
     * @param  string  $section  The item group.
     * @return mixed
     */
    public static function retrieveGroup($section)
    {
        return isset(static::$stored[$section]) ? static::$stored[$section] : false;
    }
}
