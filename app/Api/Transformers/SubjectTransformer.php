<?php namespace App\Api\Transformers;

use App\Models\Subject;
use League\Fractal\TransformerAbstract;

class SubjectTransformer extends TransformerAbstract {

    /**
     * List of resources possible to include.
     *
     * @var array
     */
    protected $availableIncludes = [
        'grade'
    ];

    /**
     * Transforms a Subject Model to consumable array.
     *
     * @param Subject $subject
     * @return array
     */
    public function transform(Subject $subject) {
        return [
            'id'        => $subject->id,
            'name'      => $subject->subject_name,
            'grade_id'  => $subject->grade_id,
        ];
    }

    /**
     * Include a subject to grade.
     *
     * @param Subject $subject
     * @return \League\Fractal\Resource\Item
     */
    public function includeGrade(Subject $subject) {
        return $this->item($subject->grade, new GradeTransformer);
    }
}