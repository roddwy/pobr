<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Category extends Model
{
    use SoftDeletes;

    protected $table = "categories";

    protected $fillable = ['name','user_id'];

    protected $dates = ['deleted_at']; 

    public function user()
    {
    	return $this->belongsTo('App\User');
    }

    public function properties()
    {
    	return $this->hasMany('App\Property');
    }
}
