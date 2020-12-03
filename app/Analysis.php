<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Analysis extends Model
{

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'glycemia', 'patient_id', 'period','date_time',
    ];

    protected $table = "analyses";
    
    public function patient()
    {
        return $this->belongsTo('App\Patient');
    }
}
