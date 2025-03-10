<?php

namespace App\Http\Controllers;

use App\Models\Like;
use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\User;
use Illuminate\Support\Facades\Auth;


class LikeController extends Controller
{
    public function like(Post $post , User $user){
        $like = Like::where("postID" , "=" , $post->id)->where("userID", Auth::user()->id)->first();
        if($like){
            $like->delete();
            return response()->json(["inliked" => "unliked successfuly"]);

        }else{
            Like::create([
                "userID"=> Auth::user()->id,
                "postID" => $post->id ,
            ]);
            return response()->json(["liked" => "liked successfuly"]);

    }

    }
}