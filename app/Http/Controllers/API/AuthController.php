<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
// use App\User;
use Auth;

class AuthController extends ApiController
{
    

    public function login(Request $request)
    {
        $login = $request->validate([
            'phone'=>'required|numeric',
            'password' =>'required|string'
        ]);
       // (Auth::guard('admin')->attempt($credentials)
        if(!Auth::guard('patients')->attempt($login)){
            return $this->sendError('not Authrized','Invalid login Data',200);
        }
        $token = Auth::guard('patients')->user()->createToken('AuthToken')->accessToken;
        return $this->sendResponse("Login Succefull",['accessToken'=>$token]);   

    }
}
