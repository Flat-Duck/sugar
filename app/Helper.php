<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Helper extends Model //implements HasMedia
{
  //  use SoftDeletes, HasMediaTrait;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'time_stamp','tag'
    ];

}
