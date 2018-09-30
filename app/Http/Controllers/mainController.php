<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class mainController extends Controller
{
    public function __construct(){
       $this->middleware('auth')->only('dashboard');
    }

    public function dashboard(){
        return view('welcome');
    }

    public function loginPage(){
        if (Auth::check()){
            return redirect()->route('dashboard');
        }else{
            return view('login');
        }
    }

    public function login(LoginRequest $request){
        if (Auth::attempt(['email' => $request->email , 'password' => $request->password])){
            // check active
            $user = User::find(Auth::user()->id);
            if ($user->active == 0){
                Auth::logout();
                return redirect()->route('login')->with(['message_err' => 'Your Account Suspended!']);
            }
            return redirect()->route('dashboard');
        }else{
            return redirect()->back()->with(['message_err' => 'Invalid Email or Password!']);
        }
    }

    public function logout(){
        Auth::logout();
        return redirect()->route('login');
    }
}
