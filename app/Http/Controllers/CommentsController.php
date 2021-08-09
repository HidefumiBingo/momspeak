<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Post;
use App\User;
use App\Comment;

class CommentsController extends Controller
{
    //
    
    
    public function edit($id) {
        $comment = Comment::findOrFail($id);
        $post = Post::findOrFail($comment->post_id);
        $user = User::findOrFail($post->user_id);
        
        if(\Auth::id() != $comment->user_id) {
            return redirect('/');
        }

        return view('comments.edit', [
            'comment' => $comment, 
            'user' => $user,
        ]);
    }
    
    public function update(Request $request, $id) {
        $comment = Comment::findOrFail($id);
        
        if(\Auth::id() != $comment->user_id) {
            return redirect('/');
        }

        $comment->content = $request->content;
        $comment->save();

        return redirect('/posts/'.$comment->post_id);
    }

    
    //コメントする
    public function store(Request $request,$id) {
        $content = $request->content;
        \Auth::user()->comment($id, ['content' => $content]);
        return redirect('/posts/'.$id);
    }
    
    // コメントを削除する
    public function destroy($id) {
        $comment = Comment::findOrFail($id);
        if(\Auth::id() == $comment->user_id) {
            $comment->delete();
        }
        return back();
    }

}
