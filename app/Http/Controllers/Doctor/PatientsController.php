<?php

namespace App\Http\Controllers\Doctor;

use App\Patient;
use App\User;
use App\Analysis;
use App\Advice;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Controllers\Auth;

class PatientsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(auth()->user()->type == 'admin'){
            $patients = Patient::paginate(10);
            return view('doctor.Patient.index')->with('Patients',$Patients);
        }
        else{ 
            $patients = Patient::where('doctor_id',auth()->user()->id)->paginate(10);
            return view('doctor.patients.index')->with(['patients'=>$patients]);

        }
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function show_move()
    {
        // //dd('ok');
        // if(auth()->user()->type == 'admin'){
        //     $patients = Patient::paginate(10);
        //     return view('doctor.Patient.index')->with('Patients',$Patients);
        // }
        // else{ 
            $doctors = User::where('type', 'doctor')->get();
            $patients = Patient::where('doctor_id',auth()->user()->id)->paginate(10);
            return view('doctor.patients.move',compact('patients','doctors'));

        //}
    }

    public function move(Patient $patient,Request $request)
    {
        $patient->doctor_id = $request->doctor_id;
        $patient->save();
        return redirect()->route('doctor.patients.move');
        // ->with([
        //     'type' => 'success',
        //     'message' => ''
        // ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
      //  if(auth()->user()->type == 'doctor'){
        return view('doctor.patients.add');
//    }
}

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {           
        $patient = $request->validate(Patient::validationRules());
        $patient = Patient::create($patient);

        $advice =  $request->validate(Advice::validationRules());
        $advice = new Advice($advice);
        $patient->advices()->save($advice);
        return redirect()->route('doctor.patients.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Patient  $patient
     * @return \Illuminate\Http\Response
     */
    public function show(Patient $Patient)
    {
        $analyses = $Patient->analysis;
        $Advices = $Patient->advices;
        return view('doctor.patients.profile',compact('Patient','analyses','Advices'));

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Patient  $patient
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    { 
        $Patient = Patient::findOrFail($id);
        $doctors = User::where(['type'=>'doctor','state'=>'active'])->get();
        return view('doctor.patients.edit')->with(['Patient'=>$Patient , 'doctors'=>$doctors ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Patient  $patient
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {

        /*$validatedData = request()->validate(Patient::validationRules());

       */
        $validatedData = $request->validate([
           'name' => 'required|regex:/^[a-zA-Z\s]+$/u|max:255',
            'birth_date' => 'required|date',
            'gender'=> 'required',
            'diabetes_type' => 'required|numeric',
            'injury_year' => 'required|numeric',
            'phone' => 'required|numeric|unique:patients,phone,'.$id,
            'email' => 'required|email|unique:patients,email,'.$id,
            'state' => 'required',
            'heart_diseases ' => 'boolean|nullable',
            'hypertension'=> 'boolean|nullable',
            'bone_diseases'=> 'boolean|nullable',
            'autoimmune_disease'=> 'boolean|nullable',
            'Allergy_medicine' => 'required|regex:/(^[A-Za-z0-9 ]+$)+/',
            'surgery' => 'required|regex:/(^[A-Za-z0-9 ]+$)+/',
        ]);
        $patient = Patient::whereId($id)->update($validatedData);
      return redirect()->route('Patients.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Patient  $patient
     * @return \Illuminate\Http\Response
     */
    public function destroy(Patient $patient)
    {
        //
    }
}
