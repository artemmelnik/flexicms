<?php
/**
 * This file is part of the FlexiCMS (https://flexicms.org)
 * Copyright (c) 2017 Artem Melnik (https://artemmelnik.com)
 */

declare(strict_types=1);

namespace Modules\Frontend\Controller;

use Flexi\Http\Redirect;
use Flexi\Template\View;
use Modules\Backend\Model\ResourceType;
use Modules\Frontend\Classes\Resources;
use Modules\Frontend\Model;

/**
 * Class ResourceController
 * @package Modules\Frontend\Controller
 */
class ResourceController extends FrontendController
{
    /**
     * @var Model\Resource
     */
    protected $resourceModel;

    /**
     * @var ResourceType
     */
    protected $resourceTypeModel;

    /**
     * ResourceController constructor.
     */
    public function __construct()
    {
        $this->resourceModel = new Model\Resource();
        $this->resourceTypeModel = new ResourceType();

        parent::__construct();
    }

    /**
     * @param $segment
     * @return View
     */
    public function show($segment)
    {
        if ($segment == '') {
            $segment = '/';
        }

        /** @var Model\Resource $resource */
        $resource = $this->resourceModel->getResourceBySegment($segment);

        if (empty($resource)) {
            exit('404 Страница не найдена');
        }

        if ($resource->status !== 'publish') {
            Redirect::go('/');
        }

        $resourceType = $this->resourceTypeModel->getResourceType((int)$resource->resource_type_id);
        $templateName = $resourceType->name;

        if ($resource->type !== 'basic') {
            $templateName .= '.' . $resource->type;
        }

        $this->setData('type', $resourceType);
        $this->setData($resourceType->name, new \Modules\Frontend\Classes\Resource($resource));

        if ($resourceType->name == 'hotel') {
            $rooms = $this->resourceModel->getResourceRelation((int) $resource->id);

            $this->setData('rooms', $rooms);
        }

        return View::make($templateName, $this->data);
    }
}
