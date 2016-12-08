<?php namespace App\Api\Transformers;

use App\Models\Grade;
use League\Fractal\TransformerAbstract;

class GradeTransformer extends TransformerAbstract {

    protected $availableIncludes = [
        "subjects"
    ];

    /**
     * Transforms a grade to an array.
     *
     * @param Grade $grade
     * @return array
     */
    public function transform(Grade $grade) {
        return [
            'id'        => $grade->id,
            'name'      => $grade->grade_name,
            'subject_ids'  => $grade->subjects->pluck('id'),
        ];
    }

    /**
     * Includes grade subjects.
     *
     * @param Grade $grade
     * @return \League\Fractal\Resource\Collection
     */
    public function includeSubjects(Grade $grade) {
        return $this->collection($grade->subjects, new SubjectTransformer());
    }
}