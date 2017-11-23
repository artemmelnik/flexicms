<?php
namespace Flexi\Cms\Admin\Controller;

use Flexi\Http\Input;
use Flexi\Http\Uri;
use Flexi\Cms\Admin\Model\Page as PageModel;
use \View;

/**
 * Class PageController
 * @package Flexi\Cms\Admin\Controller
 */
class PageController extends AdminController
{
    /**
     * @return \Flexi\Template\View
     */
    public function listing()
    {
        $pageModel = new PageModel();
        $pages     = $pageModel->getPages();

        return View::make('pages/list', [
            'pages' => $pages
        ]);
    }

    /**
     * @return \Flexi\Template\View
     */
    public function create()
    {
        return View::make('pages/create');
    }

    /**
     * @param int $id
     * @return \Flexi\Template\View
     */
    public function edit($id)
    {
        $pageModel = new PageModel();
        $page      = $pageModel->getPage($id);

        return View::make('pages/edit', [
            'baseUrl' => Uri::base(),
            'page' => $page
        ]);
    }

    public function add()
    {
        $params = Input::post();

        if (isset($params['title'])) {
            $page = new \Flexi\Cms\Admin\Model\Page;
            $page->setAttribute('title', $params['title']);
            $page->setAttribute('content', $params['content']);
            $page->setAttribute('segment', \Flexi\Helper\Text::transliteration($params['title']));
            $page->save();

            echo $page->getAttribute('id');
            exit;
        }
    }

    public function update()
    {
        $params = Input::post();

        if (isset($params['title'])) {
            $page = new \Flexi\Cms\Admin\Model\Page;
            $page->setAttribute('id', $params['page_id']);
            $page->setAttribute('title', $params['title']);
            $page->setAttribute('content', $params['content']);
            $page->setAttribute('status', $params['status']);
            $page->setAttribute('type', $params['type']);
            $page->save();

            echo $page->getAttribute('id');
            exit;
        }
    }
}
