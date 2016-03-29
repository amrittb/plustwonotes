<?php namespace App\Repositories;

use App\Models\Category;
use App\Models\Post;
use App\Repositories\Contracts\PostRepositoryInterface;
use Carbon\Carbon;
use Illuminate\Support\Str;

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
        $posts = Post::published()->latest()->paginate($this->postLimit);

        return $posts;
    }

    /**
     * Get all posts except trashed.
     *
     * @return mixed
     */
    public function allUntrashed(){
        $posts = Post::with('subject.grade','category')->latest()->where('status_id','!=',Post::STATUS_TRASHED)->paginate($this->postLimit);

        return $posts;
    }

    /**
     * Get all posts for certain category;
     *
     * @param Category $category
     * @return mixed
     */
    public function getForCategory(Category $category){
        $posts = Post::where('category_id',$category->id)->published()->latest()->paginate($this->postLimit);

        return $posts;
    }

    /**
     * Saves a post to the database.
     *
     * @param $input
     * @param Post $post
     * @return bool
     */
    public function savePost($input,Post $post = null){
        if(is_null($post)){
            $post = $this->createPost($post);
            $post->user_id = 1;
        }

        $post->post_title = Str::title($input['post_title']);
        $post->post_slug = ($input['post_slug'] == "" || $input['post_slug'] == null) ? str_slug($post->post_title) : str_slug($input['post_slug']);
        $post->post_body = $input['post_body'];

        if(!is_null($input['published_at'])){
            $post->published_at = Carbon::parse($input['published_at']);
        }

        $post->category_id = (intval($input['category_id']))?:null;
        $post->subject_id = (intval($input['subject_id']) != 0 && $post->category_id != Category::BLOG)?intval($input['subject_id']):null;

        return $post->save();
    }

    /**
     *  Stubs out an initial post for a post creation.
     *
     * @return Post
     * @internal param Post $post
     */
    protected function createPost(){
        $post = new Post();

        $this->draftPost($post);

        return $post;
    }

    /**
     * Deletes the post.
     *
     * @param Post $post
     * @return bool|null|void
     * @throws \Exception
     */
    public function deletePost(Post $post){
        if($post->isDeleted()){
            // Forces permanent deleted if the post is already soft deleted.
            return $post->forceDelete();
        }

        // Updating post status for deleting the post.
        Post::deleted(function($post){
            // This ensures that the model gets updated instead of getting inserted.
            $post->exists = true;

            $post->status_id = Post::STATUS_TRASHED;
            $post->save();

            // Resets the existence.
            $post->exists = false;
        });

        return $post->delete();
    }

    /**
     * Publishes a post.
     *
     * @param Post $post
     * @return bool
     */
    public function publishPost(Post $post){
        if($post->isPublishable()){
            $post->status_id = Post::STATUS_PUBLISHED;
            return $post->save();
        }
        return false;
    }

    /**
    * Drafts a post.
    *
    * @param Post $post
    * @return bool
    */
    public function draftPost(Post $post){
        if($post->isDraftable()){
            $post->status_id = Post::STATUS_DRAFT;
            return $post->save();
        }
        return false;
    }

    /**
     * Returns Recommended posts for the user.
     *
     * @return mixed
     */
    public function getRecommended() {
        $posts = Post::published()->latest()->take(3)->get();

        return $posts;
    }
}