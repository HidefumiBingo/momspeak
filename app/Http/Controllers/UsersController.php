<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

use App\User;

use Carbon\Carbon;


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
        
        //生後の計算
        $birthDay = Carbon::createFromDate($user->birthday);
        $age      = $birthDay->diff(Carbon::now())->format('%y 歳 %m ヵ月');

        //関係するモデルの件数をロード
        $user->loadRelationshipCounts();
        
        //ユーザの投稿一覧を取得
        $posts = $user->posts()->orderBy('created_at','desc')->paginate(10);
        $favorites = $user->favorites()->paginate(10);

        return view('users.show', [
            'user' => $user, 
            'posts' => $posts,
            'favorites' => $favorites,
            'age' => $age,
        ]);
    }
    
    public function edit($id) {
        $user = User::findOrFail($id);
        return view('users.edit', [
            'user' => $user,    
        ]);
    }
    
    public function update(Request $request, $id) {
        $user = User::findOrFail($id);
        
        $birthday = $request['birthday_year'].'-'.$request['birthday_month'].'-'.'01';
        
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = Hash::make($request['password']);
        $user->type = $request->type;
        $user->birthday = $birthday;
        $user->content = $request->content;
        $user->save();
        
        return redirect('/');
    }
    
    
    
    
    
    public function followings($id) {
        $user = User::findOrFail($id);
        
        //生後の計算
        $birthDay = Carbon::createFromDate($user->birthday);
        $age      = $birthDay->diff(Carbon::now())->format('%y 歳 %m ヵ月');


        $posts = $user->posts()->orderBy('created_at','desc')->paginate(10);
        $favorites = $user->favorites()->paginate(10);
        
        $user->loadRelationshipCounts();
        
        $followings = $user->followings()->paginate(10);

        return view('users.followings',[
            'user' => $user,
            'users' => $followings,
            'posts' => $posts,
            'favorites' => $favorites,
            'age' => $age,
        ]);
    }
    
    public function followers($id) {
        $user = User::findOrFail($id);
        
        //生後の計算
        $birthDay = Carbon::createFromDate($user->birthday);
        $age      = $birthDay->diff(Carbon::now())->format('%y 歳 %m ヵ月');

        
        $posts = $user->posts()->orderBy('created_at','desc')->paginate(10);
        $favorites = $user->favorites()->paginate(10);

        
        $user->loadRelationshipCounts();
        
        $followers = $user->followers()->paginate(10);
        
        return view('users.followers', [
            'user' => $user,
            'users' => $followers,
            'posts' => $posts,
            'favorites' => $favorites,
            'age' => $age,
        ]);
    }
    
    public function userslist($id) {
        $user = User::findOrFail($id);
        
        //生後の計算
        $birthDay = Carbon::createFromDate($user->birthday);
        $age      = $birthDay->diff(Carbon::now())->format('%y 歳 %m ヵ月');

        
        $posts = $user->posts()->orderBy('created_at','desc')->paginate(10);
        $favorites = $user->favorites()->paginate(10);

        
        $user->loadRelationshipCounts();

        $users = User::orderBy('id','desc')->paginate(10);
        
        return view('users.userslist', [
            'user' => $user,
            'posts' => $posts,
            'favorites' => $favorites,
            'users' => $users,
            'age' => $age,
        ]);
    }
    
    
    public function favorites($id) {
        $user = User::findOrFail($id);
        $posts = $user->posts()->orderBy('created_at','desc')->paginate(10);
        $favorites = $user->favorites()->paginate(10);

        return view('users.favorites', [
            'user' => $user,
            'posts' => $posts,
            'favorites' => $favorites,
        ]);
    }
}
