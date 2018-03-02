<?php
namespace Modules\Admin\Model;

use Flexi;
use Modules;
use Flexi\Orm\Model;
use Query;

/**
 * Class CustomFieldGroup
 * @package Modules\Admin\Model
 */
class CustomFieldGroup extends Model
{
    const ACTIVE_STATUS = 1;
    const INACTIVE_STATUS = 0;

    /**
     * @var string
     */
    protected static $table = 'custom_field_group';

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
        $customFieldGroup->setAttribute('title', $params['title']);
        $customFieldGroup->setAttribute('type', $params['type']);
        $customFieldGroup->setAttribute('layout', $params['layout']);
        $customFieldGroup->setAttribute('template', $params['template']);
        $customFieldGroup->setAttribute('status', static::ACTIVE_STATUS);
        $customFieldGroup->save();

        return $customFieldGroup->getAttribute('id');
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

    public function getFieldGroupByPage(Modules\Admin\Model\Page $page)
    {
        $layout = $page->getAttribute('layout');
        $template = $page->getAttribute('type');

        $sql = "
            SELECT
              id,
              title,
              type
            FROM
              " . static::$table . "
            WHERE type = 'page'
            AND (layout = 'all' OR layout = '" . $layout . "')
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
