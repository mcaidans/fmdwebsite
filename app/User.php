<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Carbon\Carbon;

class User extends Authenticatable
{
    use Notifiable;
    

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'receive_email',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token', 'admin',
    ];
    
   public function redeems(){
   
        return $this->hasMany('App\Redeem', 'user_id');
        
        /*->where([
            //['created_at', '>=', Carbon::now()->subHours(12)],
            ['user_id', '==', $this->id]
            ]));*/
    }
    
    public function isAdmin(){
        if($this->admin == '1')
            return true;
        else
            return false; 
    }
    
}
