<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

class Post extends Model{

    /**
     * Status of post when published.
     */
    const STATUS_PUBLISHED = 1;

    /**
     * Dates for Post model.
     *
     * @var array
     */
    protected $dates = [
        'published_at'
    ];

    /**
     * Get published posts.
     *
     * @param Builder $query
     * @return $this
     */
    public function scopePublished(Builder $query){
        return $query->where('published_at','<=',\Carbon\Carbon::now())
                    ->where('status_id','=',Post::STATUS_PUBLISHED);
    }

    /**
     * Get unpublished posts.
     *
     * @param Builder $query
     * @return $this
     */
    public function scopeUnpublished(Builder $query){
        return $query->where('published_at','=',null)
                    ->where('status_id','!=',Post::STATUS_PUBLISHED);
    }
}