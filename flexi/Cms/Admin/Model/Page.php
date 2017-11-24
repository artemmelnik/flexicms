<?php
namespace Flexi\Cms\Admin\Model;

use Flexi\Orm\Model;
use Query;

/**
 * Class Page
 * @package Flexi\Cms\Admin\Model
 */
class Page extends Model
{
    /**
     * @var string
     */
    protected static $table = 'page';

    /**
     * @return array
     */
    public function getPages()
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
     * @return bool|Model
     */
    public function getPage($id)
    {
        return Query::table(static::$table, __CLASS__)
            ->select()
            ->where('id', '=', $id)
            ->first()
        ;
    }
}
