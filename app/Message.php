<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    protected $table = "messages";

    protected $fillable = ['cell_phone','message', 'customer_id'];

    public function customer()
    {
    	return $this->belongsTo('App\Customer');
    }
}
