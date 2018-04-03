<?php

namespace Modules\Admin\Model;

use Flexi\Orm\Model;
use Flexi\Orm\Query;

/**
 * Class ResourceToCategory
 * @package Modules\Admin\Model
 */
class ResourceToCategory extends Model
{
    /**
     * @var string
     */
    protected static $table = 'resource_to_category';

    /**
     * @param int $resourceId
     * @return array
     */
    public function getIdsCategoriesByResourceId(int $resourceId)
    {
        $sql = "SELECT * FROM " . static::$table . " WHERE resource_id = {$resourceId}";

        $ids = [];
        $result = Query::result($sql);

        foreach ($result as $item) {
            $ids[$item->category_id] = $item->category_id;
        }

        return $ids;
    }

    /**
     * @param array $params
     * @return bool
     */
    public function add(array $params)
    {
        $resourceToCategory = new ResourceToCategory();
        $resourceToCategory->setAttribute('resource_id', $params['resource_id']);
        $resourceToCategory->setAttribute('category_id', $params['category_id']);

        return $resourceToCategory->save();
    }

    /**
     * @param int $resourceId
     * @param int $categoryId
     * @return bool
     */
    public function is(int $resourceId, int $categoryId)
    {
        $sql = "
          SELECT 
            COUNT(*) as count
          FROM " . static::$table . "
          WHERE resource_id = {$resourceId}
            AND category_id = {$categoryId}
        ";

        $result = \Query::result($sql);

        return (bool) $result[0]->count;
    }

    /**
     * @param int $resourceId
     * @return \Flexi\Orm\Query
     */
    public function deleteAll(int $resourceId)
    {
        return \Query::table(static::$table)
            ->delete()
            ->where('resource_id', '=', $resourceId)
            ->run('delete');
    }
}
