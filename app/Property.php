<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Property extends Model
{
    protected $table = "properties";

    protected $fillable = [
    	'admission_date', 'sale_price', 'offer_price', 'comission', 'financing', 'building', 
    	'piso', 'no_dpto', 'referencies', 'antiquily', 'legal_document', 'avaluo', 'delivery_time',
    	'additional_inf', 'bedrooms', 'kitchens', 'bathrooms', 'livingrooms', 'garages', 'asensors',
    	'suite', 'pantry', 'deskrooms', 'servicesrooms', 'storages', 'others', 'surface_area',
    	'surface_builder', 'street','maps', 'zone_id', 'category_id', 'type_property_id', 'owner_current_id', 
    	'user_id', 'state_id'
    ];

    public function category()
    {
    	return $this->belongsTo('App\Category');
    }

    public function zone()
    {
    	return $this->belongsTo('App\Zone');
    }

    public function type_property()
    {
    	return $this->belongsTo('App\Type_Property');
    }

    public function owner_current()
    {
    	return $this->belongsTo('App\Owner_Current');
    }

    public function user()
    {
    	return $this->belongsTo('App\User');
    }

    public function state()
    {
        return $this->belongsTo('App\State');
    }

    public function images()
    {
    	return $this->hasMany('App\Image');
    }

    public function customers()
    {
    	return $this->belongsToMany('App\Customer')->withTimestamps();
    }
}
