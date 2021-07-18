<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\User;

class UsersController extends Controller
{
    //
    public function index() {
        $users = User::orderBy('id','desc')->paginate(10);
        
        return view('users.index',[
            'users' => $users,
        ]);
    }
    
    public function show($id) {
        $user = User::findOrFail($id);
        
        //関係するモデルの件数をロード
        $user->loadRelationshipCounts();
        
        //ユーザの投稿一覧を取得
        $posts = $user->posts()->orderBy('created_at','desc')->paginate(10);
        
        return view('users.show', [
            'user' => $user, 
            'posts' => $posts,
        ]);
    }
    
    
    public function followings($id) {
        $user = User::findOrFail($id);

        $posts = $user->posts()->orderBy('created_at','desc')->paginate(10);
        
        $user->loadRelationshipCounts();
        
        $followings = $user->followings()->paginate(10);
        
        return view('users.followings',[
            'user' => $user,
            'users' => $followings,
            'posts' => $posts,
        ]);
    }
    
    public function followers($id) {
        $user = User::findOrFail($id);
        
        $posts = $user->posts()->orderBy('created_at','desc')->paginate(10);

        
        $user->loadRelationshipCounts();
        
        $followers = $user->followers()->paginate(10);
        
        return view('users.followers', [
            'user' => $user,
            'users' => $followers,
            'posts' => $posts,
        ]);
    }
    
    public function userslist($id) {
        $user = User::findOrFail($id);
        
        $posts = $user->posts()->orderBy('created_at','desc')->paginate(10);
        
        $user->loadRelationshipCounts();

        $users = User::orderBy('id','desc')->paginate(10);
        
        return view('users.userslist', [
            'user' => $user,
            'posts' => $posts,
            'users' => $users,
        ]);

    }
}
