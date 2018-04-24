<?php
namespace Modules\Frontend\Model;

use Flexi\Orm\Model;
use Flexi\Orm\Query;

/**
 * Class Menu
 * @package Modules\Frontend\Model
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
