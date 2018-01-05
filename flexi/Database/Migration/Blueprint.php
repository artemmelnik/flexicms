<?php
namespace Flexi\Database\Migration;

use Flexi;

/**
 * Class Blueprint
 * @package Flexi\Database\Migration
 */
class Blueprint
{

    /**
     * @var string The table name.
     */
    public $table = '';

    /**
     * @var string The table primary key.
     */
    public $primary = '';

    /**
     * @var array Table columns.
     */
    public $columns = [];

    /**
     * @param  string  $table  The table name.
     */
    public function __construct(string $table)
    {
        // Store the table name.
        $this->table = $table;
    }

    /**
     * Creates a new auto increment integer.
     *
     * @param  string  $name  The column name.
     * @return Column
     */
    public function increments($name): Column
    {
        // Instantiate column.
        $column = new Column([
            'name'          => $name,
            'type'          => 'int',
            'length'        => 11,
            'autoincrement' => true
        ]);

        // Add to column list.
        array_push($this->columns, $column);

        // Set the primary key.
        $this->primary = $name;

        // Return column.
        return $column;
    }

    /**
     * Creates a new int column.
     *
     * @param  string  $name    The column name.
     * @param  int     $length  The column length.
     * @return Column
     */
    public function integer($name, $length = 11): Column
    {
        // Instantiate column.
        $column = new Column([
            'name'      => $name,
            'type'      => 'int',
            'length'    => $length
        ]);

        // Add to column list.
        array_push($this->columns, $column);

        // Return column.
        return $column;
    }

    /**
     * Creates a new varchar column.
     *
     * @param  string  $name    The column name.
     * @param  int     $length  The column length.
     * @return Column
     */
    public function string($name, $length = 200): Column
    {
        // Instantiate column.
        $column = new Column([
            'name'      => $name,
            'type'      => 'varchar',
            'length'    => $length
        ]);

        // Add to column list.
        array_push($this->columns, $column);

        // Return column.
        return $column;
    }

    /**
     * Creates a boolean column.
     *
     * @param  string  $name  The column name.
     * @return Column
     */
    public function boolean($name): Column
    {
        // Instantiate column.
        $column = new Column([
            'name'      => $name,
            'type'      => 'tinyint',
            'default'   => '0',
            'length'    => 1
        ]);

        // Add to column list.
        array_push($this->columns, $column);

        // Return column.
        return $column;
    }

    /**
     * Creates a text column.
     *
     * @param  string  $name  The column name.
     * @return Column
     */
    public function text($name): Column
    {
        return $this->add($name, 'text');
    }

    /**
     * Creates a datetime column.
     *
     * @param  string  $name  The column name.
     * @return Column
     */
    public function datetime($name): Column
    {
        return $this->add($name, 'datetime');
    }

    /**
     * Creates the created_at and updated_at timestamps.
     *
     * @return void
     */
    public function timestamps()
    {
        $this->datetime('created_at');
        $this->datetime('updated_at');
    }

    /**
     * Adds a column.
     *
     * @param  string  $name  The column name.
     * @param  string  $type  The column type.
     * @return Column
     */
    private function add($name, $type): Column
    {
        // Instantiate column.
        $column = new Column([
            'name'      => $name,
            'type'      => $type
        ]);

        // Add to column list.
        array_push($this->columns, $column);

        // Return column.
        return $column;
    }
}
