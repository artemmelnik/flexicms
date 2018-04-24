<?php
namespace Modules\Frontend\Classes;

use Modules;

/**
 * Class Post
 * @package Flexi\Cms\Frontend\Classes
 */
class Post
{
    /**
     * @param array $ids
     * @return array
     */
    public static function getPostsInIds(array $ids): array
    {
        $postModel = new Modules\Frontend\Model\Post();

        return $postModel->getPostsInId($ids);
    }
}
