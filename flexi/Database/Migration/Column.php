<?php
namespace Flexi\Database\Migration;

/**
 * Class Column
 * @package Flexi\Database\Migration
 */
class Column
{
    /**
     * @var string Column name.
     */
    public $name = '';

    /**
     * @var string Column type.
     */
    public $type = '';

    /**
     * @var int Column length.
     */
    public $length = 0;

    /**
     * @var string Column default value.
     */
    public $default = '';

    /**
     * @var bool Column nullable.
     */
    public $nullable = false;

    /**
     * @var bool Column auto increments.
     */
    public $autoincrement = false;

    /**
     * Constructor.
     *
     * @param  array  $config  The column configuration.
     */
    public function __construct(array $config = [])
    {
        foreach ($config as $key => $value) {
            $this->$key = $value;
        }
    }

    /**
     * Make the column nullable.
     *
     * @return Column
     */
    public function nullable(): Column
    {
        // Set column as nullable.
        $this->nullable = true;

        // Return object.
        return $this;
    }

}
