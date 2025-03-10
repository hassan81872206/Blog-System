<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Like extends Model
{
    protected $fillable = [
        'userID' ,
        'postID' ,
    ] ;

    public function user()
    {
        return $this->belongsTo(User::class, 'userID');
    }

    // العلاقة مع المنشور (كل إعجاب ينتمي إلى منشور واحد)
    public function post()
    {
        return $this->belongsTo(Post::class, 'postID');
    }
}