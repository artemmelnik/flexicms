<?php

namespace Engine\Core\Database;

use \ReflectionClass;
use \ReflectionProperty;


/**
 * Trait ActiveRecord
 * @package Engine\Core\Database
 */
trait ActiveRecord
{
    /**
     * Database connection object
     * @var object Connection
     */
    protected $db;

    /**
     * QueryBuilder object
     * @var object QueryBuilder
     */
    protected $queryBuilder;

    /**
     * ActiveRecord constructor.
     * @param int $id
     */
    public function __construct($id = 0)
    {
        global $di;

        $this->db           = $di->get('db');
        $this->queryBuilder = new QueryBuilder();

        if ($id) {
            $this->setId($id);
        }
    }

    /**
     * Get table name
     * @return string
     */
    public function getTable()
    {
        return $this->table;
    }

    /**
     * Find object
     * @return object|null
     */
    public function findOne()
    {
        $sql = $this->queryBuilder
             ->select()
             ->from($this->getTable())
             ->where('id', $this->id)
             ->sql();
        $values = $this->queryBuilder->getValues();

        $find = $this->db->query($sql, $values);

        return isset($find[0]) ? $find[0] : null;
    }

    /**
     * Save object
     * @return mixed
     */
    public function save() {
        $properties = $this->getIssetProperties();

        try {
            if (isset($this->id)) {
                $sql = $this->queryBuilder
                     ->update($this->getTable())
                     ->set($properties)
                     ->where('id', $this->id)
                     ->sql();
                $values = $this->queryBuilder->getValues();

                $this->db->execute($sql, $values);
            } else {
                $sql = $this->queryBuilder
                     ->insert($this->getTable())
                     ->set($properties)
                     ->sql();
                $values = $this->queryBuilder->getValues();

                $this->db->execute($sql, $values);
            }

            return $this->db->lastInsertId();

        } catch (\Exception $e) {
            echo $e->getMessage();
        }
    }

    /**
     * Get properties if is set
     * @return array
     */
    private function getIssetProperties()
    {
        $properties = [];

        foreach ($this->getProperties() as $key => $property) {
            $propertyName = $property->getName();

            if ($propertyName == 'id') {
                continue;
            }

            if (isset($this->{$propertyName})) {
                $properties[$propertyName] = $this->{$propertyName};
            }
        }

        return $properties;
    }

    /**
     * Get properties from reflection class
     * @return ReflectionProperty[]
     */
    private function getProperties()
    {
        $reflection = new ReflectionClass($this);
        $properties = $reflection->getProperties(ReflectionProperty::IS_PUBLIC);

        return $properties;
    }
}
