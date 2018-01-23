<?php
namespace Modules\Front\Model;

use Flexi\Orm\Model;
use Flexi\Orm\Query;

/**
 * Class MenuItem
 * @package Modules\Front\Model
 */
class MenuItem extends Model
{
    /**
     * @var string
     */
    protected static $table = 'menu_item';

    /**
     * @param int   $menuId
     * @param array $params
     * @return array
     */
    public function getItemsByMenuId(int $menuId, array $params = [])
    {
        $query = Query::table(static::$table)
            ->select()
            ->where('menu_id', '=', $menuId)
            ->orderBy('position', 'asc')
            ->all()
        ;

        return $query;
    }
}
