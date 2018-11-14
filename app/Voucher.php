<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

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
        return $this->hasMany('App\Redeem')->where('created_at', '>=', Carbon::now()->subDay());
    }
    
    public function tags(){
        return $this->hasMany('App\Tag');
    }
    
        

}
