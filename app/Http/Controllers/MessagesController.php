<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Message;
use App\User;
use Carbon\Carbon;


class MessagesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
        $send_user = \Auth::user();
        $user = User::findOrFail($id);
        $messages = Message::
        where('send_user_id','=',$send_user->id)
        ->where('receive_user_id','=',$id)
        ->orWhere('send_user_id','=',$id)
        ->where('receive_user_id','=',$send_user->id)
        ->get();
        

        //生後の計算
        $birthDay = Carbon::createFromDate($user->birthday);
        $age      = $birthDay->diff(Carbon::now())->format('%y 歳 %m ヵ月');

        
        return view('messages.messages' ,[
           'messages' => $messages,
           'send_user' => $send_user,
           'user' => $user,
           'age' => $age,
        ]);
    }
    

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \IlluminateHttp\Response
     */
    public function store(Request $request,$id)
    {
        //
        $content = $request->content;
        \Auth::user()->send_message($id,['content' => $content]);
        
        return back();
        
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
        $message = Message::findOrFail($id);
        if(\Auth::id() == $message->send_user_id) {
            $message->delete();
        }
        return back();

    }
}
