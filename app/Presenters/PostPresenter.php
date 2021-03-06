<?php namespace App\Presenters;

use App\Helpers\ImageHelper;
use App\Models\Category;
use App\Models\Post;
use Illuminate\Support\Str;
use Robbo\Presenter\Presenter;

class PostPresenter extends Presenter{

    /**
     * Length of truncated text for post title.
     */
    const TITLE_TRUNCATE_LIMIT = 20;

    /**
     * Status Text of post when post is published.
     */
    const STATUS_PUBLISHED_TEXT = "Published";

    /**
     * Status Text of post when the post is scheduled to publish in future.
     */
    const STATUS_PUBLISH_PENDING_TEXT = "Publish Pending";

    /**
     * Status Text of post when the post is ready to be reviewed and published.
     */
    const STATUS_CONTENT_READY_TEXT = "Content Ready";

    /**
     * Status Text of post when the post is being created or drafted.
     */
    const STATUS_DRAFT_TEXT = "Draft";

    /**
     * Status Text of post when the post is moved to trash.
     */
    const STATUS_TRASHED_TEXT = "Trashed";

    /**
     * Presents grade and subject from post model.
     *
     * @return string
     */
    public function presentGradeSubject(){
        if($this->subject != null){
            return 'Grade '.$this->subject->grade->grade_name.' '.$this->subject->subject_name;
        } else {
            return '';
        }
    }

    /**
    * Presents grade for the post.
    *
    * @return string
    */
    public function presentGrade() {
        if($this->subject != null) {
            return $this->subject->grade->grade_name;
        }

        return '';
    }

    /**
    * Presents subject slug for the post.
    *
    * @return string
    */
    public function presentSubjectSlug() {
        if($this->subject != null) {
            return $this->subject->subject_slug;
        }

        return '';
    }

    /**
     * Presents truncated post title.
     *
     * @return string
     */
    public function presentPostTitleTruncated(){
        return Str::limit($this->post_title,PostPresenter::TITLE_TRUNCATE_LIMIT);
    }

    /**
     * Presents status text of the post.
     *
     * @return string
     */
    public function presentStatusText(){
        if($this->isDeleted()) {
            return PostPresenter::STATUS_TRASHED_TEXT;
        }

        switch(intval($this->status_id)){
            case Post::STATUS_PUBLISHED:
                if($this->isPublished()){
                    return PostPresenter::STATUS_PUBLISHED_TEXT;
                } else {
                    return PostPresenter::STATUS_PUBLISH_PENDING_TEXT;
                }
                break;
            case Post::STATUS_CONTENT_READY:
                return PostPresenter::STATUS_CONTENT_READY_TEXT;
                break;
            case Post::STATUS_DRAFT:
                return PostPresenter::STATUS_DRAFT_TEXT;
                break;
            default:
                return PostPresenter::STATUS_TRASHED_TEXT;
                break;
        }
    }

    /**
     * Presents preview of post text.
     *
     * @return string
     */
    public function presentPostBodyPreview(){
        return Str::words(strip_tags($this->post_body,50));
    }

    /**
     * Presents name of the post creator.
     *
     * @return string
     */
    public function presentCreatorName(){
        return $this->user->name;
    }

    /**
     * Presents curd post actions.
     *
     * @return string
     */
    public function presentActions(){
        return view("_partials.posts.admin.actions",['post' => $this])->render();
    }

    /**
     * Presents post reading url.
     *
     * @return string
     */
    public function presentReadUrl(){
        return route('posts.show',['posts' => $this->post_slug]);
    }

    /**
     * Presents post editing url.
     *
     * @return string
     */
    public function presentEditUrl(){
        return route('posts.edit',['posts' => $this->post_slug]);
    }

    /**
     * Presents post content ready url.
     *
     * @return string
     */
    public function presentContentReadyUrl(){
        return route('posts.contentready',['posts' => $this->post_slug]);
    }

    /**
     * Presents post draft url.
     *
     * @return string
     */
    public function presentDraftUrl(){
        return route('posts.draft',['posts' => $this->post_slug]);
    }

    /**
     * Presents post publish url.
     *
     * @return string
     */
    public function presentPublishUrl(){
        return route('posts.publish',['posts' => $this->post_slug]);
    }

    /**
     * Presents post unpublish url.
     *
     * @return string
     */
    public function presentUnpublishUrl(){
        return route('posts.unpublish',['posts' => $this->post_slug]);
    }

    /**
     * Presents post deleting url.
     *
     * @return string
     */
    public function presentDeleteUrl(){
        $routeParam = ['posts' => $this->post_slug];

        if($this->isDeleted()){
            $routeParam = ['posts' => $this->id];
        }

        return route('posts.destroy',$routeParam);
    }

    /**
     * Presents post restoring url.
     *
     * @return mixed
     */
    public function presentRestoreUrl() {
        return route('posts.restore',['posts' => $this->id]);
    }

    /**
     * Presents Featured Image Thumbnail URL.
     * @return string
     */
    public function presentFeaturedImgThumbnailUrl() {
        if($this->featured_img != null) {
            return asset(ImageHelper::getFeaturedImageThumbnailPath($this->featured_img));
        } else {
            switch($this->category_id) {
                case Category::NOTES:
                    return asset("img/note.png");
                    break;
                case Category::SYLLABUS:
                    return asset("img/syllabus.png");
                    break;
                case Category::BLOG:
                    return asset("img/blog.png");
                    break;
                default:
                    return asset("img/blog.png");
                    break;
            }
        }
    }

    /**
     * Presents Featured image url.
     *
     * @return string
     */
    public function presentFeaturedImgUrl() {
        if($this->featured_img != null) {
            return asset(ImageHelper::getFeaturedImagePath($this->featured_img));
        }

        return "#";
    }
}
