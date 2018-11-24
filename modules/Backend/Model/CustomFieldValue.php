<?php
namespace Modules\Backend\Model;

use Flexi;
use Flexi\Orm\Model;
use Query;

/**
 * Class CustomFieldValue
 * @package Modules\Backend\Model
 */
class CustomFieldValue extends Model
{
    /**
     * @var int
     */
    protected $id;

    /**
     * @var int
     */
    protected $fieldId;

    /**
     * @var int
     */
    protected $elementId;

    /**
     * @var string
     */
    protected $value;

    /**
     * @var string
     */
    protected static $table = 'custom_field_value';

    /**
     * @return array
     */
    public function columnMap(): array
    {
        return [
            'id' => 'id',
            'field_id' => 'fieldId',
            'element_id' => 'elementId',
            'value' => 'value'
        ];
    }

    /**
     * @return int
     */
    public function getId(): int
    {
        return (int) $this->id;
    }

    /**
     * @param int $id
     * @return CustomFieldValue
     */
    public function setId(int $id): CustomFieldValue
    {
        $this->id = $id;

        return $this;
    }

    /**
     * @return int
     */
    public function getFieldId(): int
    {
        return $this->fieldId;
    }

    /**
     * @param int $fieldId
     * @return CustomFieldValue
     */
    public function setFieldId(int $fieldId): CustomFieldValue
    {
        $this->fieldId = $fieldId;

        return $this;
    }

    /**
     * @return int
     */
    public function getElementId(): int
    {
        return $this->elementId;
    }

    /**
     * @param int $elementId
     * @return CustomFieldValue
     */
    public function setElementId(int $elementId): CustomFieldValue
    {
        $this->elementId = $elementId;

        return $this;
    }

    /**
     * @return string
     */
    public function getValue(): string
    {
        return $this->value;
    }

    /**
     * @param string $value
     * @return CustomFieldValue
     */
    public function setValue(string $value): CustomFieldValue
    {
        $this->value = $value;

        return $this;
    }

    public static function getByFieldId(int $fieldId, int $elementId)
    {
        return Query::table(static::$table)
            ->where('field_id', '=', $fieldId)
            ->where('element_id', '=', $elementId)
            ->first();
    }

    /**
     * @param array $params
     * @return int
     */
    public function addUpdateFieldValue(array $params)
    {
        $customFieldValue = new CustomFieldValue();

        $id = $this->getIdFieldValue($params['element_id'], $params['field_id']);

        if ($id) {
            $customFieldValue->setId($id);
        }

        $customFieldValue
            ->setFieldId($params['field_id'])
            ->setElementId($params['element_id'])
            ->setValue($params['value'])
            ->save();

        return $customFieldValue->getId();
    }

    public function getFieldValueByElementId($elementId)
    {
        return Query::table(static::$table)
            ->where('element_id', '=', $elementId)
            ->all();
    }

    public function clearValue($elementId, $fieldId)
    {
        Query::table(static::$table)
            ->update([
                'value' => ''
            ])
            ->where('field_id', '=', $fieldId)
            ->where('element_id', '=', $elementId)
            ->run('update');
    }

    /**
     * @param int $elementId
     * @param int $fieldId
     * @return int
     */
    public function getIdFieldValue(int $elementId, int $fieldId)
    {
        $sql = "
          SELECT id
          FROM " . static::$table . "
          WHERE field_id={$fieldId}
            AND element_id={$elementId}
        ";

        $query = Query::result($sql);

        return isset($query[0]) ? $query[0]->id : 0;
    }
}
