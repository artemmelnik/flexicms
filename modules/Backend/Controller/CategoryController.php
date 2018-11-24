<?php

namespace Modules\Backend\Controller;

use Flexi;
use Flexi\Localization\I18n;
use View;
use Modules;
use Modules\Backend\Model;

/**
 * Class CategoryController
 * @package Modules\Backend\Controller
 */
class CategoryController extends BackendController
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
        I18n::instance()->load('categories/create');

        $languageModel = new Model\Language();

        $this->setData('resourceTypeId', $resourceTypeId);
        $this->setData('languages', $languageModel->getLanguages());
        $this->setData('categories', $this->categoryModel->getCategoriesByResourceType($resourceTypeId, 'ru'));

        return View::make('categories/create', $this->data);
    }

    public function edit(int $resourceTypeId, int $categoryId)
    {
        $languageModel = new Model\Language();

        $languages  = $languageModel->getLanguages();
        $category   = $this->categoryModel->getCategoryById($categoryId);
        $categories = $this->categoryModel->getCategoriesByResourceType($resourceTypeId, 'ru');

        $this->setData('categoryId', $categoryId);
        $this->setData('resourceTypeId', $resourceTypeId);
        $this->setData('languages', $languages);
        $this->setData('category', $category);
        $this->setData('categories', $categories);

        return View::make('categories/edit', $this->data);
    }

    public function processCreateCategory()
    {
        $params = Flexi\Http\Input::post();

        $categoryId = $this->categoryModel->add($params);

        echo json_encode([
            'redirect_uri' => '/backend/resource/' . $params['resource_type_id'] . '/category/edit/' . $categoryId
        ]);

        exit;
    }

    public function processUpdateCategory()
    {
        $params = Flexi\Http\Input::post();

        $categoryId = $this->categoryModel->update($params);

        echo json_encode([
            'redirect_uri' => '/backend/resource/' . $params['resource_type_id'] . '/category/edit/' . $categoryId
        ]);

        exit;
    }
}
