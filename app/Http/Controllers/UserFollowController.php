<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UserFollowController extends Controller
{
    //Userをフォローする
    public function store($id) {
        \Auth::user()->follow($id);
        return back();
    }
    
    //Userのフォローを外す
    public function destroy($id) {
        \Auth::user()->unfollow($id);
        return back();
    }
}
