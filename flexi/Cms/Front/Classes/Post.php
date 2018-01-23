<?php
namespace Flexi\Cms\Front\Classes;

use Flexi;

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
        $postModel = new Flexi\Cms\Front\Model\Post();

        return $postModel->getPostsInId($ids);
    }
}
