<?php
namespace Modules\Frontend\Model;

use Flexi;
use Flexi\CustomField\Params;
use Flexi\Orm\Model;
use Query;

/**
 * Class CustomField
 * @package Modules\Frontend\Model
 */
class CustomField extends Model
{
    /**
     * @var string
     */
    protected static $table = 'custom_field';

    public function getFieldValue()
    {
    }

    public static function getFieldByName(int $elementId, string $name)
    {
        $sql = "
            SELECT
              cf.name,
              cfv.value
            FROM custom_field as cf
            JOIN custom_field_value as cfv
              ON cf.id=cfv.field_id
            WHERE cf.name = '{$name}'
              AND cfv.element_id = {$elementId};
        ";

        $result = Query::result($sql);

        return isset($result[0]) ? $result[0]->value : '';
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
}
