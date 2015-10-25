<?php

namespace App\Repositories\Contracts;

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
    public function savePost($input);
}