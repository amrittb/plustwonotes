<?php namespace App\Api\Transformers;

use App\Models\Post;
use League\Fractal\TransformerAbstract;

class PostTransformer extends TransformerAbstract {

    /**
     * Array of available includes.
     *
     * @var array
     */
    protected $availableIncludes = [
        "subject",
        "grade",
        "category",
    ];

    /**
     * Flag to determine if the body is to be included.
     *
     * @var bool
     */
    protected $includeBody = false;

    /**
     * Transforms a post model.
     *
     * @param Post $post
     * @return array
     */
    public function transform(Post $post) {
        $transformation = [
            'id'            => $post->id,
            'title'         => $post->post_title,
            'slug'          => $post->post_slug,
            'body'          => $post->post_body,
            'created_at'    => $post->created_at->toDateTimeString(),
            'updated_at'    => $post->updated_at->toDateTimeString(),
            'published_at'  => $post->published_at->toDateTimeString(),
            'is_imp'        => (bool) $post->imp,
            'is_featured'   => (bool) $post->featured,
        ];

        return $this->addLinks($post, $transformation);
    }

    /**
     * Adds Links to the transformation.
     * @param $post
     * @param $transformation
     */
    private function addLinks($post, $transformation) {
        $transformation['links'] = [
            'self'      => route('posts.show',['posts' => $post->id]),
            'parent'    => route('api.v1.posts.index'),
        ];

        return $transformation;
    }

    /**
     * Includes Post Subject.
     *
     * @param Post $post
     * @return \League\Fractal\Resource\Item
     */
    public function includeSubject(Post $post) {
        if ($post->category->has_subject) {
            return $this->item($post->subject, new SubjectTransformer());
        }
    }

    /**
     * Includes Post Grade.
     *
     * @param Post $post
     * @return \League\Fractal\Resource\Item
     */
    public function includeGrade(Post $post) {
        if($post->category->has_subject) {
            return $this->item($post->subject->grade, new GradeTransformer());
        }
    }

    /**
     * Includes Post Category.
     *
     * @param Post $post
     * @return \League\Fractal\Resource\Item
     */
    public function includeCategory(Post $post) {
        return $this->item($post->category, new CategoryTransformer());
    }

    /**
     * Sets Include body flag.
     *
     * @param $flag
     */
    public function setIncludeBodyFlag($flag) {
        $this->includeBody = $flag;
    }
}