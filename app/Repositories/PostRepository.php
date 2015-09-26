<?php

namespace App\Repositories;

use App\Models\Category;
use App\Models\Post;
use App\Repositories\Contracts\PostRepositoryInterface;

/**
 * Class PostRepository
 * @package App\Repositories
 */
class PostRepository implements PostRepositoryInterface{

    /**
     * Limit to posts for pagination.
     *
     * @var int
     */
    protected $postLimit = 25;

    /**
     * Get all published posts.
     *
     * @return mixed
     */
    public function allPublished()
    {
        $posts = Post::published()->paginate($this->postLimit);

        return $posts;
    }

    /**
     * Get all posts except trashed.
     *
     * @return mixed
     */
    public function allUntrashed(){
        $posts = Post::paginate($this->postLimit);

        return $posts;
    }

    /**
     * Get all posts for certain category;
     *
     * @param \App\Models\Category $category
     * @return mixed
     */
    public function getForCategory(Category $category){
        $posts = Post::where('category_id',$category->id)->published()->paginate($this->postLimit);

        return $posts;
    }
}