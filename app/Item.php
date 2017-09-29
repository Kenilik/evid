<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Scopes\SortItemsAscScope;

class Item extends Model
{
    /**
     * The "booting" method of the model.
     *
     * @return void
     */
    protected static function boot()
    {
        parent::boot();

        static::addGlobalScope(new SortItemsAscScope);
    }

    public function scopeOfType($query, $bGetMsg = true, $bGetCall = true)
    {
    	//get messages and calls 
    	if (($bGetMsg and $bGetCall) or (($bGetMsg == false) and ($bGetCall == false))) {
    		return $query;
    	//get messages
    	} elseif (($bGetMsg == true) and ($bGetCall == false)) {
    		return $query->where('item_type_id', '=', 1);
    	//get calls
    	} elseif (($bGetMsg == false) and ($bGetCall == true)) {
    		return $query->where('item_type_id', '=', 2);
        }
    }

	public function tags()
	{
		return Item::existingTags()->pluck('name');
	}

	public function dataset()
	{
		return $this->belongsTo('App\Dataset');
	}

	public function item_type()
	{
		return $this->belongsTo('App\ItemType');
	}

    public function from_contact()
    {
        return $this->belongsTo('App\Contact', 'from_contact_id', 'id');
    }

    public function to_contact()
    {
        return $this->belongsTo('App\Contact', 'to_contact_id', 'id');
    }
    
    public function comments()
    {
        return $this->hasMany('App\Comment');
    }

}
