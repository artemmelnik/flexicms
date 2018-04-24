<?php
namespace Modules\Backend\Model;

use Flexi\Orm\Model;
use Query;

/**
 * Class MenuItem
 * @package Modules\Backend\Model
 */
class MenuItem extends Model
{
    const NEW_MENU_ITEM_NAME = 'New item';
    const FIELD_NAME = 'name';
    const FIELD_LINK = 'link';

    /**
     * @var string
     */
    protected static $table = 'menu_item';

    /**
     * @param int $menuId
     * @param array $params
     * @return array
     */
    public function getItems(int $menuId, array $params = []): array
    {
        $query = Query::table(static::$table, __CLASS__)
            ->select()
            ->where('menu_id', '=', $menuId)
            ->orderBy('position')
            ->all()
        ;

        return $query;
    }

    /**
     * @param array $params
     */
    public function sort(array $params = [])
    {
        $items = isset($params['data']) ? json_decode($params['data']) : [];

        if (!empty($items) and isset($items[0])) {
            foreach ($items[0] as $position => $item) {
                Query::table(static::$table, __CLASS__)
                    ->update([
                        'position' => $position
                    ])
                    ->where('id', '=', $item->id)
                    ->run('update')
                ;
            }
        }
    }

    /**
     * @param int $itemId
     */
    public function remove(int $itemId)
    {
        Query::table(static::$table, __CLASS__)
            ->where('id', '=', $itemId)
            ->run('delete')
        ;
    }
}
