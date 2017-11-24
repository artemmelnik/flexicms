<?php
namespace Flexi\Cms\Admin\Model;

use Flexi\Orm\Model;
use Query;

/**
 * Class Setting
 * @package Flexi\Cms\Admin\Model
 */
class Setting extends Model
{
    const SECTION_GENERAL = 'general';

    /**
     * @var string
     */
    protected static $table = 'setting';

    /**
     * @return array
     */
    public function getSettings()
    {
        $query = Query::table(static::$table, __CLASS__)
            ->select()
            ->where('section', '=', self::SECTION_GENERAL)
            ->orderBy('id')
            ->all()
        ;

        return $query;
    }

    /**
     * @param array $params
     */
    public function update(array $params)
    {
        if (!empty($params)) {
            foreach ($params as $key => $value) {
                Query::table(static::$table, __CLASS__)
                    ->update(['value' => $value])
                    ->where('key_field', '=', $key)
                    ->run('update')
                ;
            }
        }
    }
}
