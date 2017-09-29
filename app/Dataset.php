<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Dataset extends Model
{
    public function items()
    {
    	return $this->hasMany('App\Item');
    }

    public function contacts()
    {
    	return $this->hasMany('App\Contact');
    }

    public function investigation()
    {
    	return $this->belongsTo('App\Investigation');
    }
    
}
