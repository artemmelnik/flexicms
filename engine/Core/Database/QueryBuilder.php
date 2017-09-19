<?php

namespace Engine\Core\Database;

class QueryBuilder
{
    /**
     * @var array
     */
    protected $sql = [];

    /**
     * @var array
     */
    public $values = [];

    /**
     * @param string $fields
     * @return $this
     */
    public function select($fields = '*')
    {
        $this->reset();
        $this->sql['select'] = "SELECT {$fields} ";

        return $this;
    }

    /**
     * @return $this
     */
    public function delete()
    {
        $this->reset();
        $this->sql['delete'] = "DELETE ";

        return $this;
    }

    /**
     * @param $table
     * @return $this
     */
    public function from($table)
    {
        $this->sql['from'] = "FROM {$table} ";

        return $this;
    }

    /**
     * @param string $column
     * @param string $value
     * @param string $operator
     * @return $this
     */
    public function where($column, $value, $operator = '=')
    {
        $this->sql['where'][] = "{$column} {$operator} ?";
        $this->values[] = $value;

        return $this;
    }

    /**
     * @param $field
     * @param $order
     * @return $this
     */
    public function orderBy($field, $order)
    {
        $this->sql['order_by'] = "ORDER BY {$field} {$order}";

        return $this;
    }

    /**
     * @param $number
     * @return $this
     */
    public function limit($number)
    {
        $this->sql['limit'] = " LIMIT {$number}";

        return $this;
    }

    /**
     * @param $table
     * @return $this
     */
    public function update($table)
    {
        $this->reset();
        $this->sql['update'] = "UPDATE {$table} ";

        return $this;
    }

    public function insert($table)
    {
        $this->reset();
        $this->sql['insert'] = "INSERT INTO {$table} ";

        return $this;
    }

    /**
     * @param array $data
     * @return $this
     */
    public function set($data = [])
    {
        $this->sql['set'] .= "SET ";

        if(!empty($data)) {
            foreach ($data as $key => $value) {
                $this->sql['set'] .= "{$key} = ?";
                if (next($data)) {
                    $this->sql['set'] .= ", ";
                }
                $this->values[]    = $value;
            }
        }

        return $this;
    }

    /**
     * @return string
     */
    public function sql()
    {
        $sql = '';

        if(!empty($this->sql)) {
            foreach ($this->sql as $key => $value) {
                if ($key == 'where') {
                    $sql .= ' WHERE ';
                    foreach ($value as $where) {
                        $sql .= $where;
                        if (count($value) > 1 and next($value)) {
                            $sql .= ' AND ';
                        }
                    }
                } else {
                    $sql .= $value;
                }
            }
        }

        return $sql;
    }

    /**
     * Reset Builder
     */
    public function reset()
    {
        $this->sql    = [];
        $this->values = [];
    }
}