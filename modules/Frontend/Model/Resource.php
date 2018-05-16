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
     * @param $segment
     * @return bool|Model
     */
    public function getResourceBySegment($segment)
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

    /**
     * @param array $params
     * @return array
     */
    public function getResourcesByParams(array $params = [])
    {
        $sql = '';
        $sql .= 'SELECT';
        $sql .= ' r.* ';
        $sql .= 'FROM ' . static::$table . ' as r ';

        if (isset($params['in_categories'])) {
            //$sql .= 'JOIN category as c ON r.id = c.resource_id';
            $sql .= 'JOIN resource_to_category as rtc ON r.id = rtc.resource_id ';
            $sql .= 'WHERE rtc.category_id IN(' . $params['in_categories'] . ')';
            $sql .= 'AND r.resource_type_id=' . $params['resource_type_id'];
        } else {
            $sql .= 'WHERE r.resource_type_id=' . $params['resource_type_id'];
        }

        $result = Query::result($sql);

        //$model = __CLASS__;

        /*if ($model !== null) {
            $records = [];
            foreach ($result as $record) {
                $model = new $model;
                foreach ($record as $attribute => $value) {
                    $model->$attribute = $value;
                }

                array_push($records, $model);
            }
        } else {
            $records = $result;
        }*/

        $records = $result;

        return $records;
    }

    /**
     * @param int $resourceId
     * @return array
     */
    public function getResourceRelation(int $resourceId)
    {
        $sql = "
            SELECT
              *
            FROM resource as r
            JOIN resource_relation as rr
              ON r.id = rr.resource_id
            WHERE rr.resource_to_id = {$resourceId}
        ";

        $result = Query::result($sql);

        return $result;
    }
}
