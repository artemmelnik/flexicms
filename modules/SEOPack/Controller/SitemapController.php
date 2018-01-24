<?php
namespace Modules\SEOPack\Controller;

use Flexi\Config\Config;
use Flexi\Sitemap\Sitemap;
use Modules\Admin\Model\Page as PageModel;

/**
 * Class SitemapController
 * @package Modules\SEOPack\Controller
 */
class SitemapController extends \Controller
{
    /**
     * @return \Flexi\Template\View
     */
    public function show()
    {
        $pageModel = new PageModel();

        $pages = $pageModel->getPages();

        $sitemap = new Sitemap;
        $sitemap->addItem('https://antiotel.ru/');

        /**
         * @var PageModel $page
         */
        foreach ($pages as $page) {
            $sitemap->addItem(Config::item('baseUrl') . '/page/' . $page->getAttribute('segment'));
        }

        header('Content-Type: application/xml');

        echo $sitemap;

        exit;
    }
}
