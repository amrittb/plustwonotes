<?php

namespace App\Repositories\Contracts;

use App\Models\Category;
use App\Models\Post;

interface PostRepositoryInterface
{
    /*
     * Getters for posts.
     */
    public function allPublished();
    public function allUntrashed();
    public function getForCategory(Category $category);

    /*
     * Setters for posts.
     */
    public function savePost($input,Post $post = null);
}