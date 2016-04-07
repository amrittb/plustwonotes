<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Role extends Model {

    /**
     * @var bool
     */
    public $timestamps = false;

    /**
     * Defines a relationship with User Model.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function users() {
        return $this->belongsToMany('\App\Models\User','user_role');
    }
}
