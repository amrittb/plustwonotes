<?php

namespace App\Models;

use App\Presenters\PostPresenter;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Auth;
use Robbo\Presenter\PresentableInterface;
use Robbo\Presenter\Robbo;

class Post extends Model implements PresentableInterface{

    use SoftDeletes;

    /**
     * Status of post when published.
     */
    const STATUS_PUBLISHED = 1;

    /**
     * Status of post when content is ready to be published but not yet published.
     */
    const STATUS_CONTENT_READY = 2;

    /**
     * Status of post when content is being created and drafted.
     */
    const STATUS_DRAFT = 3;

    /**
     * Status of post when it is moved to trash.
     */
    const STATUS_TRASHED = 4;

    /**
     * Dates for Post model.
     *
     * @var array
     */
    protected $dates = [
        'published_at',
        'deleted_at'
    ];

    /**
     * Fillable columns for the model.
     *
     * @var array
     */
    protected $fillable = [
        'post_title',
        'post_body'
    ];

    /**
     * Get published posts.
     *
     * @param Builder $query
     * @return $this
     */
    public function scopePublished(Builder $query){
        return $query->where('published_at','<=',\Carbon\Carbon::now())
                    ->where('status_id','=',Post::STATUS_PUBLISHED);
    }

    /**
     * Get unpublished posts.
     *
     * @param Builder $query
     * @return $this
     */
    public function scopeUnpublished(Builder $query){
        return $query->where('published_at','=',null)
                    ->where('status_id','!=',Post::STATUS_PUBLISHED);
    }

    /**
     * Sorts posts by important first.
     *
     * @param Builder $query
     * @return mixed
     */
    public function scopeImpFirst(Builder $query) {
        return $query->orderBy('imp','DESC');
    }

    /**
     * Accessor for published_at attribute.
     *
     * @param $value
     * @return string
     */
    public function getPublishedAtAttribute($value){
        $date = new Carbon($value);
        return $date;
    }

    /**
     * Checks if the post is not a blog.
     *
     * @return bool
     */
    public function isNotBlog() {
        return ($this->category_id != Category::BLOG);
    }

    /**
     * Checks if the post is a draft.
     *
     * @return bool
     */
    public function isDraft() {
        return ($this->status_id == Post::STATUS_DRAFT);
    }

    /**
     * Checks if the post is ready to be published.
     *
     * @return bool
     */
    public function isContentReady() {
        return ($this->status_id == Post::STATUS_CONTENT_READY);
    }

    /**
     * Checks if the post is published.
     *
     * @return bool
     */
    public function isPublished(){
        return ($this->status_id == Post::STATUS_PUBLISHED && $this->published_at != null && $this->published_at <= Carbon::now());
    }

    /**
     * Checks if the post is deleted.
     *
     * @return bool
     */
    public function isDeleted(){
        return ($this->status_id == Post::STATUS_TRASHED && $this->trashed());
    }

    /**
     * Checks if the post is readable.
     *
     * @return bool
     */
    public function isReadable(){
        return $this->isPublished();
    }

    /**
     * Checks if the post is editable.
     *
     * @return bool
     */
    public function isEditable(){
        return ! ($this->isDeleted());
    }

    /**
     * Checks if the post is draftable.
     *
     * @return bool
     */
    public function isDraftable(){
        return $this->status_id == null || $this->isContentReady();
    }

    /**
     * Checks if the post is publishable.
     *
     * @return bool
     */
    public function isPublishable(){
        return $this->isContentReady();
    }

    /**
     * Checks if the post is unpublishable.
     *
     * @return bool
     */
    public function isUnpublishable() {
        return $this->status_id == Post::STATUS_PUBLISHED;
    }

    /**
     * Checks if the post is soft deleteable.
     *
     * @return bool
     */
    public function isSoftDeleteable(){
        return ! $this->isDeleted();
    }

    /**
     * Checks if the post is hard deleteable.
     *
     * @return bool
     */
    public function isHardDeleteable(){
        return $this->isDeleted();
    }

    /**
     * Checks if the post is deletable.
     *
     * @return bool
     */
    public function isDeletable() {
        return $this->isSoftDeleteable() || $this->isHardDeleteable();
    }

    /**
     * Checks if the post is editable by the user.
     *
     * @param User $user
     * @return bool
     */
    public function isEditableByUser(User $user) {
        return $this->isEditable() && ($user->isContentCreatorOnly()?$this->isCreatedBy($user):true);
    }

    /**
     * Checks if the post is content ready able by the user.
     *
     * @param User $user
     * @return bool
     */
    public function isContentReadyableByUser(User $user) {
        return $this->isDraft() && $this->isCreatedBy($user);
    }

    /**
     * Checks if the post is draftable by the user.
     *
     * @param User $user
     * @return bool
     */
    public function isDraftableByUser(User $user) {
        return $this->isDraftable() && ($user->isContentCreator()?$this->isCreatedBy($user):true);
    }

    /**
     * Checks if the post is deletable by the user.
     *
     * @param User $user
     * @return bool
     */
    public function isDeletableByUser(User $user) {
        return $this->isDeletable() && ($user->isContentCreatorOnly()?$this->isCreatedBy($user):true);
    }

    /**
     * Checks if the post is created by the given user.
     *
     * @param $user
     * @return bool
     */
    public function isCreatedBy($user) {
        $id = $user;

        if(!is_numeric($user)){
            $id = $user->id;
        }

        return $this->user_id == $id;
    }

    /**
     * Defines a relationship with subject model.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function subject(){
        return $this->belongsTo('\App\Models\Subject');
    }

    /**
     * Defines a relationship with Category model.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function category(){
        return $this->belongsTo('\App\Models\Category');
    }

    /**
     * Defines a relationship with User model.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user(){
        //  Add when migration is created.
        return $this->belongsTo('\App\Models\User');
    }

    /**
     * Return a created presenter.
     *
     * @return Robbo\Presenter\Presenter
     */
    public function getPresenter(){
        return new PostPresenter($this);
    }
}