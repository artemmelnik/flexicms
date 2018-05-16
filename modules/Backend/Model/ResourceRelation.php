<?php
/**
 * This file is part of the FlexiCMS (https://flexicms.org)
 * Copyright (c) 2017 Artem Melnik (https://artemmelnik.com)
 */

declare(strict_types=1);

namespace Modules\Backend\Model;

use Flexi\Orm\Model;
use Flexi\Orm\Query;

/**
 * Class ResourceRelation
 * @package Modules\Backend\Model
 */
class ResourceRelation extends Model
{
    /**
     * @var int
     */
    protected $resourceId;

    /**
     * @var int
     */
    protected $resourceToId;

    /**
     * @var int
     */
    protected $resourceTypeId;

    /**
     * @var string
     */
    protected static $table = 'resource_relation';

    /**
     * @return array
     */
    public function columnMap(): array
    {
        return [
            'resource_id' => 'resourceId',
            'resource_to_id' => 'resourceToId',
            'resource_type_id' => 'resourceTypeId'
        ];
    }

    /**
     * @return int
     */
    public function getResourceId(): int
    {
        return $this->resourceId;
    }

    /**
     * @param int $resourceId
     * @return ResourceRelation
     */
    public function setResourceId(int $resourceId): ResourceRelation
    {
        $this->resourceId = $resourceId;

        return $this;
    }

    /**
     * @return int
     */
    public function getResourceToId(): int
    {
        return $this->resourceToId;
    }

    /**
     * @param int $resourceToId
     * @return ResourceRelation
     */
    public function setResourceToId(int $resourceToId): ResourceRelation
    {
        $this->resourceToId = $resourceToId;

        return $this;
    }

    /**
     * @return int
     */
    public function getResourceTypeId(): int
    {
        return $this->resourceTypeId;
    }

    /**
     * @param int $resourceTypeId
     * @return ResourceRelation
     */
    public function setResourceTypeId(int $resourceTypeId): ResourceRelation
    {
        $this->resourceTypeId = $resourceTypeId;

        return $this;
    }

    /**
     * @param array $params
     * @return bool
     */
    public static function add(array $params)
    {
        $resourceId = (int) $params['resource_id'];
        $resourceToId = (int) $params['resource_to_id'];
        $resourceTypeId = (int) $params['resource_type_id'];

        if (static::has($resourceId, $resourceToId, $resourceTypeId)) {
            return false;
        }

        $resourceTypeRelation = new ResourceRelation();
        $resourceTypeRelation
            ->setResourceId($resourceId)
            ->setResourceToId($resourceToId)
            ->setResourceTypeId($resourceTypeId)
            ->save();

        return true;
    }

    /**
     * @param int $resourceId
     * @param int $resourceToId
     * @param int $resourceTypeId
     * @return bool
     */
    public static function has(int $resourceId, int $resourceToId, int $resourceTypeId)
    {
        $query = Query::table(static::$table)
            ->where('resource_id', '=', $resourceId)
            ->where('resource_to_id', '=', $resourceToId)
            ->where('resource_type_id', '=', $resourceTypeId)
            ->all();

        if (empty($query)) {
            return false;
        }

        return true;
    }

    /**
     * @param int $resourceId
     * @return array
     */
    public static function getRelationByResourceId(int $resourceId): array
    {
        $relations = [];

        $query = Query::table(static::$table)
            ->where('resource_id', '=', $resourceId)
            ->all();

        foreach ($query as $item) {
            $relations[$item->resource_type_id][$item->resource_to_id] = $item->resource_to_id;
        }

        return $relations;
    }
}
