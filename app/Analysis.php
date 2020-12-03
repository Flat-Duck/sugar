<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Analysis extends Model
{
    protected $table = "analyses";
    
   public function patient(){
       return $this->belongsTo('App\Patient');
   }
}
