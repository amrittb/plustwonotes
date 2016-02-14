<?php namespace App\Presenters;

use App\Models\Post;
use Illuminate\Support\Str;
use Robbo\Presenter\Presenter;

class PostPresenter extends Presenter{

    /**
     * Length of truncated text for post title.
     */
    const TITLE_TRUNCATE_LIMIT = 30;

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
            case Post::STATUS_TRASHED:
                return PostPresenter::STATUS_TRASHED_TEXT;
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
}