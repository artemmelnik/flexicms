<?php
namespace Flexi\Cms\Admin\Controller;

use Flexi\Http\Input;
use Flexi\Http\Uri;
use Flexi\Cms\Admin\Model\Post as PostModel;
use \View;

/**
 * Class PostController
 * @package Flexi\Cms\Admin\Controller
 */
class PostController extends AdminController
{
    /**
     * @return \Flexi\Template\View
     */
    public function listing()
    {
        $postModel = new PostModel();
        $posts     = $postModel->getPosts();

        return View::make('posts/list', [
            'posts' => $posts
        ]);
    }

    /**
     * @return \Flexi\Template\View
     */
    public function create()
    {
        return View::make('posts/create');
    }

    /**
     * @param int $id
     * @return \Flexi\Template\View
     */
    public function edit($id)
    {
        $postModel = new PostModel();
        $post      = $postModel->getPost($id);

        return View::make('posts/edit', [
            'baseUrl' => Uri::base(),
            'post'    => $post
        ]);
    }

    public function add()
    {
        $params = Input::post();

        if (isset($params['title'])) {
            $post = new \Flexi\Cms\Admin\Model\Post;
            $post->setAttribute('title', $params['title']);
            $post->setAttribute('content', $params['content']);
            $post->save();

            echo $post->getAttribute('id');
            exit;
        }
    }

    public function update()
    {
        $params = Input::post();

        if (isset($params['title'])) {
            $post = new \Flexi\Cms\Admin\Model\Post;
            $post->setAttribute('id', $params['post_id']);
            $post->setAttribute('title', $params['title']);
            $post->setAttribute('content', $params['content']);
            $post->save();

            echo $post->getAttribute('id');
            exit;
        }
    }
}
