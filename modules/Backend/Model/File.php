<?php
namespace Modules\Backend\Model;

use Flexi\Orm\Model;
use Query;

/**
 * Class File
 * @package Modules\Backend\Model
 */
class File extends Model
{
    /**
     * @var int
     */
    protected $id;

    /**
     * @var string
     */
    protected $name;

    /**
     * @var string
     */
    protected $link;

    /**
     * @var string
     */
    protected $type;

    /**
     * @var string
     */
    protected static $table = 'file';

    /**
     * @return array
     */
    public function columnMap(): array
    {
        return [
            'id' => 'id',
            'name' => 'name',
            'link' => 'link',
            'type' => 'type'
        ];
    }

    /**
     * @param int $id
     * @return File
     */
    public function setId(int $id): File
    {
        $this->id = $id;

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
     * @return File
     */
    public function setName(string $name): File
    {
        $this->name = $name;

        return $this;
    }

    /**
     * @return string
     */
    public function getLink(): string
    {
        return $this->link;
    }

    /**
     * @param string $link
     * @return File
     */
    public function setLink(string $link): File
    {
        $this->link = $link;

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
     * @return File
     */
    public function setType(string $type): File
    {
        $this->type = $type;

        return $this;
    }

    /**
     * @param array $params
     * @return int
     */
    public function addFile(array $params)
    {
        $file = new File;
        $file
            ->setName($params['name'])
            ->setLink($params['link'])
            ->setType($params['type'])
            ->save();

        return $file->getId();
    }

    /**
     * @param int $id
     * @return bool|Model
     */
    public function getFile(int $id)
    {
        $query = Query::table(static::$table)
            ->select()
            ->where('id', '=', $id)
            ->first();

        return $query;
    }

    /**
     * @return int
     */
    public function getId(): int
    {
        return (int) $this->id;
    }
}
