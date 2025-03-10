<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;


class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $userID = Auth::user()->id ;
        $posts = Post::withCount('likes')
        ->where('userID', '=', $userID)
        ->with(['likes' => function ($query) use ($userID) {
        $query->where('userID', $userID);
        }])
        ->paginate(2);
        $in = "like" ;
        $out = "unlike" ;
        $count = Post::where('userID', '=', $userID)->count();
        return view("posts.index" , ["posts" => $posts , "count" => $count , "in"=> $in ,"out"=> $out]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view("posts.create");
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        if(Auth::user()->id != $request->userID){
            return redirect("/");
        }
        $fields = $request->validate([
            "userID" => ['required'] ,
            "subject" => ["required" , "min:3"] ,
            "content" => ["required" , "min:3"]
        ]);
        Post::create($fields) ;
        return to_route("posts.index")->with("success" , "Create Successfuly");

    }

    /**
     * Display the specified resource.
     */
    public function show(Post $post)
    {
        $comments = Comment::where("postID" , "=" , $post->id)->where("parentID" , "=" , NULL)->get() ;
        $subComments = Comment::where("postID" , '=' , $post->id)->where('parentID' , "!=" , NULL)->get();
        // return $subComments ;
        return view("posts.show" , ["post" => $post , "comments" => $comments , "subComments" => $subComments]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Post $post)
    {
        return view("posts.edit" , ["post" => $post]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Post $post)
    {
        // if(Auth::user()->id != $request->userID){
        //     return redirect('/');
        // }
        if (Gate::allows('update', $post)) {
            $fields = $request->validate([
                "userID" => ['required'] ,
                "subject" => ["required" , "min:3"] ,
                "content" => ["required" , "min:3"]
            ]);

            $post->update([
                "subject" => $fields["subject"] ,
                "content" => $fields["content"]
            ]);
            return to_route("posts.index")->with("success" , "Update Successfuly");

        } else {
            abort(403);
        }

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Post $post)
    {
        if(Gate::allows('delete' , $post)){
            $post->delete() ;
            return to_route("posts.index")->with("success" , "Delete Successfuly");
        }else{
            abort(403) ;
        }
    }

    public function other(User $user){
        $userID = $user->id ;
        $posts = Post::withCount('likes')
        ->where('userID', '=', $userID)
        ->with(['likes' => function ($query) use ($userID) {
        $query->where('userID', $userID);
        }])
        ->paginate(2);
        $in = "unlike" ;
        $out = "like" ;
        $count = Post::where('userID', '=', $userID)->count();
        return view("posts.index" , ["posts" => $posts , "userID" => $userID , "count" => $count , "in"=> $in ,"out"=> $out]);

    }
}