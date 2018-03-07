<?php

namespace Modules\Admin\Model;

use Flexi\Orm\Model;
use Query;

/**
 * Class Resource
 * @package Modules\Admin\Model
 */
class Resource extends Model
{
    /**
     * @var string
     */
    protected static $table = 'resource';

    /**
     * @param array $params
     * @return bool
     */
    public function addResource(array $params)
    {
        $resourceType = new Resource;
        $resourceType->setAttribute('resource_type_id', $params['resource_type_id']);
        $resourceType->setAttribute('title', $params['title']);
        $resourceType->setAttribute('content', $params['content']);
        $resourceType->setAttribute('thumbnail', $params['thumbnail']);
        $resourceType->setAttribute('segment', $params['segment']);
        $resourceType->setAttribute('layout', $params['layout']);
        $resourceType->setAttribute('type', $params['type']);
        $resourceType->setAttribute('status', $params['status']);
        $resourceType->setAttribute('date', $params['date']);

        return $resourceType->save();
    }

    /**
     * @param int $resourceId
     * @return array
     */
    public function getResources(int $resourceId)
    {
        $query = Query::table(static::$table, __CLASS__)
            ->select()
            ->where('resource_type_id', '=', $resourceId)
            ->orderBy('id', 'desc')
            ->all()
        ;

        return $query;
    }

    /**
     * @param int $id
     * @return bool|Model
     */
    public function getResource(int $id)
    {
        return Query::table(static::$table, __CLASS__)
            ->select()
            ->where('id', '=', $id)
            ->first();
    }
}
