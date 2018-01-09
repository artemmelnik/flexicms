<?php
namespace Flexi\Cms\Admin\Model;

use Flexi;
use Flexi\CustomField\Params;
use Flexi\Orm\Model;
use Query;

/**
 * Class CustomField
 * @package Flexi\Cms\Admin\Model
 */
class CustomField extends Model
{
    /**
     * @var string
     */
    protected static $table = 'custom_field';

    /**
     * @param int $groupId
     * @return array
     */
    public function getListFieldsByGroupId(int $groupId): array
    {
        return Query::table(static::$table)
            ->select()
            ->where('group_id', '=', $groupId)
            ->all()
        ;
    }

    /**
     * @param int $elementId
     * @param array $groupIds
     * @return array
     */
    public function getListFieldsByGroupIds(int $elementId, array $groupIds): array
    {
        $sql = "
            SELECT
              cf.*,
              (
                SELECT
                  value
                FROM
                  " . CustomFieldValue::getTable() . "
                  WHERE element_id = {$elementId}
                   AND field_id = cf.id
              ) as value
            FROM
              " . static::$table . " as cf
            WHERE cf.group_id IN(" . implode(',', $groupIds) . ")
        ";

        return Query::result($sql);
    }

    /**
     * @param Params\CustomFieldParams $params
     * @return int
     */
    public function addField(Params\CustomFieldParams $params)
    {
        $customField = new CustomField();
        $customField->setAttribute('group_id', $params->getGroupId());
        $customField->setAttribute('name', $params->getName());
        $customField->setAttribute('label', $params->getLabel());
        $customField->setAttribute('description', $params->getDescription());
        $customField->setAttribute('type', $params->getType());
        $customField->setAttribute('required', $params->getRequired());
        $customField->setAttribute('status', $params->getStatus());
        $customField->save();

        return $customField->getAttribute('id');
    }

    /**
     * @param int $id
     * @param Params\CustomFieldParams $params
     * @return int
     */
    public function updateField(int $id, Params\CustomFieldParams $params)
    {
        $customField = new CustomField();
        $customField->setAttribute('id', $id);
        $customField->setAttribute('group_id', $params->getGroupId());
        $customField->setAttribute('name', $params->getName());
        $customField->setAttribute('label', $params->getLabel());
        $customField->setAttribute('description', $params->getDescription());
        $customField->setAttribute('type', $params->getType());
        $customField->setAttribute('required', $params->getRequired());
        $customField->setAttribute('status', $params->getStatus());
        $customField->save();

        return $customField->getAttribute('id');
    }
}
