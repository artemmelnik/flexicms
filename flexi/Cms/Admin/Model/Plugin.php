<?php
namespace Flexi\Cms\Admin\Model;

use Flexi\Orm\Model;
use Query;

/**
 * Class Plugin
 * @package Flexi\Cms\Admin\Model
 */
class Plugin extends Model
{
    /**
     * @var string
     */
    protected static $table = 'plugin';

    /**
     * @return array
     */
    public function getPlugins()
    {
        $query = Query::table(static::$table, __CLASS__)
            ->select()
            ->orderBy('id')
            ->all()
        ;

        return $query;
    }
}
