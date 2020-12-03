<?php

namespace App\Http\Controllers;
use App\User;
use App\Patient;
use App\Advice;
use App\Analysis;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class doctorController extends Controller
{
   /*
public function fetch_data(){

$Patients = Patient::where('doctor_id',Auth::user()->id)->get();
foreach($Patients as $Patient)
{   
 
$now = Carbon::now()->format('Y-m-d');
$Last_Advice = Advice::where(['patient_id'=>$Patient->id,'review_Date'=>$now] 
    )->first();

 $Last_Analyses = Analysis::where('patient_id',$Patient->id)
    ->where('created_at','>',$Last_Advice->created_at)->get();
   
    $Lst_Analyses = $Last_Analyses->toArray(); 
    $Lst_Advice = $Last_Advice->toArray();




    $data[]=['id'=>$Patient->id,'birth_date'=>$Patient->birth_date,
    'gender'=> $Patient->gender,
    'diabates_type'=>$Patient->diabates_type,
    'name'=>$Patient->name,'Lst_Advice'=>$Lst_Advice,
    'Lst_Analyses'=>$Lst_Analyses]; 
    return  view('doctor.Doctorhome')->with('data',$data); 

   
   // return dd($data,$now); 
}
    
}
*/
public function fetch_data(){

   $Patients = Patient::where('doctor_id',Auth::user()->id)->get();
   foreach($Patients as $Patient)
   {   
    
   $now = Carbon::now()->format('Y-m-d');
   $Last_Advice = Advice::where(['patient_id'=>$Patient->id,'review_Date'=>$now] 
       )->first();
       if ( !empty ( $Last_Advice ) ) {
    $Last_Analyses = Analysis::where('patient_id',$Patient->id)
       ->where('created_at','>',$Last_Advice->created_at)->get();
       $Lst_Analyses = $Last_Analyses->toArray(); 
       $Lst_Advice = $Last_Advice->toArray();
       $data[]=['id'=>$Patient->id,'birth_date'=>$Patient->birth_date,
       'gender'=> $Patient->gender,
       'diabates_type'=>$Patient->diabates_type,
       'name'=>$Patient->name,'Lst_Advice'=>$Lst_Advice,
       'Lst_Analyses'=>$Lst_Analyses]; 
       }
       $data[]=" ";
        return  view('doctor.Doctorhome')->with('data',$data); 
   
      
     // return dd($data,$now); 
   
   }
}
/*public function test_data(){
    $Patients = DB::table('patients')
    ->join('advices', 'users.id', '=', 'advices.user_id')
    ->join('analyses', 'users.id', '=', 'analyses.user_id')
    ->select('users.*', 'contacts.phone', 'orders.price')
    ->get();
       /* $Patients = Patient::where('doctor_id',Auth::user()->id)->get();
    $Advices = Advice::where('user_id',auth()->user()->id)->get();
*/
/*$data = DB::table('patients')->where('doctor_id',Auth::user()->id)
->join('advices','advices.patient_id','=','patients.id')
->join('analyses','analyses.patient_id','=','patients.id')
->select('patients.name','analyses.result','advices.prescription')
->get();
}*/
}
