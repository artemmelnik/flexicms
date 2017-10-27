<?php
namespace Cms\Controller;

use Admin\Model\Page\PageRepository;
use Cms\Classes\Page;

class_alias('Cms\\Classes\\Page', 'Page');

/**
 * Class PageController
 * @package Cms\Controller
 */
class PageController extends CmsController
{
    const TEMPLATE_PAGE_MASK = 'page-%s';

    /**
     * @param string|int $segment
     */
    public function show($segment)
    {
        $this->load->model('Page', false, 'Admin');

        /** @var PageRepository $pageModel */
        $pageModel = $this->model->page;

        $page = $pageModel->getPageBySegment($segment);

        if ($page === false) {
            header('Location: /');
            exit;
        }

        $template = 'page';
        if ($page->type !== 'page') {
            $template = sprintf(self::TEMPLATE_PAGE_MASK, $page->type);
        }

        Page::setStore($page);

        $this->view->render($template);
    }
}
