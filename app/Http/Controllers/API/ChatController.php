<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Chat;
class ChatController extends ApiController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $allChats =  $request->user()->chats;

        foreach ($allChats as $k => $chat) {
            if ($chat->sender_id != $request->user()->id) {
                $chat['ismine'] = false;
            }else{
                $chat['ismine'] = true;
            }
            $chats[$k] = $chat;
        }
        return $this->sendResponse("User Chat Loaded Succefully", ['chats' => $chats]);
        
    }

    public function send(Request $request)
    {
        $chat = new Chat;

        $chat->patient_id = $request->user()->id;
        $chat->sender_id = $request->user()->id;
        $chat->user_id = $request->user()->doctor_id;
        $chat->message = $request->message;
        $chat->save();
        return $this->sendResponse("User Chat Loaded Succefully", ['chat' => $chat]);

        
    }


}
