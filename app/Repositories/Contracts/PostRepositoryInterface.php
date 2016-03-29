<?php

namespace App\Repositories\Contracts;

use App\Models\Category;
use App\Models\Post;

interface PostRepositoryInterface {

    /**
     * Returns all published posts.
     *
     * @return mixed
     */
    public function allPublished();

    /**
     * Returns all untrashed posts.
     *
     * @return mixed
     */
    public function allUntrashed();

    /**
     * Returns posts of the given category.
     *
     * @param Category $category
     * @return mixed
     */
    public function getForCategory(Category $category);

    /**
     * Saves a post.
     *
     * @param $input
     * @param Post|null $post
     * @return mixed
     */
    public function savePost($input,Post $post = null);

    /**
     * Returns Recommended posts for the user.
     *
     * @return mixed
     */
    public function getRecommended();
}