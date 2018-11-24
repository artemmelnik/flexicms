<?php

namespace Modules\Backend\Model;

use Flexi\Orm\Model;
use Query;

/**
 * Class Resource
 * @package Modules\Backend\Model
 */
class Resource extends Model
{
    public const STATUS_PUBLISH = 'publish';
    public const STATUS_DRAFT   = 'draft';

    /**
     * @var int
     */
    protected $id;

    /**
     * @var int
     */
    protected $resourceTypeId;

    /**
     * @var string
     */
    protected $title;

    /**
     * @var string
     */
    protected $content;

    /**
     * @var int
     */
    protected $thumbnail;

    /**
     * @var string
     */
    protected $segment;

    /**
     * @var string
     */
    protected $type;

    /**
     * @var string
     */
    protected $status;

    /**
     * @var \DateTime
     */
    protected $date;

    /**
     * @var string
     */
    protected static $table = 'resource';

    /**
     * @return array
     */
    public function columnMap(): array
    {
        return [
            'id'               => 'id',
            'resource_type_id' => 'resourceTypeId',
            'title'            => 'title',
            'content'          => 'content',
            'thumbnail'        => 'thumbnail',
            'segment'          => 'segment',
            'type'             => 'type',
            'status'           => 'status',
            'date'             => 'date'
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
     * @return $this
     */
    public function setId(int $id): Resource
    {
        $this->id = $id;

        return $this;
    }

    /**
     * @return int
     */
    public function getResourceTypeId(): int
    {
        return $this->resourceTypeId;
    }

    /**
     * @param int $resourceTypeId
     * @return $this
     */
    public function setResourceTypeId(int $resourceTypeId): Resource
    {
        $this->resourceTypeId = $resourceTypeId;

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
     * @return $this
     */
    public function setTitle(string $title): Resource
    {
        $this->title = $title;

        return $this;
    }

    /**
     * @return string
     */
    public function getContent(): string
    {
        return $this->content;
    }

    /**
     * @param string $content
     * @return $this
     */
    public function setContent(string $content): Resource
    {
        $this->content = $content;

        return $this;
    }

    /**
     * @return int
     */
    public function getThumbnail(): int
    {
        return $this->thumbnail;
    }

    /**
     * @param int $thumbnail
     * @return $this
     */
    public function setThumbnail(int $thumbnail): Resource
    {
        $this->thumbnail = $thumbnail;

        return $this;
    }

    /**
     * @return string
     */
    public function getSegment(): string
    {
        return $this->segment;
    }

    /**
     * @param string $segment
     * @return $this
     */
    public function setSegment(string $segment): Resource
    {
        $this->segment = $segment;

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
     * @return $this
     */
    public function setType(string $type): Resource
    {
        $this->type = $type;

        return $this;
    }

    /**
     * @return string
     */
    public function getStatus(): string
    {
        return $this->status;
    }

    /**
     * @param string $status
     * @return $this
     */
    public function setStatus(string $status): Resource
    {
        $this->status = $status;

        return $this;
    }

    /**
     * @return \DateTime
     */
    public function getDate(): \DateTime
    {
        return $this->date;
    }

    /**
     * @param \DateTime $date
     * @return $this
     */
    public function setDate(\DateTime $date): Resource
    {
        $this->date = $date;

        return $this;
    }

    /**
     * @param array $params
     * @return bool
     */
    public function addResource(array $params)
    {
        $resource = new Resource;
        $resource->setResourceTypeId($params['resource_type_id']);
        $resource->setTitle($params['title']);
        $resource->setContent($params['content']);
        $resource->setThumbnail($params['thumbnail']);
        $resource->setSegment($params['segment']);
        $resource->setType($params['type']);
        $resource->setStatus($params['status']);
        $resource->setDate($params['date']);

        return $resource->save();
    }

    /**
     * @param int $resourceId
     * @return array
     */
    public function getResources(int $resourceId)
    {
        $query = Query::table(static::$table)
            ->select()
            ->where('resource_type_id', '=', $resourceId)
            ->orderBy('id', 'desc')
            ->all();

        return $query;
    }

    /**
     * @param int $id
     * @return bool|Model
     */
    public function getResource(int $id)
    {
        return Query::table(static::$table)
            ->select()
            ->where('id', '=', $id)
            ->first();
    }

    public static function count($resourceTypeId)
    {
        $sql = "SELECT COUNT(id) as count FROM resource WHERE resource_type_id = {$resourceTypeId}";

        $result = Query::result($sql);

        return isset($result[0]) ? $result[0]->count : 0;
    }
}
