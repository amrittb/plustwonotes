<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Entity extends Model {

    /**
     * @var bool
     */
    public $timestamps = false;

    /**
     * Defines a relationship for actions.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function actions() {
        return $this->belongsToMany('\App\Models\Action','permissions');
    }
}
