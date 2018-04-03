<?php

namespace Modules\Admin\Controller;

use Flexi;
use View;
use Modules;
use Modules\Admin\Model;

/**
 * Class CategoryController
 * @package Modules\Admin\Controller
 */
class CategoryController extends AdminController
{
    /**
     * @var Model\Category
     */
    protected $categoryModel;

    public function __construct()
    {
        parent::__construct();

        $this->categoryModel = new Model\Category();
    }

    /**
     * @param int $resourceTypeId
     * @return Flexi\Template\View
     */
    public function create(int $resourceTypeId)
    {
        $languageModel = new Model\Language();

        $this->setData('resourceTypeId', $resourceTypeId);
        $this->setData('languages', $languageModel->getLanguages());
        $this->setData('categories', $this->categoryModel->getCategoriesByResourceType($resourceTypeId, 'ru'));

        return View::make('categories/create', $this->data);
    }

    public function edit(int $resourceTypeId, int $categoryId)
    {
        $languageModel = new Model\Language();

        $this->setData('languages', $languageModel->getLanguages());
        $this->setData('category', $this->categoryModel->getCategoryById($categoryId));
        $this->setData('categories', $this->categoryModel->getCategoriesByResourceType($resourceTypeId, 'ru'));

        return View::make('categories/edit', $this->data);
    }

    public function processCreateCategory()
    {
        $params = Flexi\Http\Input::post();

        $categoryId = $this->categoryModel->add($params);

        echo json_encode([
            'redirect_uri' => '/admin/resource/' . $params['resource_type_id'] . '/category/edit/' . $categoryId
        ]);

        exit;
    }
}
