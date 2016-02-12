<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Subject extends Model {

    public $timestamps = false;

    /**
     * Defines the relationship with Grade Model.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function grade(){
        return $this->belongsTo('\App\Models\Grade');
    }
}
