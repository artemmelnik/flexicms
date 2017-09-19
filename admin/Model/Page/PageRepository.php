<?php

namespace Admin\Model\Page;

use Engine\Model;

class PageRepository extends Model
{
    public function getPages()
    {
        $sql = $this->queryBuilder->select()
            ->from('page')
            ->orderBy('id', 'DESC')
            ->sql();

        return $this->db->query($sql);
    }

    public function getPageData($id)
    {
        $page = new Page($id);

        return $page->findOne();
    }

    /**
     * @param $params
     * @return mixed
     */
    public function createPage($params)
    {
        $page = new Page;
        $page->setTitle($params['title']);
        $page->setContent($params['content']);
        $pageId = $page->save();

        return $pageId;
    }

    public function updatePage($params)
    {
        if (isset($params['page_id'])) {
            $page = new Page($params['page_id']);
            $page->setTitle($params['title']);
            $page->setContent($params['content']);
            $page->save();
        }
    }
}