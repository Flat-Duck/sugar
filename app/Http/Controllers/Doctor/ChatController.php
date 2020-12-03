<?php

namespace App\Http\Controllers\Doctor;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Chat;
use App\Patient;
class ChatController extends Controller
{
    
    public function index()
    {
      $chats =  Chat::where('user_id',auth()->user()->id)->get();
      $patients = collect(new Patient);
      foreach ($chats as $k => $chat) {
          $patient = $chat->patient;
          if (!$patients->contains($patient)) {
              $patients->add($patient);
          }
      }

        return view('doctor.chats.index',compact('patients'));
    }
    public function show(Patient $patient)
    {
      $allChats =  Chat::where(['user_id'=>auth()->user()->id,'patient_id'=>$patient->id])->get();
      
      foreach ($allChats as $k => $chat) {
        if ($chat->sender_id != auth()->user()->id) {
            $chat['ismine'] = false;
        }else{
            $chat['ismine'] = true;
        }
        $chats[$k] = $chat;
    }
        return view('doctor.chats.show',compact('chats'));
    }

    public function send(Patient $patient)
    {
        $chat = new Chat();
        $chat->user_id = auth()->user()->id;
        $chat->sender_id = auth()->user()->id;
        $chat->patient_id = $patient->id;
        $chat->message = request()->message;
        $chat->save();

    
        return redirect()->route('doctor.chats.show',['patient'=>$patient->id]);
    }

}
