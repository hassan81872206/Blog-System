<?php

namespace App\Http\Controllers;

use App\Models\Like;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MainController extends Controller
{
    public function home() {
        $userID = Auth::user()->id ;
        // $posts = Post::where("userID" , "!=" , $userID)->paginate(2);
        $posts = Post::withCount('likes')
        ->where('userID', '!=', $userID)
        ->with(['likes' => function ($query) use ($userID) {
        $query->where('userID', $userID);
        }])
        ->paginate(2);
        $in = "like" ;
        $out = "unlike" ;
        return view('welcome' , ["posts" => $posts , "in" => $in ,"out"=> $out ]);
    }
}