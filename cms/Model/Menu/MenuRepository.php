<?php

namespace Cms\Model\Menu;

use Engine\Model;

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

    public function getList()
    {
        $query = $this->db->query(
            $this->queryBuilder
                ->select()
                ->from('menu')
                ->orderBy('id', 'DESC')
                ->sql()
        );

        return $query;
    }
}