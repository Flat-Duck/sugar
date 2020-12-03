<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password','type',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public static function validationRules()
    {
        return [
            'name' => 'required|string',
            'email' => 'required',
            'state' => 'required',
        ];
    }

    public function patient(){
        return $this->hasMany('App\Patient');
    }

    public function advice(){
        return $this->hasMany('App\Advice');
    }
    public function approve()
    {
        $this->state = "active";
        $this->save();
    }
    public function unapprove()
    {
        $this->state = "unactive";
        $this->save();
    }
}
      