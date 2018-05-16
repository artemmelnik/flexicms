<?php
/**
 * This file is part of the FlexiCMS (https://flexicms.org)
 * Copyright (c) 2017 Artem Melnik (https://artemmelnik.com)
 */

declare(strict_types=1);

namespace Modules\Backend\Model;

use Flexi\Orm\Model;
use Query;

/**
 * Class ResourceType
 * @package Modules\Backend\Model
 */
class ResourceType extends Model
{
    /**
     * @var int
     */
    protected $id;

    /**
     * @var string
     */
    protected $title;

    /**
     * @var string
     */
    protected $name;

    /**
     * @var string
     */
    protected static $table = 'resource_type';

    /**
     * @return array
     */
    public function columnMap(): array
    {
        return [
            'id'    => 'id',
            'title' => 'title',
            'name'  => 'name',
        ];
    }

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @param int $id
     * @return ResourceType
     */
    public function setId(int $id): ResourceType
    {
        $this->id = $id;

        return $this;
    }

    /**
     * @return string
     */
    public function getTitle(): string
    {
        return $this->title;
    }

    /**
     * @param string $title
     * @return ResourceType
     */
    public function setTitle(string $title): ResourceType
    {
        $this->title = $title;

        return $this;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @param string $name
     * @return ResourceType
     */
    public function setName(string $name): ResourceType
    {
        $this->name = $name;

        return $this;
    }

    /**
     * @param array $params
     * @return bool
     */
    public function addResourceType(array $params)
    {
        $resourceType = new ResourceType;
        $resourceType
            ->setTitle($params['title'])
            ->setName($params['name']);

        return $resourceType->save();
    }

    public function getResourcesType()
    {
        $query = Query::table(static::$table)
            ->select()
            ->orderBy('id', 'asc')
            ->all();

        return $query;
    }

    /**
     * @param string $name
     * @return bool|Model
     */
    public function getResourceTypeByName(string $name)
    {
        return Query::table(static::$table)
            ->select()
            ->where('name', '=', $name)
            ->first();
    }

    /**
     * @param int $id
     * @return bool|Model
     */
    public function getResourceType(int $id)
    {
        return Query::table(static::$table)
            ->select()
            ->where('id', '=', $id)
            ->first();
    }

    public function getResourceTypeRelations(int $resourceTypeId)
    {
        $sql = "
            SELECT
              rt.*
            FROM " . static::$table . " as rt
            JOIN " . ResourceTypeRelation::getTable() . " as rtr
                ON rt.id = rtr.resource_type_to_id
            WHERE rtr.resource_type_id = {$resourceTypeId}
        ";

        return Query::result($sql);
    }
}
