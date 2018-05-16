<?php
/**
 * This file is part of the FlexiCMS (https://flexicms.org)
 * Copyright (c) 2017 Artem Melnik (https://artemmelnik.com)
 */

declare(strict_types=1);

namespace Modules\Frontend\Classes;

use Modules\Frontend;
use Intervention\Image\ImageManagerStatic as Image;
use Twig_Compiler;

/**
 * Class Resource
 * @package Modules\Frontend\Classes
 */
class Resource
{
    /**
     * @var object
     */
    protected $resource;

    /**
     * Resource constructor.
     * @param object $resource
     */
    public function __construct($resource)
    {
        $this->resource = $resource;
    }

    /**
     * @return int
     */
    public function getId()
    {
        return (int) $this->resource->id;
    }

    /**
     * @return int
     */
    public function getResourceTypeId()
    {
        return $this->resource->resource_type_id;
    }

    /**
     * @return string
     */
    public function getTitle()
    {
        return $this->resource->title;
    }

    /**
     * @return string
     */
    public function getContent()
    {
        return $this->resource->content;
    }

    /**
     * @return string|null
     */
    public function getThumbnail()
    {
        $fileModel = new Frontend\Model\File;

        $file = $fileModel->getFileById((int) $this->resource->thumbnail);

        /*$image = Image::make($_SERVER['DOCUMENT_ROOT'] . $file->link)->resize(300, 200);

        print_r($image);*/

        if ($file !== null) {
            return $file->link;
        }

        return null;
    }

    /**
     * @return string
     */
    public function getSegment()
    {
        return $this->resource->segment;
    }

    /**
     * @return string
     */
    public function getType()
    {
        return $this->resource->type;
    }

    /**
     * @return string
     */
    public function getStatus()
    {
        return $this->resource->status;
    }

    /**
     * @return string
     */
    public function getDate()
    {
        return $this->resource->date;
    }

    /**
     * @param string $name
     * @return string
     */
    public function getField(string $name)
    {
        return Field::get($this->getId(), $name);
    }

    public function getCategories()
    {
        $categoryModel = new Frontend\Model\Category();

        return $categoryModel->getCategoriesByResourceId($this->getId());
    }

    /**
     * @param $key
     * @return mixed
     */
    public function __get($key)
    {
        return $this->resource->$key;
    }
}
