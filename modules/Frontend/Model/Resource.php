<?php

namespace Modules\Frontend\Model;

use Flexi\Orm\Model;
use Flexi\Orm\Query;

/**
 * Class Resource
 * @package Modules\Frontend\Model
 */
class Resource extends Model
{
    /**
     * @var string
     */
    protected static $table = 'resource';

    /**
     * @param string $segment
     * @return bool|Model
     */
    public function getResourceBySegment(string $segment)
    {
        $query = Query::table(self::$table, __CLASS__)
            ->select()
            ->where('segment', '=', $segment)
            ->first();

        return $query;
    }

    public function getNextResource(int $resourceId)
    {
        $sql = "SELECT * FROM " . static::$table . " WHERE id > {$resourceId} LIMIT 1";

        $result = Query::result($sql);

        return isset($result[0]) ? $result[0] : null;
    }

    public function getPrevResource(int $resourceId)
    {
        $sql = "SELECT * FROM " . static::$table . " WHERE id < {$resourceId} ORDER BY id DESC LIMIT 1";

        $result = Query::result($sql);

        return isset($result[0]) ? $result[0] : null;
    }

    /**
     * @param int $typeId
     * @param array $params
     * @return array|Query
     */
    public function getResources(int $typeId, array $params = [])
    {
        $fields = [];

        $query = Query::table(static::$table, __CLASS__)
            ->select($fields)
            ->where('resource_type_id', '=', $typeId);

        /*if (isset($params['categories']) && !empty($params['categories'])) {
            foreach ($params['categories'] as $categoryId) {
                ->where('resource_type_id', '=', $typeId);
            }
        }*/

        if (isset($params['order_by']) && is_array($params['order_by'])) {
            foreach ($params['order_by'] as $column => $direction) {
                $query = $query->orderBy($column, $direction);
            }
        }

        $query = $query->all();

        return $query;
    }
}
