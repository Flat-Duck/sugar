<?php

namespace App\Http\Controllers;

use App\Advice;
use Illuminate\Http\Request;

class AdviceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {  
        $Advices = Advice::where('user_id', auth()->user()->id )->paginate(5);
        return view('admin.user.doctorAdvice')->with('Advices',$Advices);


        
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if(auth()->user()->type == 'doctor'){
            $this->validate($request,Advice::validationRules());
            $advice = new Advice();
            $advice->user_id =auth()->user()->id;
            $advice->patient_id = 1;
            $advice->prescription=$request->input('prescription');
            $advice->review_Date= $request->input('review_Date');
            $advice->save();

        }
        

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Advice  $advice
     * @return \Illuminate\Http\Response
     */
    public function show(Advice $advice)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Advice  $advice
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $advice = Advice::findOrFail($id);
        return view('admin.user.editAdvice')->with('advice',$advice);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Advice  $advice
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $validatedData = request()->validate(Advice::validationRules());
        $advice = Advice::whereId($id)->update($validatedData);
      return redirect()->route('advice.index');

        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Advice  $advice
     * @return \Illuminate\Http\Response
     */
    public function destroy(Advice $advice)
    {
        //
    }
}
