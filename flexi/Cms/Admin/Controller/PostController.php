<?php
namespace Flexi\Cms\Admin\Controller;

use Flexi;
use Flexi\Helper\ImageUploader;
use Flexi\Http\Input;
use Flexi\Http\Uri;
use Flexi\Cms\Admin\Model\Post as PostModel;
use Flexi\Localization\I18n;
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
        I18n::instance()->load('posts/list');

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
        I18n::instance()->load('posts/create');

        return View::make('posts/create');
    }

    /**
     * @param int $id
     * @return \Flexi\Template\View
     */
    public function edit($id)
    {
        I18n::instance()->load('posts/edit');

        $postModel = new PostModel();
        $fileModel = new Flexi\Cms\Admin\Model\File();

        $post = $postModel->getPost($id);

        $image = false;
        if ($post->getAttribute('thumbnail')) {
            $image = $fileModel->getFile($post->getAttribute('thumbnail'));
        }

        return View::make('posts/edit', [
            'baseUrl'   => Uri::base(),
            'post'      => $post,
            'pageTypes' => getTypes('post'),
            'image'     => $image
        ]);
    }

    public function add()
    {
        $params = Input::post();

        if (isset($params['title'])) {
            $post = new Flexi\Cms\Admin\Model\Post;
            $post->setAttribute('title', $params['title']);
            $post->setAttribute('content', $params['content']);
            $post->setAttribute('segment', Flexi\Helper\Text::transliteration($params['title']));
            $post->save();

            echo $post->getAttribute('id');
            exit;
        }
    }

    public function update()
    {
        $params = Input::post();
        $files = Input::files();

        $fileId = 0;
        if (!empty($files)) {
            $fileModel = new Flexi\Cms\Admin\Model\File;

            $uploadFile = $files[0];
            $uploadsDir = path_content('uploads') . '/' . date('Y-m') . '/';
            $name       = 'image-' . time();

            if (!file_exists($uploadsDir)) {
                mkdir($uploadsDir);
            }

            $file = new ImageUploader($uploadFile);
            $file->sendTo = $uploadsDir;
            $file->imageName = $name;

            $upload = $file->uploadImage();

            if ($upload->isUploaded) {
                $params['image'] = $upload->uploadedName;

                $fileId = $fileModel->addFile([
                    'name' => $upload->uploadedName,
                    'link' => '/content/uploads/' . date('Y-m') . '/' . $upload->uploadedName,
                    'type' => $uploadFile['type']
                ]);
            }
        }

        if (isset($params['title'])) {
            $post = new Flexi\Cms\Admin\Model\Post;
            $post->setAttribute('id', $params['post_id']);
            $post->setAttribute('title', $params['title']);
            $post->setAttribute('content', $params['content']);

            if ($fileId) {
                $post->setAttribute('thumbnail', $fileId);
            }

            $post->setAttribute('status', $params['status']);
            $post->setAttribute('type', $params['type']);
            $post->save();

            echo $post->getAttribute('id');
            exit;
        }
    }
}
