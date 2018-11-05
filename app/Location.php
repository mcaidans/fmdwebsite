<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Location extends Model
{
    protected $table = 'locations';
    
    public static $rules = array(
        'name' => 'required'
    );
    
    protected $fillable = [
        'name'
    ];

}
