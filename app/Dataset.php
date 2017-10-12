<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Dataset extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['description', 'target_name'];

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
