<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Post;
use App\User;
use Carbon\Carbon;
use RakutenRws_Client;
use Log;


class PostsController extends Controller
{
    //
    public function index() {
        $data = [];
        if(\Auth::check()) {
            $user = \Auth::user();
            $posts = $user->feed_posts()->orderBy('created_at','desc')->paginate(10);
            $favorites = $user->favorites()->paginate(10);
            
            //rakuten-api
            $client = new RakutenRws_Client();
        
            // define("RAKUTEN_APPLICATION_ID"     , config('app.rakuten_id'));
            //$client->setApplicationId(RAKUTEN_APPLICATION_ID);
            $client->setApplicationId(config('app.rakuten_id'));
            
            $response = $client->execute('IchibaItemSearch',array(
                'keyword' => '絵本 おすすめ',
                'hits' => '5',
                'imageFlag' => '1'
            ));
            
            $items = array();
            
            if ($response->isOk()) {
                //配列で結果をぶち込んで行きます
                foreach ($response as $item){
                    //画像サイズを変えたかったのでURLを整形します
                    $str = str_replace("_ex=128x128", "_ex=175x175", $item['mediumImageUrls'][0]['imageUrl']);
                    $items[] = array(
                        'itemName' => $item['itemName'],
                        'itemPrice' => $item['itemPrice'],
                        'itemUrl' => $item['itemUrl'],
                        'mediumImageUrls' => $str,
                        'siteIcon' => "../images/rakuten_logo.png",
                    );
                }
            }   else {
                    echo 'Error:'.$response->getMessage();
                    // /storage/logs/laravel.logの中にログを残す
                    Log::info('楽天APIエラー');
            }

            $data = [
                'user' => $user,
                'posts' => $posts,
                'favorites' => $favorites,
                'items' => $items,
            ];
        }
        
        return view('welcome',$data);
    }
    
    //comment表示のため
    public function show($id) {
        $post = Post::findOrFail($id);
        $user = User::findOrFail($post->user_id);
        $comments = $post->comment_users()->orderBy('pivot_id','desc')->paginate(10);
        
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
        
        if(\Auth::id() != $post->user_id) {
            return redirect('/');
        }
        
        return view('posts.edit', [
           'post' => $post, 
        ]);
    }
    
    
    public function update(Request $request, $id) {
        $post = Post::findOrFail($id);
        
        if(\Auth::id() != $post->user_id) {
            return redirect('/');
        }
        
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
