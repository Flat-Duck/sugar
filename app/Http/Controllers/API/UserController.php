<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Analysis;
class UserController extends ApiController
{
    public function profile(Request $request)
    {
        return $this->sendResponse("User Data Loaded Succefully", ['user' => $request->user()]);
    }

    public function updateProfile(Request $request)
    {            
        $patient = $request->user();
        request()->merge(['password'=>bcrypt($request->pass)]);
        $data = $request->validate($this->val());
        $patient->update($data);

        return $this->sendResponse("User Data Updated Succefully", ['user' => $request->user()]);
   }

   public function val()
   {
       return [
           'weight' => 'required|numeric',
           'height' => 'required|numeric',
           'password'=> 'required',
        ];
   }

   public function syncData(Request $request)
   {
    $patient = $request->user();
    
       foreach ($request->analysis as $k => $hi) {
        $topic = new Analysis($hi);
        $patient->analysis()->save($topic);
       }

    //   // dd($topic);
    //    $analysis = $request->analysis;
    //   $patient = $request->user();
    //    $patient->analysis()->saveMany($analysis);
       return $this->sendResponse("User Data Synced Succefully", ['user' => $request->user()]);
       
   }
}
