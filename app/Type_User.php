<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Type_User extends Model
{
	use SoftDeletes;

	protected $table = "types_users";

    protected $fillable = ['name'];

    protected $dates = ['deleted_at'];
    
    public function users()
    {
    	return $this->hasMany('App\User');
    }
}
