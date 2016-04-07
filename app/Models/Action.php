<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Action extends Model {

    /**
     * @var bool
     */
    public $timestamps = false;

    /**
     * Defines a relationship with Entity Model.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function entities() {
        return $this->belongsToMany('\App\Models\Entity','permissions');
    }
}
