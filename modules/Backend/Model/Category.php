<?php
/**
 * This file is part of the FlexiCMS (https://flexicms.org)
 * Copyright (c) 2017 Artem Melnik (https://artemmelnik.com)
 */

declare(strict_types=1);

namespace Modules\Backend\Model;

use Flexi\Orm\Model;

/**
 * Class Category
 * @package Modules\Backend\Model
 */
class Category extends Model
{
    /**
     * @var int
     */
    protected $id;

    /**
     * @var int
     */
    protected $parentId;

    /**
     * @var int
     */
    protected $resourceTypeId;

    /**
     * @var int
     */
    protected $image;

    /**
     * @var \DateTime
     */
    protected $dateAdded;

    /**
     * @var string
     */
    protected static $table = 'category';

    /**
     * @return array
     */
    public function columnMap(): array
    {
        return [
            'id'               => 'id',
            'parent_id'        => 'parentId',
            'resource_type_id' => 'resourceTypeId',
            'image'            => 'image',
            'date_added'       => 'dateAdded'
        ];
    }

    /**
     * @return int
     */
    public function getId(): int
    {
        return (int) $this->id;
    }

    /**
     * @param int $id
     * @return Category
     */
    public function setId(int $id): Category
    {
        $this->id = $id;

        return $this;
    }

    /**
     * @return int
     */
    public function getParentId(): int
    {
        return $this->parentId;
    }

    /**
     * @param int $parentId
     * @return Category
     */
    public function setParentId(int $parentId): Category
    {
        $this->parentId = $parentId;

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
     * @return Category
     */
    public function setResourceTypeId(int $resourceTypeId): Category
    {
        $this->resourceTypeId = $resourceTypeId;

        return $this;
    }

    /**
     * @return int
     */
    public function getImage(): int
    {
        return $this->image;
    }

    /**
     * @param int $image
     * @return Category
     */
    public function setImage(int $image): Category
    {
        $this->image = $image;

        return $this;
    }

    /**
     * @return \DateTime
     */
    public function getDateAdded(): \DateTime
    {
        return $this->dateAdded;
    }

    /**
     * @param \DateTime $dateAdded
     * @return Category
     */
    public function setDateAdded(\DateTime $dateAdded): Category
    {
        $this->dateAdded = $dateAdded;

        return $this;
    }

    /**
     * @param array $params
     * @return int
     */
    public function add(array $params)
    {
        $category = new Category();
        $category->setParentId(0);
        $category->setResourceTypeId(intval($params['resource_type_id']));
        $category->setImage(0);
        $category->save();

        $categoryId = $category->getId();

        if (isset($params['name']) && isset($params['description'])) {
            foreach ($params['name'] as $code => $name) {
                CategoryDescription::add([
                    'category_id' => $categoryId,
                    'language' => $code,
                    'name' => $name,
                    'description' => $params['description'][$code]
                ]);
            }
        }

        return $categoryId;
    }

    /**
     * @param int $id
     * @return array
     */
    public function getCategoryById(int $id)
    {
        $sql = "
          SELECT 
            c.*,
            cd.*
          FROM " . static::$table . " as c
          JOIN " . CategoryDescription::getTable() . " as cd
            ON c.id = cd.category_id
          WHERE c.id = {$id}
          ORDER BY id ASC
          ";

        $result = \Query::result($sql);
        $category = [];

        foreach ($result as $item) {
            $category[$item->language] = $item;
        }

        return $category;
    }

    /**
     * @param int $resourceTypeId
     * @param string $language
     * @return array
     */
    public function getCategoriesByResourceType(int $resourceTypeId, string $language)
    {
        $sql = "
          SELECT 
            c.*,
            cd.*
          FROM " . static::$table . " as c
          JOIN " . CategoryDescription::getTable() . " as cd
            ON c.id = cd.category_id AND cd.language = '{$language}'
          WHERE c.resource_type_id = {$resourceTypeId}
          ORDER BY id ASC
          ";

        return \Query::result($sql);
    }
}
