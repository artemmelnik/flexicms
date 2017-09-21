<?php

namespace Cms\Model\MenuItem;

use Engine\Model;

/**
 * Class MenuItemRepository
 * @package Cms\Model\MenuItem
 */
class MenuItemRepository extends Model
{
    const NEW_MENU_ITEM_NAME = 'New item';
    const FIELD_NAME = 'name';
    const FIELD_LINK = 'link';

    public function getAllItems()
    {
        $sql = $this->queryBuilder
            ->select()
            ->from('menu_item')
            ->orderBy('id', 'ASC')
            ->sql();

        return $this->db->query($sql);
    }

    /**
     * @param int $menuId
     * @param array $params
     * @return mixed
     */
    public function getItems($menuId, $params = [])
    {
        $sql = $this->queryBuilder
            ->select()
            ->from('menu_item')
            ->where('menu_id', $menuId)
            ->orderBy('position', 'ASC')
            ->sql();

        return $this->db->query($sql, $this->queryBuilder->values);
    }

    /**
     * @param array $params
     * @return int
     */
    public function add($params = [])
    {
        if (empty($params)) {
            return 0;
        }

        $menuItem = new MenuItem;
        $menuItem->setMenuId($params['menu_id']);
        $menuItem->setName(self::NEW_MENU_ITEM_NAME);
        $menuItemId = $menuItem->save();

        return $menuItemId;
    }

    /**
     * @param array $params
     * @return int
     */
    public function update($params = [])
    {
        if (empty($params)) {
            return 0;
        }

        $menuItem = new MenuItem($params['item_id']);

        if ($params['field'] == self::FIELD_NAME) {
            $menuItem->setName($params['value']);
        }

        if ($params['field'] == self::FIELD_LINK) {
            $menuItem->setLink($params['value']);
        }

        return $menuItem->save();
    }

    /**
     * @param int $itemId
     * @return mixed
     */
    public function remove($itemId)
    {
        $sql = $this->queryBuilder
            ->delete()
            ->from('menu_item')
            ->where('id', $itemId)
            ->sql();

        return $this->db->query($sql, $this->queryBuilder->values);
    }

    /**
     * @param array $params
     */
    public function sort($params = [])
    {
        $items = isset($params['data']) ? json_decode($params['data']) : [];

        if (!empty($items) and isset($items[0])) {
            foreach ($items[0] as $position => $item) {
                $this->db->execute(
                    $this->queryBuilder
                        ->update('menu_item')
                        ->set(['position' => $position])
                        ->where('id', $item->id)
                        ->sql(),
                    $this->queryBuilder->values
                );
            }
        }
    }
}
