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
     * Returns trashed posts.
     *
     * @return mixed
     */
    public function getTrashed();

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

    /**
     * Content Ready a post.
     *
     * @param $post
     * @return mixed
     */
    public function contentReadyPost(Post $post);

    /**
     * Drafts a post.
     *
     * @param $post
     * @return mixed
     */
    public function draftPost(Post $post);

    /**
     * Publishes a post.
     *
     * @param $post
     * @return mixed
     */
    public function publishPost(Post $post);

    /**
     * Unpublishes a post.
     *
     * @param $post
     * @return mixed
     */
    public function unpublishPost(Post $post);

    /**
     * Deletes a post.
     *
     * @param $post
     * @return mixed
     */
    public function deletePost(Post $post);

    /**
     * Restores a post.
     *
     * @param $post
     * @return mixed
     */
    public function restorePost(Post $post);

    /**
     * Searches posts by a query string.
     *
     * @param $query
     * @return mixed
     */
    public function searchFor($query);
}