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
}
