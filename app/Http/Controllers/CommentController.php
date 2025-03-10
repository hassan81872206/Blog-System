<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\User;
use App\Models\Comment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class CommentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

    }

    /**
     * Display the specified resource.
     */
    public function show(Comment $comment)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Comment $comment)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Comment $comment)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Comment $comment)
    {
        //
    }

    public function save(Request $request , Post $post , User $user){
        $validator = Validator::make($request->all() , [
            "comment" => ["required" , "min:3" , "max:500"]
        ]);

        if($validator->fails()){
            return response()->json(["status" => "error" , "errors" => $validator->errors()] , 422);
        }

        Comment::create([
            "comment" => $request->comment ,
            "postID" => $post->id ,
            "userID" => $user->id
        ]);

        return response()->json(["success" => "Add Comment Successfuly"]);
    }

    public function save1(Request $request ,  Post $post , User $user , Comment $comment){
        try{
            $validator = Validator::make($request->all() , [
                "subComment" => ["required" , "min:3" , "max:500"]
            ]);

            if($validator->fails()){
                return response()->json(["status" => "error" , "errors" => $validator->errors()] , 422) ;
            }

            Comment::create([
                "comment" => $request->subComment ,
                "postID" => $post->id ,
                "userID" => $user->id ,
                "parentID" => $comment->id
            ]) ;
            return response()->json(["success" => "Add Comment Successfuly"]);
        }catch(\Exception $e){
            return response()->json(['error' => $e->getMessage()], 500);
        }

    }
}
