<?php namespace App\Repositories;

use App\Models\Category;
use App\Models\Grade;
use App\Models\Subject;
use App\Models\Post;
use App\Repositories\Contracts\PostRepositoryInterface;
use Auth;
use Carbon\Carbon;
use Illuminate\Support\Str;

class PostRepository implements PostRepositoryInterface {

    /**
     * Limit to posts for pagination.
     *
     * @var int
     */
    protected $postLimit = 25;

    /**
     * PostQueryBuilder instance.
     *
     * @var PostQueryBuilder
     */
    protected $postQueryBuilder;

    /**
     * PostRepository constructor.
     */
    public function __construct(){
        $this->postQueryBuilder = new PostQueryBuilder();
    }

    /**
     * Get all published posts.
     *
     * @return mixed
     */
    public function allPublished() {
        $posts = $this->getPublishedPosts()
                        ->paginate($this->postLimit);

        return $posts;
    }

    /**
     * Returns all published posts that has the grade.
     *
     * @param Grade $grade
     * @return mixed
     */
    public function allPublishedByGrade(Grade $grade) {
        $posts = $this->getPublishedPosts()
                    ->ofGrade($grade)
                    ->paginate($this->postLimit);
        return $posts;
    }

    /**
    * Returns all published posts that is of the subject.
    *
    * @param Subject $subject
    * @return mixed
    */
    public function allPublishedBySubject(Subject $subject) {
        $posts = $this->getPublishedPosts()
                    ->ofSubject($subject)
                    ->paginate($this->postLimit);

        return $posts;
    }

    /**
     * Get all posts except trashed.
     *
     * @return mixed
     */
    public function allUntrashed() {
        $posts = Post::with('subject.grade','category','user')
                ->where(function($query){
                    $query->where ('status_id','=',Post::STATUS_PUBLISHED)
                        ->orWhere('status_id','=',Post::STATUS_CONTENT_READY)
                        ->orWhere(function($query){
                            $query->where('status_id','=',Post::STATUS_DRAFT)
                                    ->where('user_id','=',Auth::id());
                        });
                })
                ->orderBy('status_id','desc')
                ->latest()
                ->paginate($this->postLimit);

        return $posts;
    }

    /**
     * Returns recent posts.
     *
     * @return mixed
     */
    public function getRecentPosts() {
        $posts = Post::published()
                    ->latestPublished()
                    ->take(5)
                    ->get();

        return $posts;
    }

    /**
     * Get all posts for certain category;
     *
     * @param Category $category
     * @return mixed
     */
    public function getForCategory(Category $category) {
        $posts = Post::where('category_id',$category->id)->published()->latestPublished()->paginate($this->postLimit);

        return $posts;
    }

    /**
     * Get all trashed posts.
     *
     * @return mixed
     */
    public function getTrashed() {
        $posts = Post::onlyTrashed()->orderBy('deleted_at','desc')->paginate($this->postLimit);

        return $posts;
    }

    /**
     * Saves a post to the database.
     *
     * @param $input
     * @param Post $post
     * @return bool
     */
    public function savePost($input,Post $post = null) {
        if(is_null($post)){
            $post = $this->createPost();
            $post->user_id = Auth::id();
        }

        $post->post_title = Str::title($input['post_title']);
        $post->post_slug = ($input['post_slug'] == "" || $input['post_slug'] == null) ? str_slug($post->post_title) : str_slug($input['post_slug']);
        $post->post_body = $input['post_body'];

        if(!is_null($input['published_at'])){
            $post->published_at = Carbon::parse($input['published_at']);
        }

        $post->category_id = (intval($input['category_id']))?:null;

        $category = Category::find($input['category_id']);

        $post->subject_id = ($category->has_subject)?intval($input['subject_id']):null;
        $post->imp = isset($input['imp']);
        $post->featured = isset($input['featured']);

        return $post->save();
    }

    /**
     *  Stubs out an initial post for a post creation.
     *
     * @return Post
     */
    protected function createPost() {
        $post = new Post();

        $this->draftPost($post);

        return $post;
    }

    /**
     * Content Ready a post.
     *
     * @param $post
     * @return mixed
     */
    public function contentReadyPost(Post $post) {
        if($post->isContentReadyableByUser(Auth::user())){
            $post->status_id = Post::STATUS_CONTENT_READY;
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
    public function draftPost(Post $post) {
        if($post->isDraftable()){
            $post->status_id = Post::STATUS_DRAFT;
            return $post->save();
        }
        return false;
    }

    /**
     * Publishes a post.
     *
     * @param Post $post
     * @return bool
     */
    public function publishPost(Post $post) {
        if($post->isPublishable()){
            $post->status_id = Post::STATUS_PUBLISHED;
            return $post->save();
        }
        return false;
    }

    /**
     * Unpublishes a post.
     *
     * @param $post
     * @return mixed
     */
    public function unpublishPost(Post $post) {
        if($post->isUnpublishable()){
            $post->status_id = Post::STATUS_CONTENT_READY;
            return $post->save();
        }
        return false;
    }

    /**
     * Deletes the post.
     *
     * @param Post $post
     * @return bool|null|void
     * @throws \Exception
     */
    public function deletePost(Post $post) {
        if($post->isDeleted()){
            // Forces permanent deleted if the post is already soft deleted.
            return $post->forceDelete();
        }

        return $post->delete();
    }

    /**
     * Restores a post.
     *
     * @param $post
     * @return mixed
     */
    public function restorePost(Post $post) {
        return $post->restore();
    }

    /**
     * Returns Recommended posts for the user.
     *
     * @return mixed
     */
    public function getRecommended() {
        $posts = Post::published()->featuredFirst()->latest()->take(3)->get();

        return $posts;
    }

    /**
     * Searches posts by a query string.
     *
     * @param $query
     * @return mixed
     */
    public function searchFor($query) {
        $posts = Post::with('subject.grade','category')
                        ->published()
                        ->matchesSearchQuery($query)
                        ->impFirst()
                        ->latest()
                        ->paginate($this->postLimit);

        return $posts;
    }

    /**
     * Returns published posts.
     *
     * @return mixed
     */
    protected function getPublishedPosts() {
        return Post::with('subject.grade', 'category')
            ->published()
            ->impFirst()
            ->latestPublished();
    }

    /**
     * Collection of items from options.
     *
     * @param $options
     * @return mixed
     */
    public function allFromOptions($options) {
        return $this->postQueryBuilder->createForOptions($options)->get();
    }

    /**
     * Item from options.
     *
     * @param $id
     * @param $options
     * @return mixed
     */
    public function itemFromOptions($id, $options) {
        $validOptions = ['status'];

        return $this->postQueryBuilder
                    ->createForOptions(array_only($options, $validOptions))
                    ->where('id', $id)
                    ->first();
    }
}
