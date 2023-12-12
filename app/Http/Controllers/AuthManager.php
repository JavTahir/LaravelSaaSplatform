<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class AuthManager extends Controller
{
    function login(){

        if (Auth::check()){
            return redirect()->intended(route('home'));


        }
        return view('login');
    }

    function loginPost(Request $request){
        $request->validate([
            'email' => 'required',
            'password' => 'required'
        ]);

        $credentials = $request->only('email','password');
        if(Auth::attempt($credentials)){
            return redirect()->intended(route('dashboard'));

        }
        return redirect()->intended(route('login'))->with("error","Login not valid!");
    }

    function signupPost(Request $request){
        $request->validate([
            'name'=> 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required'
        ]);

        $data['name'] = $request->name;
        
        $data['email'] = $request->email;
        $data['password'] = Hash::make($request->password);
        

        $user = User::create($data);
        if(!$user){
            return redirect()->intended(route('signup'))->with("error","User not created!");

        }

        return redirect()->intended(route('login'))->with("success","User Created!");
    }


    function logout(){
        Session::flush();
        Auth::logout();

        return redirect()->intended(route('login'));

    }

    function signup(){
        return view('registration');
    }


}
