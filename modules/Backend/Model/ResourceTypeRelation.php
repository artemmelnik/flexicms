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
 * Class ResourceTypeRelation
 * @package Modules\Backend\Model
 */
class ResourceTypeRelation extends Model
{
    /**
     * @var int
     */
    protected $resourceTypeId;

    /**
     * @var int
     */
    protected $resourceTypeToId;

    /**
     * @var string
     */
    protected static $table = 'resource_type_relation';

    /**
     * @return array
     */
    public function columnMap(): array
    {
        return [
            'resource_type_id' => 'resourceTypeId',
            'resource_type_to_id' => 'resourceTypeToId'
        ];
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
     * @return ResourceTypeRelation
     */
    public function setResourceTypeId(int $resourceTypeId): ResourceTypeRelation
    {
        $this->resourceTypeId = $resourceTypeId;

        return $this;
    }

    /**
     * @return int
     */
    public function getResourceTypeToId(): int
    {
        return $this->resourceTypeToId;
    }

    /**
     * @param int $resourceTypeToId
     * @return ResourceTypeRelation
     */
    public function setResourceTypeToId(int $resourceTypeToId): ResourceTypeRelation
    {
        $this->resourceTypeToId = $resourceTypeToId;

        return $this;
    }

    /**
     * @param array $params
     * @return bool
     */
    public static function add(array $params)
    {
        $resourceTypeId = (int) $params['resource_type_id'];
        $resourceTypeToId = (int) $params['resource_type_to_id'];

        if (static::has($resourceTypeId, $resourceTypeToId)) {
            return false;
        }

        $resourceTypeRelation = new ResourceTypeRelation();
        $resourceTypeRelation
            ->setResourceTypeId($resourceTypeId)
            ->setResourceTypeToId($resourceTypeToId)
            ->save();

        return true;
    }

    /**
     * @param int $resourceTypeId
     * @param int $resourceTypeToId
     * @return bool
     */
    public static function has(int $resourceTypeId, int $resourceTypeToId)
    {
        $query = Query::table(static::$table)
            ->where('resource_type_id', '=', $resourceTypeId)
            ->where('resource_type_to_id', '=', $resourceTypeToId)
            ->all();

        if (empty($query)) {
            return false;
        }

        return true;
    }
}
