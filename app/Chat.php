<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Chat extends Model
{
    
    public function doctor(){
        return $this->belongsTo('App\User','user_id');
    }


    public function patient(){
        return $this->belongsTo('App\Patient');
    }
}
