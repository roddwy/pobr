<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use Illuminate\Database\Eloquent\SoftDeletes;

class Owner_Current extends Model
{
    use SoftDeletes;

    protected $table = "owners_currents";

    protected $fillable = ['first_name', 'last_name', 'phone', 'cell_phone', 'email', 'availability', 'user_id','owner_current_id'];

    protected $dates = ['deleted_at'];
    
    public function user()
    {
    	return $this->belongsTo('App\User');
    }

    public function properties()
    {
    	return $this->hasMany('App\Property','owner_current_id');
    }

    public function scopeSearchPhoneCell($query, $phone)
    {
        return $query->where('cell_phone', 'LIKE', "%$phone%")->orWhere('phone','LIKE',"%$phone%")->whereNull('deleted_at');
    }
    public function scopeSearchPhoneCellAsesor($query, $phone)
    {
        return $query->where('user_id', '=', \Auth::user()->id)->Where('cell_phone','LIKE',"%$phone%")->whereNull('deleted_at');
    }
}
