<?php
namespace Flexi\Orm;

use Flexi\Database\Database;

/**
 * Class Model
 * @property
 * @property-read string id
 * @property-write
 * @package Flexi\Orm
 */
class Model
{
    /**
     * @var  string  The table name.
     */
    protected static $table = '';

    /**
     * @var array Model attributes.
     */
    protected $attributes = [];

    /**
     * @var array Protected attributes that won't get passed via the save method.
     */
    protected $guarded = ['id'];

    /**
     * Model constructor.
     */
    public function __construct()
    {
    }

    /**
     * @return string
     */
    public static function getTable(): string
    {
        return static::$table;
    }

    /**
     * Gets an attribute.
     *
     * @param  string  $attribute  The attribute to get.
     * @return mixed
     */
    public function __get(string $attribute)
    {
        return $this->getAttribute($attribute);
    }

    /**
     * Sets an attribute.
     *
     * @param  string  $attribute  The attribute name.
     * @param  mixed   $value      The attribute value.
     * @return void
     */
    public function __set(string $attribute, $value)
    {
        $this->setAttribute($attribute, $value);
    }

    /**
     * Gets all model attributes.
     *
     * @return array
     */
    public function attributes(): array
    {
        return $this->attributes;
    }

    /**
     * Gets a model attribute.
     *
     * @param  string  $attribute  The attribute to get.
     * @return mixed
     */
    public function getAttribute(string $attribute)
    {
        return $this->attributes[$attribute] ?? false;
    }

    /**
     * Sets a model attribute.
     *
     * @param  string  $attribute
     * @param  mixed   $value
     * @return void
     */
    public function setAttribute(string $attribute, $value)
    {
        $this->attributes[$attribute] = $value;
    }

    /**
     * Checks to see if an attribute exists.
     *
     * @param  string  $attribute  The attribute to check.
     * @return bool
     */
    public function hasAttribute(string $attribute): bool
    {
        return isset($this->attributes[$attribute]);
    }

    /**
     * Saves the record.
     *
     * @return bool
     */
    public function save(): bool
    {
        // Get the model attributes.
        $attributes = $this->attributes();

        // Remove guarded attributes.
        foreach ($this->guarded as $guarded) {
            if (isset($attributes[$guarded])) {
                unset($attributes[$guarded]);
            }
        }

        // Instantiate query.
        $query  = static::query();

        // If we have an id then update the record.
        if ($this->hasAttribute('id')) {
            $query  = $query->where('id', '=', $this->getAttribute('id'));
            $saved  = $query->edit($attributes);
        } else {
            $saved  = $query->create($attributes);

            // If successfully created, add the insert id.
            if ($saved) {
                $this->setAttribute('id', Database::insertId());
            }
        }

        // Return true if successfully saved.
        return $saved;
    }

    /**
     * Gets all records from the table.
     *
     * @return array
     */
    public static function all(): array
    {
        $query = static::query();
        return $query->all();
    }

    /**
     * Instantiates a model query with the SELECT clause.
     *
     * @param  array  $fields  The fields to select.
     * @return \Flexi\Orm\Query
     */
    public static function select(array $fields = []): Query
    {
        $query = static::query();
        return $query->select($fields);
    }

    /**
     * Instantiates a model query with the WHERE clause.
     *
     * @param  string $column    The name of the column.
     * @param  string $operator  The clause operator.
     * @param  mixed  $value     The value to check against the column.
     * @return \Flexi\Orm\Query
     */
    public static function where(string $column, string $operator = '=', $value): Query
    {
        $query = static::query();
        return $query->where($column, $operator, $value);
    }

    /**
     * Instantiates a new query for this table.
     *
     * @return \Flexi\Orm\Query
     */
    public static function query(): Query
    {
        return new Query(static::$table, get_called_class());
    }
}
