<?php
namespace Modules\Backend\Model;

use Flexi\Orm\Model;
use Query;

/**
 * Class Menu
 * @package Modules\Backend\Model
 */
class Menu extends Model
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
    protected static $table = 'menu';

    /**
     * @return array
     */
    public function columnMap(): array
    {
        return [
            'id'   => 'id',
            'name' => 'name'
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
    public function setId(int $id): Menu
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
     * @return $this
     */
    public function setName(string $name): Menu
    {
        $this->name = $name;

        return $this;
    }

    /**
     * @return array
     */
    public function getList()
    {
        $query = Query::table(static::$table)
            ->select()
            ->orderBy('id', 'desc')
            ->all()
        ;

        return $query;
    }
}
