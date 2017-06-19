<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    protected $table = "customers";

    protected $fillable = ['first_name', 'last_name', 'phone', 'cell_phone', 'email'];

    public function properties()
    {
    	return $this->belongsToMany('App\Property')->withTimestamps();
    }

    public function messages()
    {
    	return $this->hasMany('App\Message');
    }
}
