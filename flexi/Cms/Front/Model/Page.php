<?php
namespace Flexi\Cms\Front\Model;

use Flexi\Orm\Model;
use Flexi\Orm\Query;

/**
 * Class Page
 * @package Flexi\Cms\Front\Model
 */
class Page extends Model
{
    /**
     * @var string
     */
    protected static $table = 'page';

    /**
     * @param string $segment
     * @return bool|Model
     */
    public function getPageBySegment($segment)
    {
        $query = Query::table(self::$table, __CLASS__)
            ->select()
            ->where('segment', '=', $segment)
            ->first()
        ;

        return $query;
    }

    /**
     * @param array $params
     * @return array|Query
     */
    public function getPages(array $params = [])
    {
        $fields = [];

        $query = Query::table(static::$table, __CLASS__)
            ->select($fields);

        if (isset($params['layout'])) {
            $query = $query->where('layout', '=', $params['layout']);
        }

        if (isset($params['order_by']) && is_array($params['order_by'])) {
            foreach ($params['order_by'] as $column => $direction) {
                $query = $query->orderBy($column, $direction);
            }
        }

        $query = $query->all();

        return $query;
    }
}
