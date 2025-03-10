<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    protected $fillable = ["comment" , "userID" , "postID" , "parentID"];

    public function user(){
        return $this->belongsTo(User::class , "userID");
    }

}
