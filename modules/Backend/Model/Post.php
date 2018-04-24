<?php
namespace Modules\Backend\Model;

use Flexi\Orm\Model;
use Query;

/**
 * Class Post
 * @package Modules\Backend\Model
 */
class Post extends Model
{
    /**
     * @var string
     */
    protected static $table = 'post';

    /**
     * @return array
     */
    public function getPosts()
    {
        $query = Query::table(static::$table, __CLASS__)
            ->select()
            ->orderBy('id', 'desc')
            ->all()
        ;

        return $query;
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
