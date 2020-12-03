<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Helper;

class HelperController extends ApiController
{
    public function connection()
    {
       return $this->sendResponse("connection is ok",["status"=>true]);   
    }
        public function timeStamp()
    {
       return $this->sendResponse("connection is ok",["timeStamp"=> Helper::firstOrdie()->timer_stamp]);   
    }
}
