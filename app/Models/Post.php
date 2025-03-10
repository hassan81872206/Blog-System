<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Post extends Model
{
    use SoftDeletes;
    protected $fillable = [
        "subject" ,
        "content" ,
        "userID"
    ];

    public function user(){
        return $this->belongsTo(User::class , "userID");
    }

    public function likes()
    {
        return $this->hasMany(Like::class , "postID");
    }
}