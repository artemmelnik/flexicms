<?php

namespace Admin\Controller;

class PostController extends AdminController
{
    public function listing()
    {
        $this->load->model('Post');

        $this->data['posts'] = $this->model->post->getPosts();

        $this->view->render('posts/list', $this->data);
    }

    public function create()
    {
        $this->view->render('posts/create');
    }

    public function edit($id)
    {
        $this->load->model('Post');

        $this->data['post'] = $this->model->post->getPostData($id);

        $this->view->render('posts/edit', $this->data);
    }

    public function add()
    {
        $this->load->model('Post');

        $params = $this->request->post;

        if (isset($params['title'])) {
            $postId = $this->model->post->createPost($params);
            echo $postId;
        }
    }

    public function update()
    {
        $this->load->model('Post');

        $params = $this->request->post;

        if (isset($params['title'])) {
            $postId = $this->model->post->updatePost($params);
            echo $postId;
        }
    }
}