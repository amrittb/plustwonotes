<?php namespace App\Models;

use App\Presenters\CategoryPresenter;
use Illuminate\Database\Eloquent\Model;
use Robbo\Presenter\PresentableInterface;
use Robbo\Presenter\Robbo;

class Category extends Model implements PresentableInterface{

    public $timestamps = false;

    /**
     * A constant to define blog's index in database.
     */
    const BLOG = 3;

    /**
     * Finds Category by slug.
     * @param $value
     * @return mixed
     */
    public static function findBySlug($value) {
        return static::where('category_slug',$value)->first();
    }

    /**
     * Defines a relationship with Post Model.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function posts(){
        return $this->hasMany('\App\Models\Post');
    }

    /**
     * Return a created presenter.
     *
     * @return Robbo\Presenter\Presenter
     */
    public function getPresenter() {
        return new CategoryPresenter($this);
    }
}
