<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Post;

class PostsController extends Controller
{
    //
    public function index() {
        $data = [];
        if(\Auth::check()) {
            $user = \Auth::user();
            $posts = $user->feed_posts()->orderBy('created_at','desc')->paginate(10);
            
            $data = [
                'user' => $user,
                'posts' => $posts,
            ];
        }
        
        return view('welcome',$data);
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
