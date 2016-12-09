<?php

namespace App\Repositories\Contracts;

use App\Models\Category;
use App\Models\Grade;
use App\Models\Subject;
use App\Models\Post;

interface PostRepositoryInterface {

    /**
     * Returns all published posts.
     *
     * @return mixed
     */
    public function allPublished();

    /**
     * Returns all published posts by grade.
     *
     * @param $grade
     * @return mixed
     */
    public function allPublishedByGrade(Grade $grade);

    /**
     * Returns all published posts by subject.
     *
     * @param $subject
     * @return mixed
     */
    public function allPublishedBySubject(Subject $subject);

    /**
     * Returns all untrashed posts.
     *
     * @return mixed
     */
    public function allUntrashed();

    /**
    * Returns recent posts.
    *
    * @return mixed
    */
    public function getRecentPosts();

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

    /**
     * Collection of items from options.
     *
     * @param $options
     * @return mixed
     */
    public function allFromOptions($options);

    /**
     * Item from options.
     *
     * @param $id
     * @param $options
     * @return mixed
     */
    public function itemFromOptions($id, $options);
}
