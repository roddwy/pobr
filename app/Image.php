<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Image extends Model
{
    protected $table = "images";

    protected $fillable = ['name', 'property_id'];

    public function property()
    {
    	return $this->belongsTo('App\Property');
    }
}
