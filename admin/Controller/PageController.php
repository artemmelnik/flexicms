<?php

namespace Admin\Controller;

class PageController extends AdminController
{
    public function listing()
    {
        $this->load->model('Page');

        $this->data['pages'] = $this->model->page->getPages();

        $this->view->render('pages/list', $this->data);
    }

    public function create()
    {
        $this->view->render('pages/create');
    }

    public function edit($id)
    {
        $this->load->model('Page');

        $this->data['page'] = $this->model->page->getPageData($id);

        $this->view->render('pages/edit', $this->data);
    }

    public function add()
    {
        $this->load->model('Page');

        $params = $this->request->post;

        if (isset($params['title'])) {
            $pageId = $this->model->page->createPage($params);
            echo $pageId;
        }
    }

    public function update()
    {
        $this->load->model('Page');

        $params = $this->request->post;

        if (isset($params['title'])) {
            $pageId = $this->model->page->updatePage($params);
            echo $pageId;
        }
    }
}