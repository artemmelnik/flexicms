<?php
namespace Flexi\Cms\Front\Controller;

use Flexi\Template\View;
use Flexi\Cms\Front\Model;

/**
 * Class PageController
 * @package Flexi\Cms\Front\Controller
 */
class PageController extends FrontController
{
    const DEFAULT_TEMPLATE = 'page';
    const MASK_TEMPLATE = 'page.%s';

    public function __construct()
    {
        $this->setLayout('page');
    }

    public function show($segment)
    {
        $pageModel = new Model\Page();
        $page = $pageModel->getPageBySegment($segment);

        return View::make($this->pageTemplate($page->getAttribute('type')), [
            'data' => $page
        ]);
    }

    /**
     * @param string $type
     * @return string
     */
    private function pageTemplate(string $type)
    {
        $template = self::DEFAULT_TEMPLATE;

        if ($type !== self::DEFAULT_TEMPLATE) {
            $template = sprintf(self::MASK_TEMPLATE, $type);
        }

        return $template;
    }
}
