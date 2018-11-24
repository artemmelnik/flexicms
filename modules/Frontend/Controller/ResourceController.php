<?php
/**
 * This file is part of the FlexiCMS (https://flexicms.org)
 * Copyright (c) 2017 Artem Melnik (https://artemmelnik.com)
 */

declare(strict_types=1);

namespace Modules\Frontend\Controller;

use Flexi\Http\Redirect;
use Flexi\Template\View;
use Modules\Backend;
use Modules\Frontend;

/**
 * Class ResourceController
 * @package Modules\Frontend\Controller
 */
class ResourceController extends FrontendController
{
    /**
     * @var Frontend\Model\Resource
     */
    protected $resourceModel;

    /**
     * @var Backend\Model\ResourceType
     */
    protected $resourceTypeModel;

    /**
     * ResourceController constructor.
     */
    public function __construct()
    {
        $this->resourceModel     = new Frontend\Model\Resource();
        $this->resourceTypeModel = new Backend\Model\ResourceType();

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

        /** @var Frontend\Model\Resource $resource */
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
        $this->setData($resourceType->name, new Frontend\Classes\Resource($resource));

        if ($resourceType->name == 'hotel') {
            $rooms = $this->resourceModel->getResourceRelation((int) $resource->id);

            $this->setData('rooms', $rooms);
        }

        return View::make($templateName, $this->data);
    }
}
