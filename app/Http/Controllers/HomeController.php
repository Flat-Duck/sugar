<?php

namespace App\Http\Controllers;

use App\Patient;
use App\User;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {   
        $All_user =  User::where('type','admin')->count();
        $user_active = User::where(['state'=>'active','type'=>'admin'])->count();
        $user_unactive = User::where(['state'=>'unactive','type'=>'admin'])->count();

        $All_doctor = User::where('type','doctor')->count();
        $doctor_active =  User::where(['state'=>'active','type'=>'doctor'])->count();
        $doctor_unactive =  User::where(['state'=>'unactive','type'=>'doctor'])->count();

        $All_Patient = Patient::count();
        $patient_active = Patient::where('state','active')->count();
        $patient_unactive = Patient::where('state','unactive')->count();



        $data[] = ['u_all'=>$All_user,
                   'u_active'=>$user_active ,
                   'u_unactive'=>$user_unactive,
                   'd_all'=>$All_doctor,
                   'd_active'=>$doctor_active,
                   'd_unactive'=>$doctor_unactive,
                   'p_all'=>$All_Patient,
                   'p_active'=>$patient_active,
                   'p_unactive'=>$patient_unactive,
   ];
      return view('home')->with('data',$data);
       //  return dd($data);
    }
}
