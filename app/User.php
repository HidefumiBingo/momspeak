<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

use Carbon\Carbon;


class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
        //追加
        'type','birthday','content'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
    
    //このUserが所有するPost
    public function posts() {
        return $this->hasMany(Post::class);
    }
    
    //件数の取得
    public function loadRelationshipCounts() {
        $this->loadCount(['posts','followings','followers','favorites']);
    }
    
    //このUserがフォロー中のUser
    public function followings() {
        return $this->belongsToMany(User::class,'user_follow','user_id','follow_id')->withTimestamps();
    }
    
    //このUserをフォローしているUser
    public function followers() {
        return $this->belongsToMany(User::class,'user_follow','follow_id','user_id')->withTimestamps();
    }
    
    //$userIdで指定したUserをフォローする
    public function follow($userId) {
        $exist = $this->is_following($userId);
        $its_me = $this->id == $userId;
        
        if($exist || $its_me) {
            return false;
        } else {
            $this->followings()->attach($userId);
            return true;
        }
    }
    
    //$userIdで指定したUserのフォローを外す
    public function unfollow($userId) {
        $exist = $this->is_following($userId);
        $its_me = $this->id == $userId;
        
        if($exist && !$its_me) {
            $this->followings()->detach($userId);
            return true;
        } else {
            return false;
        }
    }
    
    //指定された$userIdのUserをこのUserがフォロー中確認→フォロー中ならtrueを返す
    //SELECT * FROM followings where follow_id = $userId;
    public function is_following($userId) {
        return $this->followings()->where('follow_id',$userId)->exists();
    }
    
    //フォロー中のUserと自分の投稿に絞る
    public function feed_posts() {
        //(SQL: select `users.id` from `users` inner join `user_follow` on `users`.`id` = `user_follow`.`follow_id` where `user_follow`.`user_id` = 2)'
        $userIds = $this->followings()->pluck('users.id')->toArray();
        // 配列への追加（自分）
        $userIds[] = $this->id;
        
        //where posts.user_id IN $userIds
        return Post::whereIn('user_id',$userIds);
    }
    
    
    //このUserがいいねしているPost
    public function favorites() {
        return $this->belongsToMany(Post::class,'favorites','user_id','post_id')->withTimestamps();
    }
    
    //$postIdで指定したPostをいいねする
    public function favorite($postId) {
        $exist = $this->is_favorite($postId);

        if($exist) {
            return false;
        } else {
            $this->favorites()->attach($postId);
            return true;
        }
    }
    
    //$postIdで指定したPostのいいねを外す
    public function unfavorite($postId) {
        $exist = $this->is_favorite($postId);
        
        if($exist) {
            $this->favorites()->detach($postId);
            return true;
        } else {
            return false;
        }
    }
    
    //$postIdで指定したPostがいいねされているか確認→入っていればtrueを返す
    public function is_favorite($postId) {
        return $this->favorites()->where('post_id',$postId)->exists();
    }
    
    
    //このUserがコメントしているPost
    public function comments() {
        return $this->belongsToMany(Post::class,'comments','user_id','post_id')
        ->withPivot('content','id')
        ->withTimestamps();
    }
    
    //$postIdで指定した投稿にコメントをする
    public function comment($postId,$content) {
        $this->comments()->attach($postId,$content); 
    }
    
    
    //room機能
    // このUserがMessageを送信したUser
    public function send_messages() {
        return $this->belongsToMany(User::class,'messages','send_user_id','receive_user_id')
        ->withPivot('content','id')
        ->withTimestamps();
    }
    
    // このUserがMessageを受信したUser
    public function receive_messages() {
        return $this->belongsToMany(User::class,'messages','receive_user_id','send_user_id')
        ->withPivot('content','id')
        ->withTimestamps();
    }
    
    // $userIdで指定したUserにMessageを送信する
    public function send_message($userId,$content) {
        $this->send_messages()->attach($userId,$content);
    }
    
    //userIdで指定したUserと自分がマッチングしているかの確認
    public function matching($userId) {
        //自分がフォローしている相手か確認
        $exist_me = $this->is_following($userId);
        // 相手からフォローされているか確認
        $you = User::findOrFail($userId);
        $id = \Auth::id();
        $exist_you = $this->followers()
        ->where('user_id',$userId)
        ->exists();
        
        if($exist_me && $exist_you) {
            return true;
        } 
    }

    

}