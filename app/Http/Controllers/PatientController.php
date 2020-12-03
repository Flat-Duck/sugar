<?php

namespace App\Http\Controllers;

use App\Patient;
use App\User;
use App\Analysis;
use App\Advice;
use Illuminate\Http\Request;
use App\Http\Controllers\Auth;

class PatientController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(auth()->user()->type == 'admin'){
            $Patients = Patient::paginate(10);
            return view('admin.Patient.index')->with('Patients',$Patients);
        }
        else{ 
            $Patients = Patient::where('doctor_id',auth()->user()->id)->paginate(10);
            return view('doctor.Patient.index')->with(['Patients'=>$Patients]);

        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
      //  if(auth()->user()->type == 'doctor'){
        return view('doctor.Patient.add');
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
        $this->validate($request,Patient::validationRules());
        $patient = new Patient();
        $patient->name= $request->input('name');
        $patient->password= bcrypt('000000');
        $patient->birth_date= $request->input('birth_date');
        $patient->gender= $request->input('gender');
        $patient->diabetes_type= $request->input('diabetes_type');
        $patient->injury_year= $request->input('injury_year');
        $patient->phone =  $request->input('phone');
        $patient->email= $request->input('email');
        $patient->weight=55.500;
        $patient->height= 1.66;
        $patient->state= $request->input('state');
        $patient->chronic_diseases=$request->input('chronic_diseases');
        $patient->Allergy_medicine=$request->input('Allergy_medicine');
        $patient->surgery =$request->input('surgery');
        $patient->doctor_id = auth()->user()->id;
        $patient->save();
        return redirect()->route('Patients.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Patient  $patient
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $Patient = Patient::findOrFail($id);
        $Analyses = Analysis::where('patient_id',$id)->get();
        $Advices = Advice::where('patient_id', $id)->get();
        return view('doctor.Patient.profile')->with(['Patient'=>$Patient,'Analyses'=>$Analyses,'Advices'=>$Advices]);

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
        return view('admin.Patient.edit')->with(['Patient'=>$Patient , 'doctors'=>$doctors ]);
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
            /* 'name' => 'required|alpha_|max:55',*/
            'birth_date' => 'required|date',
            'gender'=> 'required',
            'diabetes_type' => 'required|numeric',
            'injury_year' => 'required|numeric',
            'phone' => 'required|numeric|unique:patients,phone,'.$id,
            'email' => 'required|email|unique:patients,email,'.$id,
            'state' => 'required',
            'chronic_diseases'=>'required',
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
