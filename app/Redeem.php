<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Redeem extends Model
{
    protected $table = 'redeems';
    protected $connection = 'mysql';
    
    public static $rules = array(
        'user_id' => 'required',
        'voucher_id' => 'required'
    );
    
    protected $fillable = [
        'user_id', 'voucher_id'
    ];
    
    public function voucher(){
        return $this->belongsTo('App\Voucher');
    }

    
    public function user(){
        return $this->belongsTo('App\User');   
    }
}
