<?php

namespace Modules\Front\Model;

use Flexi\Orm\Model;
use Flexi\Orm\Query;

/**
 * Class Resource
 * @package Modules\Front\Model
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

        if (isset($params['order_by']) && is_array($params['order_by'])) {
            foreach ($params['order_by'] as $column => $direction) {
                $query = $query->orderBy($column, $direction);
            }
        }

        $query = $query->all();

        return $query;
    }
}
