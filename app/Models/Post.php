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
     * Returns number of posts.
     *
     * @param int $statusId
     * @return mixed
     */
    public static function numPosts($statusId = 0) {
        if($statusId == 0) {
            return Post::untrashed()->count();
        }

        return Post::ofStatus($statusId)->count();
    }

    /**
     * Returns number of important posts.
     *
     * @param int $statusId
     * @return mixed
     */
    public static function numImpPosts($statusId = 0) {
        if($statusId == 0) {
            return Post::untrashed()->isImportant()->count();
        }

        return Post::ofStatus($statusId)->count();
    }

    /**
     * Returns number of featured posts.
     *
     * @param int $statusId
     * @return mixed
     */
    public static function numFeaturedPosts($statusId = 0) {
        if($statusId == 0) {
            return Post::untrashed()->isFeatured()->count();
        }

        return Post::ofStatus($statusId)->count();
    }

    /**
     * Returns Number of posts of user.
     *
     * @param User $user
     * @return mixed
     */
    public static function numPostsOfUser(User $user) {
        return $user->posts()->count();
    }

    /**
     * @param Builder $query
     * @return Builder
     */
    public function scopeUntrashed(Builder $query) {
        return $query->where('status_id','!=',Post::STATUS_TRASHED);
    }

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
     * Sorts posts to get featured posts first.
     *
     * @param Builder $query
     * @return mixed
     */
    public function scopeFeaturedFirst(Builder $query) {
        return $query->orderBy('featured','DESC');
    }

    /**
     * Sorts posts to get latest published first.
     *
     * @param Builder $query
     * @return mixed
     */
    public function scopeLatestPublished(Builder $query) {
        return $query->orderBy('published_at','DESC');
    }

    /**
     * Matches a search query.
     *
     * @param Builder $query
     * @param $searchQuery
     */
    public function scopeMatchesSearchQuery(Builder $query,$searchQuery) {
        return $query->whereRaw("MATCH (post_title,post_body) AGAINST (?)",[$searchQuery]);
    }

    /**
     * Matches posts which are published before.
     *
     * @param Builder $query
     * @param Carbon $before
     * @return mixed
     */
    public function scopePublishedBefore(Builder $query, Carbon $before) {
        return $query->where('published_at', '<', $before);
    }

    /**
     * Matches posts which are published after.
     *
     * @param Builder $query
     * @param Carbon $after
     * @return mixed
     */
    public function scopePublishedAfter(Builder $query, Carbon $after) {
        return $query->where('published_at', '>', $after);
    }

    /**
     * Matches posts which are updated before.
     *
     * @param Builder $query
     * @param Carbon $before
     * @return mixed
     */
    public function scopeUpdatedBefore(Builder $query, Carbon $before) {
        return $query->where('updated_at', '<', $before);
    }

    /**
     * Matches posts which are updated after.
     *
     * @param Builder $query
     * @param Carbon $after
     * @return mixed
     */
    public function scopeUpdatedAfter(Builder $query, Carbon $after) {
        return $query->where('updated_at', '>', $after);
    }

    /**
     * Matches post of category.
     *
     * @param Builder $query
     * @param Category $category
     * @return mixed
     */
    public function scopeOfCategory(Builder $query, Category $category) {
        return $query->where('category_id', $category->id);
    }

    /**
     * Matches posts of a grade.
     *
     * @param Builder $query
     * @param Grade $grade
     * @return mixed
     */
    public function scopeOfGrade(Builder $query,Grade $grade){
        return $query->whereIn('subject_id',$grade->subjects->pluck('id')->all());
    }

    /**
     * Matches posts of a grade.
     *
     * @param Builder $query
     * @param Subject $subject
     * @return mixed
     */
    public function scopeOfSubject(Builder $query,Subject $subject){
        return $query->where('subject_id',$subject->id);
    }

    /**
     * Matches posts of a given status.
     *
     * @param Builder $query
     * @param $status
     * @return mixed
     */
    public function scopeOfStatus(Builder $query, $status){
        return $query->where('status_id',$status);
    }

    /**
     * Matches posts which are important.
     *
     * @param Builder $query
     * @return mixed
     */
    public function scopeIsImportant(Builder $query) {
        return $query->where('imp', true);
    }

    /**
     * Matches posts which are featured.
     *
     * @param Builder $query
     * @return mixed
     */
    public function scopeIsFeatured(Builder $query) {
        return $query->where('featured', true);
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
        return $this->trashed();
    }

    /**
     * Checks if the post is readable.
     *
     * @return bool
     */
    public function isReadable(){
        return ( ! $this->isDeleted()) && $this->isPublished();
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
        return ( ! $this->isDeleted()) && ($this->status_id == null || $this->isContentReady());
    }

    /**
     * Checks if the post is publishable.
     *
     * @return bool
     */
    public function isPublishable(){
        return ( ! $this->isDeleted()) && $this->isContentReady();
    }

    /**
     * Checks if the post is unpublishable.
     *
     * @return bool
     */
    public function isUnpublishable() {
        return ( ! $this->isDeleted()) && ($this->status_id == Post::STATUS_PUBLISHED);
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
        return $this->isEditable() && ($user->isPublisher()?:($user->isContentCreator()?$this->isCreatedBy($user):false));
    }

    /**
     * Checks if the post is content ready able by the user.
     *
     * @param User $user
     * @return bool
     */
    public function isContentReadyableByUser(User $user) {
        return ( ! $this->isDeleted()) && $this->isDraft() && $this->isCreatedBy($user);
    }

    /**
     * Checks if the post is draftable by the user.
     *
     * @param User $user
     * @return bool
     */
    public function isDraftableByUser(User $user) {
        return $this->isDraftable() and $this->isCreatedBy($user);
    }

    /**
     * Checks if the post is deletable by the user.
     *
     * @param User $user
     * @return bool
     */
    public function isDeletableByUser(User $user) {
        return $this->isDeletable() && (!$user->isPublisher()?$this->isCreatedBy($user):true);
    }

    /**
     * Checks if the post is restoreable by the user.
     *
     * @param User $user
     * @return bool
     */
    public function isRestoreableByUser(User $user) {
        return $this->isDeleted() && ($user->isContentCreatorOnly()?$this->isCreatedBy($user):true);
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
