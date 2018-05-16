<?php
namespace Modules\Backend\Model;

use Flexi\Orm\Model;
use Flexi\Orm\Query;

/**
 * Class User
 * @package Modules\Backend\Model
 */
class User extends Model
{
    /**
     * @var string
     */
    protected static $table = 'user';

    /**
     * @return array
     */
    public function getUsers()
    {
        $query = Query::table(static::$table)
            ->select()
            ->orderBy('id')
            ->all();

        return $query;
    }

    /**
     * @param array $params
     * @return bool|User
     */
    public function getUserByParams(array $params)
    {
        $query = Query::table(static::$table)
            ->select()
            ->where('email', '=', $params['email'])
            ->where('password', '=', md5($params['password']))
            ->first();

        return $query;
    }

    /**
     * @param int $id
     * @param string $hash
     */
    public function updateHash($id, $hash)
    {
        Query::table(static::$table)
            ->update(['hash' => $hash])
            ->where('id', '=', $id)
            ->run('update');
    }
}