<?php

namespace App\Http\Controllers\Admin;

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
        $patients = Patient::paginate(10);
        return view('admin.patients.index',compact('patients'));

        
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function show_move()
    {

            $doctors = User::where(['type'=>'doctor','state'=>'active'])->get();
            $patients = Patient::paginate(10);
            return view('admin.patients.move',compact('patients','doctors'));

        //}
    }

    public function move(Patient $patient,Request $request)
    {
        $patient->doctor_id = $request->doctor_id;
        $patient->save();
        return redirect()->route('admin.patients.move');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
      //  return view('admin.patients.add');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {           
        // $patient = $request->validate(Patient::validationRules());
        // $patient = Patient::create($patient);

        // $advice =  $request->validate(Advice::validationRules());
        // $advice = new Advice($advice);
        // $patient->advices()->save($advice);
        // return redirect()->route('admin.patients.index');
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
        return view('admin.patients.profile',compact('Patient','analyses','Advices'));

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
     //   $doctors = User::where(['type'=>'doctor','state'=>'active'])->get();
        return view('admin.patients.edit', compact('Patient'));
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
      return redirect()->route('admin.patients.index');
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
