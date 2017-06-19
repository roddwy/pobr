<?php

namespace App;

use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Foundation\Auth\Access\Authorizable;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\Access\Authorizable as AuthorizableContract;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;

use Illuminate\Database\Eloquent\SoftDeletes;

class User extends Model implements AuthenticatableContract,
                                    AuthorizableContract,
                                    CanResetPasswordContract
{
    use Authenticatable, Authorizable, CanResetPassword;

    /**
     * The database table used by the model.
     *
     * @var string
     */

    use SoftDeletes;

    protected $table = 'users';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['first_name','last_name','ci', 'phone', 'cell_phone', 'email', 'password','type_user_id'];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = ['password', 'remember_token'];

    protected $dates = ['deleted_at'];

    public function type_user()
    {
        return $this->belongsTo('App\type_user');
    }

    public function owner_current()
    {
        return $this->hasMany('App\Owner_Current');
    }

    public function zones()
    {
        return $this->hasMany('App\Zone');
    }

    public function categories()
    {
        return $this->hasMany('App\Category');
    }

    public function types_property()
    {
        return $this->hasMany('App\Type_Property');
    }

    public function states()
    {
        return $this->hasMany('App\State');
    }

    public function properties()
    {
        return $this->hasMany('App\Property');
    }
}
