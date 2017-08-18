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
    	'suite', 'pantry', 'deskrooms', 'servicesrooms', 'storages', 'others','description', 'surface_area',
    	'surface_builder', 'street','lat_map','lng_map', 'zone_id', 'category_id', 'type_property_id', 'owner_current_id', 
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

    public function scopeBusquedaPrecio($query, $precio)
    {
        return $query->where('sale_price', 'LIKE',  "%$precio%");
    }

    public function scopeBusquedaZona($query, $zona)
    {
        if ($zona == '') {
            return $query->where('zone_id','LIKE',"%$zona%");
        }
        return $query->where('zone_id', '=',  $zona);
    }
         
    public function scopeBusquedaCategoria($query, $category)
    {
        return $query->where('category_id', 'LIKE',  "%$category%");
    }

    public function scopeBusquedaTipo($query, $type)
    {
        return $query->where('type_property_id', 'LIKE',  "%$type%");
    }
    public function scopeBusquedaPrecio2($query, $precio1, $precio2)
    {
        if($precio1 == '' && $precio2=='')
        {
            return $query->whereBetween('sale_price', ['1', '1000000000']);
        }
        return $query->whereBetween('sale_price', [$precio1, $precio2]);
    }
     public function scopeBusquedaState($query, $type)
    {
        return $query->where('state_id', 'LIKE',  "%$type%");
    }
}
