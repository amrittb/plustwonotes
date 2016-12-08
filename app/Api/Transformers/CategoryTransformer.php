<?php namespace App\Api\Transformers;

use App\Models\Category;
use League\Fractal\TransformerAbstract;

class CategoryTransformer extends TransformerAbstract {

    /**
     * Transforms a category model into a consumable array.
     *
     * @param Category $category
     * @return array
     */
    public function transform(Category $category) {
        return [
            'id' => $category->id,
            'name' => $category->category_name,
            'has_subject' => (boolean) $category->has_subject,
        ];
    }
}