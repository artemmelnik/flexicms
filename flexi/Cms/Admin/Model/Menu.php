<?php
namespace Flexi\Cms\Admin\Model;

use Flexi\Orm\Model;
use Query;

/**
 * Class Menu
 * @package Flexi\Cms\Admin\Model
 */
class Menu extends Model
{
    /**
     * @var string
     */
    protected static $table = 'menu';

    /**
     * @return array
     */
    public function getList()
    {
        $query = Query::table(static::$table, __CLASS__)
            ->select()
            ->orderBy('id', 'desc')
            ->all()
        ;

        return $query;
    }
}
