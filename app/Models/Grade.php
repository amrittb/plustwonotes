<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Grade extends Model {

    public $timestamps = false;

    /**
     * Defines the relationship with Subject Model.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function subjects(){
        return $this->hasMany('\App\Models\Subject');
    }
}
