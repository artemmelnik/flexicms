<?php
namespace Modules\Backend\Model;

use Flexi\Orm\Model;
use Query;

/**
 * Class Menu
 * @package Modules\Backend\Model
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
        $query = Query::table(static::$table)
            ->select()
            ->orderBy('id', 'desc')
            ->all()
        ;

        return $query;
    }
}
