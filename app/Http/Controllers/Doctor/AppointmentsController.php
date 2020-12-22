<?php

namespace App\Http\Controllers\doctor;

use App\Patient;
use App\User;
use App\Chat;
use App\Analysis;
use App\Advice;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Controllers\Auth;
use Carbon\Carbon;

class AppointmentsController extends Controller
{
    public function index()
    {
        $advices = Advice::whereDate('review_Date', Carbon::today())->where(['old'=>0,'user_id'=>auth()->user()->id])->get();
        $patients = collect();
        foreach ($advices as $k => $advice) {
            $patients->add($advice->patient);
        }
        return view('doctor.appointments.index',compact('patients'));
    }

    public function add(Patient $patient,Request $request)
    {
        $analyses = $patient->analysis;

        //dd($analyses);
        $advices = $patient->advices;
        return view('doctor.appointments.add',compact('patient','analyses','advices'));
    }

    public function store(Patient $patient,Request $request)
    {
        $advice =  $request->validate(Advice::validationRules());
        $advice = new Advice($advice);
        
        $chat = new Chat();

        $chat->user_id = auth()->user()->id;
        $chat->sender_id = auth()->user()->id;
        $chat->patient_id = $patient->id;
        $chat->message = $advice->prescription;
        $chat->save();


        $patient->advices()->update(['old' =>true]);
        $patient->advices()->save($advice);

        return redirect()->route('doctor.appointments.index');
    }
}

