<?php

namespace Modules\Backend\Model;

use Flexi\Orm\Model;

/**
 * Class CategoryDescription
 * @package Modules\Backend\Model
 */
class CategoryDescription extends Model
{
    /**
     * @var string
     */
    protected static $table = 'category_description';

    /**
     * @param array $params
     * @return bool
     */
    public static function add(array $params)
    {
        $categoryDescription = new CategoryDescription();
        $categoryDescription->setAttribute('category_id', $params['category_id']);
        $categoryDescription->setAttribute('language', $params['language']);
        $categoryDescription->setAttribute('name', $params['name']);
        $categoryDescription->setAttribute('description', $params['description']);

        return $categoryDescription->save();
    }
}
