<?php
namespace Flexi\Cms\Admin\Model;

use Flexi\Orm\Model;
use Flexi\Orm\Query;

/**
 * Class User
 * @package Flexi\Cms\Admin\Model
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
        $query = Query::table(static::$table, __CLASS__)
            ->select()
            ->orderBy('id')
            ->all()
        ;

        return $query;
    }

    /**
     * @param array $params
     * @return bool|User
     */
    public function getUserByParams(array $params)
    {
        $query = Query::table(static::$table, __CLASS__)
            ->select()
            ->where('email', '=', $params['email'])
            ->where('password', '=', md5($params['password']))
            ->first()
        ;

        return $query;
    }

    /**
     * @param int $id
     * @param string $hash
     */
    public function updateHash($id, $hash)
    {
        Query::table(static::$table, __CLASS__)
            ->update(['hash' => $hash])
            ->where('id', '=', $id)
            ->run('update')
        ;
    }
}