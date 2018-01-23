<?php
namespace Modules\Front\Model;

use Flexi\Orm\Model;
use Flexi\Orm\Query;

/**
 * Class Page
 * @package Modules\Front\Model
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

        $query = $query->all();

        return $query;
    }
}
