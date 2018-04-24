<?php
namespace Modules\Frontend\Model;

use Flexi\Orm\Model;
use Query;

/**
 * Class File
 * @package Modules\Frontend\Model
 */
class File extends Model
{
    /**
     * @var string
     */
    protected static $table = 'file';

    /**
     * @param int $id
     * @return null|array
     */
    public function getFileById(int $id)
    {
        $result = Query::result("
            SELECT
              *
            FROM " . static::$table . "
            WHERE id = " . $id . "
            LIMIT 1
        ");

        return isset($result[0]) ? $result[0] : null;
    }
}
