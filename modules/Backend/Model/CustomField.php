<?php
namespace Modules\Backend\Model;

use Flexi;
use Flexi\CustomField\Params;
use Flexi\Orm\Model;
use Query;

/**
 * Class CustomField
 * @package Modules\Backend\Model
 */
class CustomField extends Model
{
    /**
     * @var int
     */
    protected $id;

    /**
     * @var int
     */
    protected $groupId;

    /**
     * @var string
     */
    protected $name;

    /**
     * @var string
     */
    protected $label;

    /**
     * @var string
     */
    protected $description;

    /**
     * @var string
     */
    protected $type;

    /**
     * @var int
     */
    protected $required;

    /**
     * @var string
     */
    protected $extraData;

    /**
     * @var int
     */
    protected $status;

    /**
     * @var string
     */
    protected static $table = 'custom_field';

    /**
     * @return array
     */
    public function columnMap(): array
    {
        return [
            'id'          => 'id',
            'group_id'    => 'groupId',
            'name'        => 'name',
            'label'       => 'label',
            'description' => 'description',
            'type'        => 'type',
            'required'    => 'required',
            'extra_data'  => 'extraData',
            'status'      => 'status'
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
     * @return CustomField
     */
    public function setId(int $id): CustomField
    {
        $this->id = $id;

        return $this;
    }

    /**
     * @return int
     */
    public function getGroupId(): int
    {
        return $this->groupId;
    }

    /**
     * @param int $groupId
     * @return CustomField
     */
    public function setGroupId(int $groupId): CustomField
    {
        $this->groupId = $groupId;

        return $this;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @param string $name
     * @return CustomField
     */
    public function setName(string $name): CustomField
    {
        $this->name = $name;

        return $this;
    }

    /**
     * @return string
     */
    public function getLabel(): string
    {
        return $this->label;
    }

    /**
     * @param string $label
     * @return CustomField
     */
    public function setLabel(string $label): CustomField
    {
        $this->label = $label;

        return $this;
    }

    /**
     * @return string
     */
    public function getDescription(): string
    {
        return $this->description;
    }

    /**
     * @param string $description
     * @return CustomField
     */
    public function setDescription(string $description): CustomField
    {
        $this->description = $description;

        return $this;
    }

    /**
     * @return string
     */
    public function getType(): string
    {
        return $this->type;
    }

    /**
     * @param string $type
     * @return CustomField
     */
    public function setType(string $type): CustomField
    {
        $this->type = $type;

        return $this;
    }

    /**
     * @return int
     */
    public function getRequired(): int
    {
        return $this->required;
    }

    /**
     * @param int $required
     * @return CustomField
     */
    public function setRequired(int $required): CustomField
    {
        $this->required = $required;

        return $this;
    }

    /**
     * @return string
     */
    public function getExtraData(): string
    {
        return $this->extraData;
    }

    /**
     * @param string $extraData
     * @return CustomField
     */
    public function setExtraData(string $extraData): CustomField
    {
        $this->extraData = $extraData;

        return $this;
    }

    /**
     * @return int
     */
    public function getStatus(): int
    {
        return $this->status;
    }

    /**
     * @param int $status
     * @return CustomField
     */
    public function setStatus(int $status): CustomField
    {
        $this->status = $status;

        return $this;
    }

    /**
     * @param int $groupId
     * @return array
     */
    public function getListFieldsByGroupId(int $groupId): array
    {
        return Query::table(static::$table)
            ->select()
            ->where('group_id', '=', $groupId)
            ->all();
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
        $customField
            ->setGroupId($params->getGroupId())
            ->setName($params->getName())
            ->setLabel($params->getLabel())
            ->setDescription($params->getDescription())
            ->setType($params->getType())
            ->setRequired($params->getRequired())
            ->setExtraData($params->getExtraData())
            ->setStatus($params->getStatus())
            ->save();

        return $customField->getId();
    }

    /**
     * @param int $id
     * @param Params\CustomFieldParams $params
     * @return int
     */
    public function updateField(int $id, Params\CustomFieldParams $params)
    {
        $customField = new CustomField();
        $customField
            ->setId($id)
            ->setGroupId($params->getGroupId())
            ->setName($params->getName())
            ->setLabel($params->getLabel())
            ->setDescription($params->getDescription())
            ->setType($params->getType())
            ->setRequired($params->getRequired())
            ->setExtraData($params->getExtraData())
            ->setStatus($params->getStatus())
            ->save();

        return $customField->getId();
    }
}
