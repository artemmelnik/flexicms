<?php
/**
 * This file is part of the FlexiCMS (https://flexicms.org)
 * Copyright (c) 2017 Artem Melnik (https://artemmelnik.com)
 */

declare(strict_types=1);

namespace Modules\Frontend\Model;

use Flexi\Orm\Model;

/**
 * Class Category
 * @package Modules\Frontend\Model
 */
class Category extends Model
{
    /**
     * @var string
     */
    protected static $table = 'category';

    /**
     * @param int $resourceId
     * @param array $params
     * @return array
     */
    public function getCategoriesByResourceId(int $resourceId, array $params = [])
    {
        if (!isset($params['language'])) {
            $params['language'] = 'ru';
        }

        $sql = "
          SELECT 
            c.*,
            cd.*
          FROM " . static::$table . " as c
          JOIN category_description as cd
            ON c.id = cd.category_id
          JOIN resource_to_category as rtc
            ON rtc.resource_id = {$resourceId}
              AND rtc.category_id = c.id
          WHERE cd.language = '{$params['language']}'
        ";

        return \Query::result($sql);
    }

    /**
     * @param int $resourceTypeId
     * @param string $language
     * @return array
     */
    public function getTreeCategoriesByResourceType(int $resourceTypeId, string $language)
    {
        $categories = [];

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

        $result = \Query::result($sql);

        foreach ($result as $item) {
            if ($item->parent_id == 0) {
                $categories[$item->id] = $item;
                $categories[$item->id]->child = [];
            }
        }

        foreach ($result as $item) {
            if ($item->parent_id !== 0) {
                $categories[$item->parent_id]->child[$item->id] = $item;
            }
        }

        unset($categories[0]);

        return $categories;
    }
}
