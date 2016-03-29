<?php namespace App\Repositories;

use App\Models\Category;
use App\Repositories\Contracts\CategoryRepositoryInterface;

class CategoryRepository implements CategoryRepositoryInterface{

    /**
     * Creates an array of categories to use in HTML select.
     *
     * @return array
     */
    public function allForSelect(){
        $categories = Category::all();

        $categoryIds = array();
        $categoryNames = array();

        foreach($categories as $category) {
            array_push($categoryIds, $category->id);
            array_push($categoryNames, $category->category_name);
        }

        $categoryArray = array_combine($categoryIds,$categoryNames);
        return $categoryArray;
    }

    /**
     * Returns all categories.
     *
     * @return mixed
     */
    public function all() {
        $categories = Category::all();

        return $categories;
    }
}