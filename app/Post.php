<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    //
    protected $fillable = ['content'];
    
    //このPostを所有するUser
    public function user() {
        return $this->belongsTo(User::class);
    }
    
    //件数の取得
    public function loadRelationshipCounts() {
        $this->loadCount(['comment_users']);
    }

    
    
    //このPostをいいねしているUser
    public function favorite_users() {
        return $this->belongsToMany(User::class,'favorites','post_id','user_id')->withTimestamps();
    }
    
    //このPostにコメントしているUser
    public function comment_users() {
        return $this->belongsToMany(User::class,'comments','post_id','user_id')
        ->withPivot('content','id')
        ->withTimestamps();
    }
    
    
    
}
