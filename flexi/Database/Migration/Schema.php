<?php
namespace Flexi\Database\Migration;

use Flexi\Database\Statement;

/**
 * Class Schema
 * @package Flexi\Database\Migration
 */
class Schema
{

    /**
     * Creates a new database schema.
     *
     * @param  string    $name     The table name.
     * @param  \Closure  $closure  The schema blueprint.
     * @return void
     */
    public static function create(string $name, \Closure $closure)
    {
        // Instantiate the Blueprint class.
        $blueprint = new Blueprint($name);

        // Get the table blueprint.
        $closure($blueprint);

        // Build the create table syntax.
        $sql = sprintf('CREATE TABLE IF NOT EXISTS `%s` (', $name);

        // Loop through each column to add it.
        $total  = count($blueprint->columns);
        $i      = 0;
        foreach ($blueprint->columns as $column) {
            // Add column name and type.
            $sql .= sprintf('`%s` %s', $column->name, $column->type);

            // Do we have a length?
            if ($column->length !== 0) {
                $sql .= '(' . $column->length . ')';
            }

            // Set nullable/default.
            if ($column->nullable === true && $column->default === '') {
                $sql .= ' DEFAULT NULL';
            } else if ($column->default !== '') {
                $sql .= sprintf(' DEFAULT "%s"', $column->default);
            } else {
                $sql .= ' NOT NULL';
            }

            // Set auto increment?
            if ($column->autoincrement === true) {
                $sql .= ' AUTO_INCREMENT';
            }

            // Increment.
            ++$i;

            // If we're no at the end add the comma for the next line.
            if ($i < $total) {
                $sql .= ', ';
            }
        }

        // Do we have a primary key.
        if ($blueprint->primary !== '') {
            $sql .= sprintf(', PRIMARY KEY(`%s`)', $blueprint->primary);
        }

        // Close syntax.
        $sql .= ')';

        // Prepare the database statement.
        $statement = new Statement($sql);

        // Run the command.
        $statement->execute();
    }

    /**
     * Drops a table.
     *
     * @param  string  $table  The table name to drop.
     * @return void
     */
    public static function drop(string $table)
    {
        $query      = sprintf('DROP TABLE IF EXISTS `%s`', $table);
        $statement  = new Statement($query);

        $statement->execute();
    }
}
