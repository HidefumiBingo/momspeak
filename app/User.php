<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

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
        $this->loadCount(['posts','followings','followers']);
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
    
    
}