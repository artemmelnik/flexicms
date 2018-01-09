<?php
namespace Flexi\Cms\Front\Model;

use Flexi\Orm\Model;
use Flexi\Orm\Query;

/**
 * Class Menu
 * @package Flexi\Cms\Front\Model
 */
class Menu extends Model
{
    /**
     * @var string
     */
    protected static $table = 'menu';

    public function getMenu(int $id)
    {
        //$query = Query::table(static::$table)
    }
}
