<?php

namespace App;

// Cannot seed this table when the class is defined as a Pivot
// uncomment the Model decls and comment out the pivot decls 
// then swap back after running migrations and seeding

//use Illuminate\Database\Eloquent\Model;
//class InvUser extends Model

use Illuminate\Database\Eloquent\Relations\Pivot;
class InvUser extends Pivot
{
    protected $table = 'inv_users';
}
