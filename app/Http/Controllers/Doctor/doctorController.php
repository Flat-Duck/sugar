<?php

namespace App\Http\Controllers\Doctor;
use App\User;
use App\Admin;
use App\Patient;
use App\Advice;
use App\Analysis;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class doctorController extends Controller
{
    /**
     * Displays the dashboard page to the admin
     *
     * @return \Illuminate\Http\Response
     */
    public function dashboard()
    {
        return redirect()->route('doctor.patients.index');
    }

    /**
     * Displays the profile page to the admin
     *
     * @return \Illuminate\Http\Response
     */
    public function profile()
    {
        $admin = Auth::user();

        return view('doctor.profile', compact('admin'));
    }

    /**
     * Updates admin profile details
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function profileUpdate()
    {
        $validatedData = request()->validate(Admin::profileValidationRules());

        $admin = Auth::user();

        $admin->update($validatedData);

        return back()->with(['type' => 'success', 'message' => 'Profile updated successfully']);
    }

    /**
     * Updates admin password
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function passwordUpdate()
    {
        $validatedData = request()->validate(Admin::passwordValidationRules());

        $admin = Auth::user();

        if (Hash::check(request('current_password'), $admin->password)) {
            $admin->password = bcrypt(request('password'));
            $admin->save();

            return back()->with(['type' => 'success', 'message' => 'Password updated successfully']);
        }

        return back()->with(['type' => 'error', 'message' => 'Incorrect current password']);
    }

//    public function dashboard()
//    {
//       dd('ok');
//    }
//    /*
// public function fetch_data(){

// $Patients = Patient::where('doctor_id',Auth::user()->id)->get();
// foreach($Patients as $Patient)
// {   
 
// $now = Carbon::now()->format('Y-m-d');
// $Last_Advice = Advice::where(['patient_id'=>$Patient->id,'review_Date'=>$now] 
//     )->first();

//  $Last_Analyses = Analysis::where('patient_id',$Patient->id)
//     ->where('created_at','>',$Last_Advice->created_at)->get();
   
//     $Lst_Analyses = $Last_Analyses->toArray(); 
//     $Lst_Advice = $Last_Advice->toArray();




//     $data[]=['id'=>$Patient->id,'birth_date'=>$Patient->birth_date,
//     'gender'=> $Patient->gender,
//     'diabates_type'=>$Patient->diabates_type,
//     'name'=>$Patient->name,'Lst_Advice'=>$Lst_Advice,
//     'Lst_Analyses'=>$Lst_Analyses]; 
//     return  view('doctor.Doctorhome')->with('data',$data); 

   
//    // return dd($data,$now); 
// }
    
// }
// */
// public function fetch_data(){

//    $Patients = Patient::where('doctor_id',Auth::user()->id)->get();
//    foreach($Patients as $Patient)
//    {   
    
//    $now = Carbon::now()->format('Y-m-d');
//    $Last_Advice = Advice::where(['patient_id'=>$Patient->id,'review_Date'=>$now] 
//        )->first();
//        if ( !empty ( $Last_Advice ) ) {
//     $Last_Analyses = Analysis::where('patient_id',$Patient->id)
//        ->where('created_at','>',$Last_Advice->created_at)->get();
//        $Lst_Analyses = $Last_Analyses->toArray(); 
//        $Lst_Advice = $Last_Advice->toArray();
//        $data[]=['id'=>$Patient->id,'birth_date'=>$Patient->birth_date,
//        'gender'=> $Patient->gender,
//        'diabates_type'=>$Patient->diabates_type,
//        'name'=>$Patient->name,'Lst_Advice'=>$Lst_Advice,
//        'Lst_Analyses'=>$Lst_Analyses]; 
//        }
//        $data[]=" ";
//         return  view('doctor.Doctorhome')->with('data',$data); 
   
      
//      // return dd($data,$now); 
   
//    }
// }
// /*public function test_data(){
//     $Patients = DB::table('patients')
//     ->join('advices', 'users.id', '=', 'advices.user_id')
//     ->join('analyses', 'users.id', '=', 'analyses.user_id')
//     ->select('users.*', 'contacts.phone', 'orders.price')
//     ->get();
//        /* $Patients = Patient::where('doctor_id',Auth::user()->id)->get();
//     $Advices = Advice::where('user_id',auth()->user()->id)->get();
// */
// /*$data = DB::table('patients')->where('doctor_id',Auth::user()->id)
// ->join('advices','advices.patient_id','=','patients.id')
// ->join('analyses','analyses.patient_id','=','patients.id')
// ->select('patients.name','analyses.result','advices.prescription')
// ->get();
// }*/
}
