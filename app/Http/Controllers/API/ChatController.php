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
        $chat->user_id = "1";
        $chat->message = $request->message;
        $chat->save();
        return $this->sendResponse("User Chat Loaded Succefully", ['chat' => $chat]);

        
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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
