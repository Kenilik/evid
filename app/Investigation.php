<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Investigation extends Model
{
    public function users()
    {
    	return $this->belongsToMany('App\User')->using('App\InvUser')->withTimestamps();
    }
    
    public function items()
    {
    	return $this->hasManyThrough('App\Item','App\Dataset');//, 'investigation_id', 'dataset_id', 'id', 'id');
    }

    public function contacts()
    {
        return $this->hasManyThrough('App\Contact','App\Dataset');//, 'contact_id', 'dataset_id', 'id', 'id');
    }

	public function datasets()
	{
		return $this->hasMany('App\Dataset');
	}

}
