<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class User_detail extends Model
{
    protected $fillable = ['user_id','father','mother'];

    public function user(){
    	return $this->belongsTo('App\User');
    }
}
