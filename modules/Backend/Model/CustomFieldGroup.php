<?php
namespace Modules\Backend\Model;

use Flexi;
use Modules;
use Flexi\Orm\Model;
use Query;

/**
 * Class CustomFieldGroup
 * @package Modules\Backend\Model
 */
class CustomFieldGroup extends Model
{
    const ACTIVE_STATUS = 1;
    const INACTIVE_STATUS = 0;

    /**
     * @var int
     */
    protected $id;

    /**
     * @var string
     */
    protected $title;

    /**
     * @var string
     */
    protected $type;

    /**
     * @var string
     */
    protected $template;

    /**
     * @var int
     */
    protected $status;

    /**
     * @var string
     */
    protected static $table = 'custom_field_group';

    /**
     * @return array
     */
    public function columnMap(): array
    {
        return [
            'id'       => 'id',
            'title'    => 'title',
            'type'     => 'type',
            'template' => 'template',
            'status'   => 'status'
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
     * @return CustomFieldGroup
     */
    public function setId(int $id): CustomFieldGroup
    {
        $this->id = $id;

        return $this;
    }

    /**
     * @return string
     */
    public function getTitle(): string
    {
        return $this->title;
    }

    /**
     * @param string $title
     * @return CustomFieldGroup
     */
    public function setTitle(string $title): CustomFieldGroup
    {
        $this->title = $title;

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
     * @return CustomFieldGroup
     */
    public function setType(string $type): CustomFieldGroup
    {
        $this->type = $type;

        return $this;
    }

    /**
     * @return string
     */
    public function getTemplate(): string
    {
        return $this->template;
    }

    /**
     * @param string $template
     * @return CustomFieldGroup
     */
    public function setTemplate(string $template): CustomFieldGroup
    {
        $this->template = $template;

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
     * @return CustomFieldGroup
     */
    public function setStatus(int $status): CustomFieldGroup
    {
        $this->status = $status;

        return $this;
    }

    /**
     * @param array $params
     * @return int
     */
    public function addGroup(array $params)
    {
        if (empty($params)) {
            return 0;
        }

        $customFieldGroup = new CustomFieldGroup();
        $customFieldGroup
            ->setTitle($params['title'])
            ->setType($params['type'])
            ->setTemplate($params['template'])
            ->setStatus(static::ACTIVE_STATUS)
            ->save();

        return $customFieldGroup->getId();
    }

    /**
     * @param int $id
     * @return bool|Model
     */
    public function getGroupById(int $id)
    {
        return Query::table(static::$table)
            ->select()
            ->where('id', '=', $id)
            ->first()
        ;
    }

    public function getFieldGroupByResource($resource)
    {
        $resourceTypeModel = new Modules\Backend\Model\ResourceType();

        $resourceType = $resourceTypeModel->getResourceType($resource->resource_type_id);

        $template = $resource->type;
        $type = $resourceType->name;

        $sql = "
            SELECT
              id,
              title,
              type
            FROM
              " . static::$table . "
            WHERE type = '" . $type . "'
            AND (template = 'all' OR template = '" . $template . "')
        ";

        return Query::result($sql);
    }

    /**
     * @return array
     */
    public function getListGroup()
    {
        $sql = '
            SELECT
                cfg.*,
                (
                  SELECT 
                    COUNT(id) as count
                  FROM ' . CustomField::getTable() . '
                  WHERE group_id = cfg.id
                ) as count_fields
            FROM ' . static::$table . ' as cfg
            ORDER BY cfg.id DESC
        ';

        return Query::result($sql);
    }
}
