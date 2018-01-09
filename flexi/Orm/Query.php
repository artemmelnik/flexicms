<?php
namespace Flexi\Orm;

use Flexi\Database\Statement;
use Exception;

/**
 * Class Query
 * @package Flexi\Orm
 */
class Query
{
    /**
     * @var  string  The table name.
     */
    protected $table = '';

    /**
     * @var  string  The built SQL.
     */
    protected $sql = '';

    /**
     * @var  string  The model reference.
     */
    protected $model = '';

    /**
     * @var  array  The query INSERT clause.
     */
    protected $insert = [];

    /**
     * @var  array  The query UPDATE clause.
     */
    protected $update = [];

    /**
     * @var  array  The query DELETE clause.
     */
    protected $delete = [];

    /**
     * @var  array  The query SELECT clause.
     */
    protected $select = [];

    /**
     * @var  array  The query WHERE clause.
     */
    protected $where = [];

    /**
     * @var  array  The query ORDER BY clause.
     */
    protected $orderBy = [];

    /**
     * @var  \Flexi\Database\Statement  The query statement.
     */
    protected $stmt;

    /**
     * @var  mixed  The query result.
     */
    protected $result;

    /**
     * @var array Valid query methods.
     */
    private $methods = [
        'create',
        'read',
        'update',
        'delete',
        'describe'
    ];

    /**
     * Constructor.
     *
     * @param  string  $table  The table to query.
     * @param  string  $model  The model to use.
     */
    public function __construct(string $table = '', string $model = '')
    {
        $this->table = $table;
        $this->model = $model;
    }

    /**
     * Sets the INSERT clause.
     *
     * @param  array  $data  The data to insert.
     * @return Query
     */
    public function insert(array $data)
    {
        $this->insert = array_merge($this->insert, $data);

        return $this;
    }

    /**
     * Sets the UPDATE clause.
     *
     * @param  array  $data  The data to update.
     * @return Query
     */
    public function update(array $data)
    {
        $this->update = array_merge($this->update, $data);

        return $this;
    }

    /**
     * @return Query
     */
    public function delete()
    {
        return $this;
    }

    /**
     * Sets the SELECT clause.
     *
     * @param  array  $fields  The fields to select.
     * @return Query
     */
    public function select(array $fields = [])
    {
        $this->select = array_merge($this->select, $fields);

        return $this;
    }

    /**
     * Sets the WHERE clause.
     *
     * @param  string $column    The name of the column.
     * @param  string $operator  The clause operator.
     * @param  mixed  $value     The value to check against the column.
     * @return Query
     */
    public function where(string $column, string $operator = '=', $value): Query
    {
        array_push($this->where, compact('column', 'operator', 'value'));

        return $this;
    }

    /**
     * Sets the ORDER BY clause.
     *
     * @param  string  $column     The column to order by.
     * @param  string  $direction  The order direction.
     * @return Query
     */
    public function orderBy(string $column, string $direction = 'asc'): Query
    {
        array_push($this->orderBy, compact('column', 'direction'));

        return $this;
    }

    /**
     * Runs the query
     *
     * @param  string  $method  The query method.
     * @throws Exception
     * @return Query
     */
    public function run(string $method = 'read'): Query
    {
        // Normalize the method.
        $method = strtolower($method);

        // Ensure this is a valid query method.
        if (!in_array($method, $this->methods)) {
            throw new Exception(
                sprintf('Invalid query method: %s', $method)
            );
        }

        // Ensure the SQL is cleared.
        $this->sql = '';

        // The builder methods we run depends on the query method.
        switch ($method) {
            case 'read':
                $this->sql .= Builder::select($this->select);
                $this->sql .= Builder::from($this->table);
                $this->sql .= Builder::where($this->where);
                break;
            case 'create':
                $this->sql .= Builder::insert($this->table, $this->insert);
                break;
            case 'update':
                $this->sql .= Builder::update($this->table, $this->update);
                $this->sql .= Builder::where($this->where);
                break;
            case 'delete':
                $this->sql .= Builder::delete($this->table);
                $this->sql .= Builder::where($this->where);
                break;
            case 'describe':
                $this->sql .= Builder::describe($this->table);
                break;
        }

        // Instantiate the statement.
        $this->stmt = new Statement($this->sql);

        // Bind WHERE values.
        foreach ($this->where as $where) {
            $this->stmt->bind(':' . $where['column'], $where['value']);
        }

        // Do we need to bind INSERT values.
        if ($method === 'create' || $method === 'update') {
            $property = $method === 'create' ? 'insert' : 'update';
            foreach ($this->$property as $key => $value) {
                $this->stmt->bind(':' . $key, $value);
            }
        }

        // Execute the statement.
        $this->result = $this->stmt->execute();

        // Return object.
        return $this;
    }

    /**
     * @param string $sql
     * @return array
     */
    public static function result(string $sql)
    {
        // Instantiate the statement.
        $stmt = new Statement($sql);
        $stmt->execute();

        return $stmt->all();
    }

    /**
     * Creates a record.
     *
     * @param  array  $attributes  Attributes to insert into the record,
     * @return bool
     */
    public function create(array $attributes = []): bool
    {
        if (!empty($attributes)) {
            $this->insert($attributes);
        }

        return $this->run('create') ? true : false;
    }

    /**
     * Updates a record.
     *
     * @param  array  $attributes  Attributes to insert into the record,
     * @return bool
     */
    public function edit(array $attributes = []): bool
    {
        if (!empty($attributes)) {
            $this->update($attributes);
        }

        return $this->run('update') ? true : false;
    }

    /**
     * Fetches all query results.
     *
     * @return array
     */
    public function all(): array
    {
        // Execute the query.
        $this->run('read');

        // Fetch results.
        $fetched = $this->stmt->all();

        // Do we need to assign results against a model.
        if ($this->model !== null) {
            $records = [];
            foreach ($fetched as $record) {
                $model = new $this->model;
                foreach ($record as $attribute => $value) {
                    $model->$attribute = $value;
                }

                array_push($records, $model);
            }
        } else {
            $records = $fetched;
        }

        // Fetch results.
        return $records;
    }

    /**
     * Fetches the first result.
     *
     * @return \Flexi\Orm\Model|bool
     */
    public function first()
    {
        // Execute the query.
        $this->run('read');

        // Fetch results.
        $fetched = $this->stmt->fetch();

        // Don't continue if fetched is null.
        if ($fetched === false) return false;

        // Do we have a model to instantiate?
        if ($this->model !== null && is_object($fetched)) {
            $record = new $this->model;
            foreach ($fetched as $attribute => $value) {
                $record->$attribute = $value;
            }
        } else {
            $record = $fetched;
        }

        // Return record.
        return $record;
    }

    /**
     * Fetches column information on the table.
     *
     * @return array
     */
    public function describe(): array
    {
        if ($this->run('describe')) {
            return $this->stmt->all();
        } else {
            return [];
        }
    }

    /**
     * Select a table to query.
     *
     * @param  string  $table  The table to query.
     * @param  string  $model  The model to use.
     * @return Query
     */
    public static function table(string $table, string $model = '')
    {
        $class = get_called_class();

        if ($model == '') {
            $model = $class;
        }

        return new $class($table, $model);
    }
}
