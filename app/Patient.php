<?php

namespace App;
use App\User;

use Illuminate\Database\Eloquent\Model;
use Laravel\Passport\HasApiTokens;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Patient extends Authenticatable
{
    use HasApiTokens, Notifiable;

    protected $fillable = [
        'name','gender', 'password','birth_date', 'diabetes_type', 'injury_year', 'phone', 'email', 'weight', 'height', 'state','heart_diseases','hypertension','bone_diseases','autoimmune_disease','Allergy_medicine','surgery', 'doctor_id'
    ];

        /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public static function validationRules()
    {
        return [
           'name' => 'required|regex:/^[a-zA-Z\s]+$/u|max:255',
            'birth_date' => 'required|date',
            'gender'=> 'required',
            'diabetes_type' => 'required|numeric',
            'injury_year' => 'required|numeric',
            'phone' => 'required|numeric|unique:patients,phone',
            'email' => 'required|email|unique:patients,email',
            'state' => 'required',
            'heart_diseases ' => 'boolean|nullable',
            'hypertension' => 'boolean|nullable',
            'bone_diseases' => 'boolean|nullable',
            'autoimmune_disease' => 'boolean|nullable',
            'Allergy_medicine' => 'required',
            'surgery' => 'required',
        ];
    }

    public function doctor(){
        return $this->belongsTo('App\User');
    }
    public function analysis(){
        return $this->hasMany('App\Analysis');
    }
    public function advices(){
        return $this->hasMany('App\Advice');
    }
    public function chats(){
        return $this->hasMany('App\Chat');
    }


 
}
