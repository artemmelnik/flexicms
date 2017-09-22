<?php

namespace Cms\Model\Menu;

use Engine\Model;

/**
 * Class MenuRepository
 * @package Cms\Model\Menu
 */
class MenuRepository extends Model
{
    /**
     * @param array $params
     * @return int
     */
    public function add($params = [])
    {
        if (empty($params)) {
            return 0;
        }

        $menu = new Menu;
        $menu->setName($params['name']);
        $menuId = $menu->save();

        return $menuId;
    }

    /**
     * @return mixed
     */
    public function getList()
    {
        $query = $this->db->query(
            $this->queryBuilder
                ->select()
                ->from('menu')
                ->sql()
        );

        return $query;
    }
}
