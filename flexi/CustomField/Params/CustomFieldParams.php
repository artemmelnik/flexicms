<?php
namespace Flexi\CustomField\Params;

/**
 * Class CustomFieldParams
 * @package Flexi\CustomField\Params
 */
class CustomFieldParams
{
    /**
     * @var int
     */
    protected $id;

    /**
     * @var int|null
     */
    protected $groupId;

    /**
     * @var string|null
     */
    protected $name;

    /**
     * @var string|null
     */
    protected $label;

    /**
     * @var string|null
     */
    protected $description;

    /**
     * @var string|null
     */
    protected $type;

    /**
     * @var int|null
     */
    protected $required;

    /**
     * @var int|null
     */
    protected $status;

    /**
     * CustomFieldParams constructor.
     * @param array $params
     */
    public function __construct(array $params)
    {
        $this->id = isset($params['id']) ? $params['id'] : null;
        $this->groupId = isset($params['group_id']) ? $params['group_id'] : null;
        $this->name = isset($params['name']) ? $params['name'] : null;
        $this->label = isset($params['label']) ? $params['label'] : null;
        $this->description = isset($params['description']) ? $params['description'] : null;
        $this->type = isset($params['type']) ? $params['type'] : null;
        $this->required = isset($params['required']) ? $params['required'] : null;
        $this->status = isset($params['status']) ? $params['status'] : null;
    }

    /**
     * @return mixed|null
     */
    public function getGroupId()
    {
        return $this->groupId;
    }

    /**
     * @return mixed|null
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @return mixed|null
     */
    public function getLabel()
    {
        return $this->label;
    }

    /**
     * @return mixed|null
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * @return mixed|null
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * @return mixed|null
     */
    public function getRequired()
    {
        return $this->required;
    }

    /**
     * @return mixed|null
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }
}
