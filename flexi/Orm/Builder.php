<?php
namespace Flexi\Orm;

/**
 * Class Builder
 * @package Flexi\Orm
 */
class Builder
{

    /**
     * Builds the INSERT clause.
     *
     * @param  string  $table   Table to insert data into.
     * @param  array   $insert  The fields and values to insert.
     * @return string
     */
    public static function insert(string $table, array $insert): string
    {
        $set    = [];
        $values = [];

        foreach (array_keys($insert) as $column) {
            array_push($set, $column);
            array_push($values, ':' . $column);
        }

        return 'INSERT INTO ' . $table . ' (' . implode(', ', $set) . ') VALUES (' . implode(', ', $values) . ') ';
    }

    /**
     * Builds the UPDATE clause.
     *
     * @param  string  $table       Table to insert data into.
     * @param  array   $attributes  The fields and values to update.
     * @return string
     */
    public static function update(string $table, array $attributes): string
    {
        $set = [];

        foreach (array_keys($attributes) as $column) {
            array_push($set, '`' . $column . '` = :' . $column);
        }

        return 'UPDATE ' . $table . ' SET ' . implode(', ', $set);
    }

    /**
     * Builds the DELETE clause.
     *
     * @param  string  $table  The table name.
     * @return string
     */
    public static function delete(string $table): string
    {
        return 'DELETE FROM ' . $table;
    }

    /**
     * Builds the SELECT clause.
     *
     * @param  array  $fields  The fields to select.
     * @return string
     */
    public static function select(array $fields = []): string
    {
        if (empty($fields)) {
            return 'SELECT * ';
        } else {
            return 'SELECT ' . implode(', ', $fields) . ' ';
        }
    }

    /**
     * Builds the FROM clause.
     *
     * @param  string  $table  The name of the table to pull data from.
     * @return string
     */
    public static function from(string $table): string
    {
        return ' FROM ' . $table;
    }

    /**
     * Builds the WHERE clause.
     *
     * @param  array  $where  The where clause options.
     * @return string
     */
    public static function where(array $where = []): string
    {
        // Return nothing if $where is empty.
        if (empty($where)) {
            return '';
        } else {
            $clause = ' WHERE ';
            $first  = true;

            foreach ($where as $w) {
                $value = ':' . $w['column'];

                if ($first == false) {
                    $clause .= ' AND ';
                }
                $clause .= $w['column'] . ' ' . $w['operator'] . ' ' . $value;

                $first = false;
            }
        }

        return $clause;
    }

    public static function orderBy(array $orderBy)
    {
        // Return nothing if $where is empty.
        if (empty($orderBy)) {
            return '';
        } else {
            $clause = ' ORDER BY ';

            foreach ($orderBy as $key => $order) {
                if (array_key_exists($key + 1, $orderBy)) {
                    $clause .= $order['column'] . ' ' . $order['direction'] . ', ';
                } else {
                    $clause .= $order['column'] . ' ' . $order['direction'];
                }
            }
        }

        return $clause;
    }

    /**
     * Builds the DESCRIBE clause.
     *
     * @param  string  $table  The table name.
     * @return string
     */
    public static function describe(string $table): string
    {
        return 'DESCRIBE ' . $table;
    }
}
