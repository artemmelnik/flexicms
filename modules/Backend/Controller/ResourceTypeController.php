<?php
/**
 * This file is part of the FlexiCMS (https://flexicms.org)
 * Copyright (c) 2017 Artem Melnik (https://artemmelnik.com)
 */

declare(strict_types=1);

namespace Modules\Backend\Controller;

use Flexi;
use Modules\Backend\Model\ResourceType;
use Modules\Backend\Model\ResourceTypeRelation;

/**
 * Class ResourceTypeController
 * @package Modules\Backend\Controller
 */
class ResourceTypeController extends BackendController
{
    /**
     * @var ResourceType
     */
    protected $resourceTypeModel;

    /**
     * ResourceTypeController constructor.
     */
    public function __construct()
    {
        parent::__construct();

        $this->resourceTypeModel = new ResourceType();
    }

    /**
     * @param string $nameResource
     * @return Flexi\Template\View
     */
    public function settings(string $nameResource)
    {
        $resourceType = $this->resourceTypeModel->getResourceTypeByName($nameResource);
        $resourceTypes = $this->resourceTypeModel->getResourcesType();
        $resourceTypeRelations = $this->resourceTypeModel->getResourceTypeRelations((int) $resourceType->id);

        $this->setData('resourceType', $resourceType);
        $this->setData('resourceTypes', $resourceTypes);
        $this->setData('resourceTypeRelations', $resourceTypeRelations);

        return \View::make('resource_types/settings', $this->data);
    }

    public function processAddRelation()
    {
        $params = Flexi\Http\Input::post();

        if (empty($params)) exit;

        if (ResourceTypeRelation::add($params)) {
            echo 'done';
        } else {
            echo 'has';
        }

        exit;
    }
}
