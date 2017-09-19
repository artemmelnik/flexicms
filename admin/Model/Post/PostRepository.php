<?php

namespace Admin\Model\Post;

use Engine\Model;

class PostRepository extends Model
{
    /**
     * @return mixed
     */
    public function getPosts()
    {
        $sql = $this->queryBuilder->select()
            ->from('post')
            ->orderBy('id', 'DESC')
            ->sql();

        return $this->db->query($sql);
    }

    /**
     * @param $id
     * @return null|\stdClass
     */
    public function getPostData($id)
    {
        $post = new Post($id);

        return $post->findOne();
    }

    /**
     * @param $params
     * @return mixed
     */
    public function createPost($params)
    {
        $post = new Post;
        $post->setTitle($params['title']);
        $post->setContent($params['content']);
        $postId = $post->save();

        return $postId;
    }

    /**
     * @param $params
     */
    public function updatePost($params)
    {
        if (isset($params['post_id'])) {
            $post = new Post($params['post_id']);
            $post->setTitle($params['title']);
            $post->setContent($params['content']);
            $post->save();
        }
    }
}