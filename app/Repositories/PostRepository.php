<?php

namespace App\Repositories;

use App\Models\Category;
use App\Models\Post;
use App\Repositories\Contracts\PostRepositoryInterface;
use Carbon\Carbon;
use Illuminate\Support\Str;

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
     * @param \App\Models\Category $category
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
            $post = new Post();
            $post->published_at = Carbon::now();
            $post->status_id = Post::STATUS_DRAFT;
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
}