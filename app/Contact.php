<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
    public function from_items()
    {
    	return $this->hasMany('App\Item', 'from_contact_id', 'id');
    }

    public function to_items()
    {
    	return $this->hasMany('App\Item', 'to_contact_id', 'id');
    }

    public function dataset()
    {
    	return $this->belongsTo('App\Dataset');
    }

}
