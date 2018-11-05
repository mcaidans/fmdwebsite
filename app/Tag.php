<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    protected $table = 'tags';
    
    public static $rules = array(
        'name' => 'required',
        'voucher_id' => 'required'
    );
    
    protected $fillable = [
        'name', 'voucher_id'
    ];
    
    public function voucher(){
        return $this->hasOne('App\Voucher');   
    }
}
