<?php namespace App\Models;

use App\Acl\HasRoles;
use App\Presenters\UserPresenter;
use Illuminate\Auth\Authenticatable;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Robbo\Presenter\PresentableInterface;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Foundation\Auth\Access\Authorizable;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\Access\Authorizable as AuthorizableContract;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;

class User extends Model implements AuthenticatableContract,
                                    CanResetPasswordContract,
                                    AuthorizableContract,
                                    PresentableInterface {

    use Authenticatable, CanResetPassword, Authorizable, HasRoles;

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
     * Defines a relationship with Role model.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function roles() {
        return $this->belongsToMany('\App\Models\Role','user_role');
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
     * Check if the logged in user is this user.
     *
     * @return bool
     */
    public function isLoggedIn() {
        return (Auth::check() && $this->id == Auth::user()->id);
    }

    /**
     * Checks if the current user is active.
     *
     * @return bool
     */
    public function isActive() {
        return $this->status_id == self::STATUS_ACTIVE;
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