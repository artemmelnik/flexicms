<?php
namespace Modules\Front\Classes;

use Modules\Front\Model\CustomField as CustomFieldModel;

/**
 * Class Field
 * @package Flexi\Cms\Front\Classes
 */
class Field
{
    public static function get($id, $name)
    {
        return CustomFieldModel::getFieldByName($id, $name);
    }
}
