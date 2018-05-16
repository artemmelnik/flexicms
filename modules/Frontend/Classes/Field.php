<?php
namespace Modules\Frontend\Classes;

use Modules\Frontend\Model\CustomField as CustomFieldModel;

/**
 * Class Field
 * @package Flexi\Cms\Frontend\Classes
 */
class Field
{
    public static function get($id, $name)
    {
        return CustomFieldModel::getFieldByName($id, $name);
    }

    public static function getField($id, $name)
    {
        return CustomFieldModel::getFieldBy($id, $name);
    }
}
