<?php

namespace App\Repositories\Contracts;

interface CategoryRepositoryInterface{

    /**
     * Returns all categories for select element.
     *
     * @return mixed
     */
    public function allForSelect();

    /**
     * Returns all categories.
     *
     * @return mixed
     */
    public function all();
}