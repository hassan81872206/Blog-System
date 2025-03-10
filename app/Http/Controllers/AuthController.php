<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function loginPage(){
        return view("login");
    } 

    public function login(Request $request){
        $validate = $request->validate([
            "email" => [ "required" , "email"],
            "password" => ["required" , "min:8"]
        ]);
        if(Auth::attempt(["email" => $request->email , "password" => $request->password])){
            return redirect("/")->with("msg" , "You are Login") ;
        }else{
            return back()->with("msg" , "Incorredt Email Or Password"); 
        }
    }

    public function registerPage(){
        return view("register");
    }

    public function register(Request $request){
        $validate = $request->validate([
            "username" => ["required" , "alpha" , "min:3" , "max:15"],
            "password" => ["required" , 'min:8' , "confirmed"] ,
            "email" => ["required" , "email" , "unique:users,email"]
        ]);
        $user = User::create($validate);
        Auth::login($user);
        return redirect("/")->with("msg" , "You are Login") ;
    }

    public function logout(){
        Auth::logout();
        return redirect('/');
    }
}
