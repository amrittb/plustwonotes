<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model {

    public $timestamps = false;

    /**
     * A constant to define blog's index in database.
     */
    const BLOG = 3;
}
