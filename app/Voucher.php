<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Voucher extends Model
{
    protected $table = 'vouchers';
    
    public static $rules = array(
        'name' => 'required|max:255',
        'image' => 'required|image'
    );
    
    protected $fillable = [
        'name', 'image_location'
    ];
    
    public function redeems(){
        return $this->hasMany('App\Redeem');   
    }
    
    public function tags(){
        return $this->hasMany('App\Tag');
    }
}
