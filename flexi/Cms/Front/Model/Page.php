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
}
