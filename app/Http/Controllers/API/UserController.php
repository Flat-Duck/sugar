<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class UserController extends ApiController
{
    public function profile(Request $request)
    {
        // dd($request);
        return $this->sendResponse("User Data Loaded Succefully", ['user' => $request->user()]);
    }

    public function clinks(Test $test)
    {
    }
}
