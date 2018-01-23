<?php
namespace Modules\Front\Model;

use Flexi\Orm\Model;
use Query;

/**
 * Class Post
 * @package Modules\Front\Model
 */
class Post extends Model
{
    /**
     * @var string
     */
    protected static $table = 'post';

    /**
     * @param array $ids
     * @return array
     */
    public function getPostsInId(array $ids)
    {
        if (empty($ids)) return [];

        $result = Query::result("
            SELECT
              *
            FROM " . static::$table . "
            WHERE id IN(" . implode(',', $ids) . ")
        ");

        return $result;
    }

    /**
     * @param int $id
     * @return bool|Post
     */
    public function getPost($id)
    {
        return Query::table(static::$table, __CLASS__)
            ->select()
            ->where('id', '=', $id)
            ->first()
        ;
    }
}
