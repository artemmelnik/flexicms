<?php
/**
 * This file is part of the FlexiCMS (https://flexicms.org)
 * Copyright (c) 2017 Artem Melnik (https://artemmelnik.com)
 */

declare(strict_types=1);

namespace Modules\Frontend\Classes;

use Modules\Backend\Model\ResourceType;
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
    public function id()
    {
        return (int) $this->resource->id;
    }

    /**
     * @return int
     */
    public function resourceTypeId()
    {
        return $this->resource->resource_type_id;
    }

    /**
     * @return string
     */
    public function title()
    {
        return $this->resource->title;
    }

    /**
     * @return string
     */
    public function content()
    {
        return $this->resource->content;
    }

    /**
     * @return string|null
     */
    public function thumbnail2()
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
     * @param null $size
     * @return string|null
     */
    public function thumbnail($size = null)
    {
        $fileModel = new Frontend\Model\File;

        $file = $fileModel->getFileById((int) $this->resource->thumbnail);

        if ($size !== null) {
            return $this->resize($size, $file);
        }

        if ($file !== null) {
            return $file->link;
        }

        return null;
    }

    private function resize($size, $file)
    {
        if ($file->link == '') {
            return null;
        }

        if ($size !== null) {
            $fileLinkParts = explode('/',  $file->link);
            $newName = $size . '-' . end($fileLinkParts);

            array_pop($fileLinkParts);
            array_push($fileLinkParts, $newName);

            $newImageLink = $_SERVER['DOCUMENT_ROOT'] . implode('/', $fileLinkParts);

            if (file_exists($newImageLink)) {
                return implode('/', $fileLinkParts);
            } else {
                $image = Image::make($_SERVER['DOCUMENT_ROOT'] . $file->link)->resize((int) $size, null, function ($constraint) {
                    $constraint->aspectRatio();
                });

                $image->save($newImageLink);

                return implode('/', $fileLinkParts);
            }
        }

        return null;
    }

    /**
     * @return string
     */
    public function segment()
    {
        return $this->resource->segment;
    }

    /**
     * @return string
     */
    public function type()
    {
        return $this->resource->type;
    }

    /**
     * @return string
     */
    public function status()
    {
        return $this->resource->status;
    }

    /**
     * @return string
     */
    public function date()
    {
        return $this->resource->date;
    }

    /**
     * @param string $name
     * @return string
     */
    public function field(string $name)
    {
        return Field::get($this->id(), $name);
    }

    public function relation($name)
    {
        $resourceModel     = new Frontend\Model\Resource();
        $resourceTypeModel = new ResourceType();

        $resourceType = $resourceTypeModel->getResourceTypeByName($name);
        $relations    = $resourceModel->getResourcesRelationByType($this->id(), (int) $resourceType->id);


        $relation = [];

        if (count($relations) == 0) {
            return null;
        }

        if (count($relations) == 1) {
            $relation = new Resource($relations[0]);
        } else {
            foreach ($relations as $item) {
                $relation[] = new Resource($item);
            }
        }

        return $relation;
    }

    public function categories()
    {
        $categoryModel = new Frontend\Model\Category();

        return $categoryModel->getCategoriesByResourceId($this->id());
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
