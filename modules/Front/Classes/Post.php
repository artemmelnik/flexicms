<?php
namespace Modules\Front\Classes;

use Modules;

/**
 * Class Post
 * @package Flexi\Cms\Front\Classes
 */
class Post
{
    /**
     * @param array $ids
     * @return array
     */
    public static function getPostsInIds(array $ids): array
    {
        $postModel = new Modules\Front\Model\Post();

        return $postModel->getPostsInId($ids);
    }
}
