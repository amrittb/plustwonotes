<?php namespace App\Models;

use App\Presenters\UserPresenter;
use Illuminate\Auth\Authenticatable;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Robbo\Presenter\PresentableInterface;

class User extends Model implements AuthenticatableContract, CanResetPasswordContract, PresentableInterface {

    use Authenticatable, CanResetPassword;

    /**
     * Active status of the user.
     */
    const STATUS_ACTIVE = 1;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['first_name','middle_name','last_name','username','email','password','avatar','status_id'];

    /**
 	 * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = ['password','remember_token'];

    /**
     * Defines a relationship with Post Model.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function posts(){
        return $this->hasMany('\App\Models\Post');
    }

    /**
     * Get active users.
     *
     * @param Builder $query
     * @return $this
     */
    public function scopeActive(Builder $query) {
        return $query->where('status_id','=',static::STATUS_ACTIVE);
    }

    /**
     * Return a created presenter.
     *
     * @return Robbo\Presenter\Presenter
     */
    public function getPresenter(){
        return new UserPresenter($this);
    }
}