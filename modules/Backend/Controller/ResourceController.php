<?php

namespace Modules\Backend\Controller;

use Flexi;
use Modules\Backend\Model\Resource;
use View;
use Modules;
use Flexi\Http\Uri;
use Modules\Backend\Service\CustomField\CustomFieldService;
use Flexi\Localization\I18n;
use Modules\Backend\Model\Resource as ResourceModel;
use Modules\Backend\Model\ResourceType as ResourceTypeModel;
use Modules\Backend\Model\Category as CategoryModel;
use Modules\Backend\Model\ResourceToCategory as ResourceToCategoryModel;

/**
 * Class ResourceController
 * @package Modules\Backend\Controller
 */
class ResourceController extends BackendController
{
    /**
     * @var ResourceModel
     */
    protected $resourceModel;

    /**
     * @var ResourceTypeModel
     */
    protected $resourceTypeModel;

    /**
     * @var CategoryModel
     */
    protected $categoryModel;

    /**
     * @var ResourceToCategoryModel
     */
    protected $resourceToCategory;

    /**
     * ResourceController constructor.
     */
    public function __construct()
    {
        parent::__construct();

        $this->resourceModel = new ResourceModel();
        $this->resourceTypeModel = new ResourceTypeModel();
        $this->categoryModel = new CategoryModel();
        $this->resourceToCategory = new ResourceToCategoryModel();
    }

    /**
     * @param int $resourceId
     * @return Flexi\Template\View
     */
    public function listing(int $resourceId)
    {
        I18n::instance()->load('resources/list');


        $resources = $this->resourceModel->getResources($resourceId);
        $resourceType = $this->resourceTypeModel->getResourceType($resourceId);
        $categories = $this->categoryModel->getCategoriesByResourceType($resourceType->id, 'ru');

        $this->setData('resources', $resources);
        $this->setData('resource_type', $resourceType);
        $this->setData('categories', $categories);

        return View::make('resources/list', $this->data);
    }

    /**
     * @param string $name
     * @return Flexi\Template\View
     */
    public function create(string $name)
    {
        I18n::instance()->load('resources/create');

        $this->setData('resourceType', $this->resourceTypeModel->getResourceTypeByName($name));

        return View::make('resources/create', $this->data);
    }

    /**
     * @param string $name
     * @param int $id
     * @return Flexi\Template\View
     */
    public function edit(string $name, int $id)
    {
        I18n::instance()->load('resources/edit');

        $customFieldService = new CustomFieldService();
        $fileModel = new Modules\Backend\Model\File();

        $resource = $this->resourceModel->getResource($id);
        $customFields = $customFieldService->getResourceFields($resource);
        $inCategories = $this->resourceToCategory->getIdsCategoriesByResourceId($id);
        $resourceTypeRelations = $this->resourceTypeModel->getResourceTypeRelations((int) $resource->resource_type_id);
        $resourceRelations = Modules\Backend\Model\ResourceRelation::getRelationByResourceId($id);

        if (!empty($resourceTypeRelations)) {
            foreach ($resourceTypeRelations as $key => $resourceTypeRelation) {
                $resourceTypeRelations[$key]->resources = $this->resourceModel->getResources($resourceTypeRelation->id);
            }
        }

        $image = false;
        if ($resource->thumbnail) {
            $image = $fileModel->getFile($resource->thumbnail);
        }

        $this->setData('baseUrl', Uri::base());
        $this->setData('resource', $resource);
        $this->setData('resourceTypeRelations', $resourceTypeRelations);
        $this->setData('resourceRelations', $resourceRelations);
        $this->setData('pageTypes', getTypes($name));
        $this->setData('nameResource', $name);
        $this->setData('customFields', $customFields);
        $this->setData('image', $image);
        $this->setData('inCategories', $inCategories);
        $this->setData('categories', $this->categoryModel->getCategoriesByResourceType($resource->resource_type_id, 'ru'));

        return View::make('resources/edit', $this->data);
    }

    public function add()
    {
        $params = Flexi\Http\Input::post();

        if (isset($params['title'])) {
            $resource = new Modules\Backend\Model\Resource;
            $resource
                ->setResourceTypeId($params['resource_type_id'])
                ->setTitle($params['title'])
                ->setContent($params['content'])
                ->setSegment(Flexi\Helper\Text::transliteration($params['title']))
                ->setStatus(Modules\Backend\Model\Resource::STATUS_PUBLISH)
                ->save();

            $resourceType = $this->resourceTypeModel->getResourceType($params['resource_type_id']);

            echo '/backend/resource/' . $resourceType->name . '/edit/' . $resource->getId();
            exit;
        }
    }

    public function update()
    {
        $params = Flexi\Http\Input::post();
        $files = Flexi\Http\Input::files();

        $fileId = 0;
        if (!empty($files) && !isset($files['custom_fields_files'])) {
            $fileModel = new Modules\Backend\Model\File;

            $uploadFile = $files[0];
            $uploadsDir = path_content('uploads') . '/' . date('Y-m') . '/';
            $name       = 'image-' . time();

            if (!file_exists($uploadsDir)) {
                mkdir($uploadsDir);
            }

            $file = new Flexi\Helper\ImageUploader($uploadFile);
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

        $customFields = [];
        if (!empty($params['custom_fields'])) {
            parse_str($params['custom_fields'], $customFields);
        }

        if (isset($params['title'])) {
            $resource = new Modules\Backend\Model\Resource;
            $resource
                ->setId($params['resource_id'])
                ->setTitle($params['title'])
                ->setContent($params['content'])
                ->setStatus($params['status'])
                ->setType($params['type']);

            if ($fileId) {
                $resource->setThumbnail($fileId);
            }

            $resource->save();

            $customFieldValueModel = new Modules\Backend\Model\CustomFieldValue();

            if (isset($customFields['fields'])) {
                $customFieldValueModel = new Modules\Backend\Model\CustomFieldValue();
                foreach ($customFields['fields'] as $fieldId => $value) {
                    $customFieldValueModel->addUpdateFieldValue([
                        'field_id' => $fieldId,
                        'element_id' => $resource->getId(),
                        'value' => $value
                    ]);
                }
            }

            // Update files
            if (isset($files['custom_fields_files'])) {
                $json = [];
                $fieldFiles = $files['custom_fields_files'];
                $uploadsDir = path_content('uploads') . '/' . date('Y-m') . '/';

                $fileModel = new Modules\Backend\Model\File;

                if (!file_exists($uploadsDir)) {
                    mkdir($uploadsDir);
                }

                foreach ($fieldFiles['name'] as $key => $fieldFileName) {
                    $name = uniqid() . '-' . time();
                    $uploadFile = [
                        'name' => $fieldFileName,
                        'type' => $fieldFiles['type'][$key],
                        'tmp_name' => $fieldFiles['tmp_name'][$key],
                        'error' => $fieldFiles['error'][$key],
                        'size' => $fieldFiles['size'][$key]
                    ];

                    $file = new Flexi\Helper\ImageUploader($uploadFile);
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

                        $json[] = $fileId;
                    }
                }

                $fieldId = (int) $params['custom_fields_files'][$key]['id'];

                $currentFieldValue = Modules\Backend\Model\CustomFieldValue::getByFieldId($fieldId, $resource->getId());

                $currentValue = [];
                if (isset($currentFieldValue->value)) {
                    $currentValue = json_decode($currentFieldValue->value, true);
                }

                if (!empty($currentValue) && is_array($currentValue)) {
                    $json = array_merge($json, $currentValue);
                }

                $customFieldValueModel->addUpdateFieldValue([
                    'field_id' => $params['custom_fields_files'][$key]['id'],
                    'element_id' => $resource->getId(),
                    'value' => json_encode($json, true)
                ]);
            }

            if (isset($params['relations']) && !empty($params['relations'])) {
                foreach ($params['relations'] as $relationId => $relations) {
                    foreach ($relations as $resourceToId) {
                        Modules\Backend\Model\ResourceRelation::add([
                            'resource_id' => $params['resource_id'],
                            'resource_to_id' => $resourceToId,
                            'resource_type_id' => $relationId
                        ]);
                    }
                }
            }

            echo $resource->getId();
            exit;
        }
    }

    public function updateValueFile()
    {
        $params = Flexi\Http\Input::post();

        $fieldId = $params['fieldId'];
        $elementId = $params['elementId'];
        $fileId = $params['fileId'];

        $customFieldValueModel = new Modules\Backend\Model\CustomFieldValue();

        $currentFieldValue = Modules\Backend\Model\CustomFieldValue::getByFieldId($fieldId, $elementId);

        $currentValue = [];
        if (isset($currentFieldValue->value)) {
            $currentValue = json_decode($currentFieldValue->value, true);
        }

        if (!empty($currentValue) && is_array($currentValue)) {
            foreach ($currentValue as $key => $value) {
                if ($value == $fileId) {
                    unset($currentValue[$key]);
                }
            }
        }

        $currentValue = array_values($currentValue);

        $customFieldValueModel->addUpdateFieldValue([
            'field_id' => $fieldId,
            'element_id' => $elementId,
            'value' => json_encode($currentValue)
        ]);

        echo json_encode($currentValue);

        exit;
    }
}
