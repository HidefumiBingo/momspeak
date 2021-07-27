<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Post;
use App\User;
use Carbon\Carbon;


class PostsController extends Controller
{
    //
    public function index() {
        $data = [];
        if(\Auth::check()) {
            $user = \Auth::user();
            $posts = $user->feed_posts()->orderBy('created_at','desc')->paginate(10);
            $favorites = $user->favorites()->paginate(10);

            $data = [
                'user' => $user,
                'posts' => $posts,
                'favorites' => $favorites,
            ];
        }
        
        return view('welcome',$data);
    }
    
    //comment表示のため
    public function show($id) {
        $post = Post::findOrFail($id);
        $user = User::findOrFail($post->user_id);
        $comments = $post->comment_users()->orderBy('pivot_id','desc')->paginate(10);
        
        $userId = \DB::table('comments')->where('post_id',$post->id);

        //生後の計算
        $birthDay = Carbon::createFromDate($user->birthday);
        $age      = $birthDay->diff(Carbon::now())->format('%y 歳 %m ヵ月');

        return view('posts.show', [
            'user' => $user,
            'post' => $post, 
            'age' => $age,
            'comments' => $comments,
        ]); 
    }
    
    public function edit($id) {
        $post = Post::findOrFail($id);
        
        return view('posts.edit', [
           'post' => $post, 
        ]);
    }
    
    
    public function update(Request $request, $id) {
        $post = Post::findOrFail($id);
        
        $post->content = $request->content;
        $post->save();
        
        return redirect('/users/'.$post->user_id.'/userslist');
    }
    
    public function store(Request $request) {
        //バリデーション
        $request->validate([
            'content' => 'required|max:255',    
        ]);
        
        //認証済みユーザの投稿を作成
        $request->user()->posts()->create([
            'content' => $request->content,    
        ]);
        
        return back();
    }
    
    
    public function destroy($id) {
        //idで投稿を検索
        $post = Post::findOrFail($id);
        
        if(\Auth::id() === $post->user_id) {
            $post->delete();
        }
        
        return back();
    }
}
