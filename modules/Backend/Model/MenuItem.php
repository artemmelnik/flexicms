<?php
namespace Modules\Backend\Model;

use Flexi\Orm\Model;
use Query;

/**
 * Class MenuItem
 * @package Modules\Backend\Model
 */
class MenuItem extends Model
{
    const NEW_MENU_ITEM_NAME = 'New item';
    const FIELD_NAME = 'name';
    const FIELD_LINK = 'link';

    /**
     * @var int
     */
    protected $id;

    /**
     * @var int
     */
    protected $menuId;

    /**
     * @var string
     */
    protected $name;

    /**
     * @var int
     */
    protected $parent;

    /**
     * @var int
     */
    protected $position;

    /**
     * @var string
     */
    protected $link;

    /**
     * @var string
     */
    protected static $table = 'menu_item';

    /**
     * @return array
     */
    public function columnMap(): array
    {
        return [
            'id'       => 'id',
            'menu_id'  => 'menuId',
            'name'     => 'name',
            'parent'   => 'parent',
            'position' => 'position',
            'link'     => 'link',
        ];
    }

    /**
     * @param int $menuId
     * @param array $params
     * @return array
     */
    public function getItems(int $menuId, array $params = []): array
    {
        $query = Query::table(static::$table)
            ->select()
            ->where('menu_id', '=', $menuId)
            ->orderBy('position')
            ->all()
        ;

        return $query;
    }

    /**
     * @param array $params
     */
    public function sort(array $params = [])
    {
        $items = isset($params['data']) ? json_decode($params['data']) : [];

        if (!empty($items) and isset($items[0])) {
            foreach ($items[0] as $position => $item) {
                Query::table(static::$table)
                    ->update([
                        'position' => $position
                    ])
                    ->where('id', '=', $item->id)
                    ->run('update')
                ;
            }
        }
    }

    /**
     * @param int $itemId
     */
    public function remove(int $itemId)
    {
        Query::table(static::$table)
            ->where('id', '=', $itemId)
            ->run('delete')
        ;
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
    public function setId(int $id): MenuItem
    {
        $this->id = $id;

        return $this;
    }

    /**
     * @return int
     */
    public function getMenuId(): int
    {
        return (int) $this->menuId;
    }

    /**
     * @param int $menuId
     * @return MenuItem
     */
    public function setMenuId(int $menuId): MenuItem
    {
        $this->menuId = $menuId;

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
     * @return MenuItem
     */
    public function setName(string $name): MenuItem
    {
        $this->name = $name;

        return $this;
    }

    /**
     * @return int
     */
    public function getParent(): int
    {
        return (int) $this->parent;
    }

    /**
     * @param int $parent
     * @return MenuItem
     */
    public function setParent(int $parent): MenuItem
    {
        $this->parent = $parent;

        return $this;
    }

    /**
     * @return int
     */
    public function getPosition(): int
    {
        return (int) $this->position;
    }

    /**
     * @param int $position
     * @return MenuItem
     */
    public function setPosition(int $position): MenuItem
    {
        $this->position = $position;

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
     * @return MenuItem
     */
    public function setLink(string $link): MenuItem
    {
        $this->link = $link;

        return $this;
    }
}
