<?php
namespace Modules\Admin\Model;

use Flexi\Orm\Model;
use Query;

/**
 * Class Menu
 * @package Modules\Admin\Model
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
