<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class AuthController extends Controller

{
    public function __construct(){
        $this->middleware('guest')->except('logout');
    }
    // logic for returning the register view
    public function register(){
        return view('auth/register');
    }

    //registerSave function
    public function registerSave(Request $request){
    Validator::make($request->all(),[
        'name'=> 'required',
        'email'=>'required | email',
        'password'=> 'required | confirmed'
    ])->validate();

    // creating the user
    User::create([
        'name'=> $request->name,
        'email'=>$request->email,
        'password'=> Hash::make($request->password),
    ]);
    return redirect()->route('login');

    }


    //logic for returning the login view
    public function login(){
        return view('auth/login');
    }

    //loginAction function
    public function loginAction(Request $request){
        Validator::make($request->all(), [
            'email'=>'required | email',
            'password'=> 'required'

        ])->validate();

        // authenticating the user
        if(!Auth::attempt($request->only('email', 'password'), $request->boolean('remember'))){
        throw ValidationException::withMessages([
            'email'=> trans('auth.failed')
        ]);
    }
        $request->session()->regenerate();
         
        // creating the middleware
        if(auth()->user()->type == 'admin'){
            return redirect()->route('admin/home');
        }else{
            return redirect()->route('home');
        }
      
    }

    // for the logout function

    public function logout(Request $request){
        Auth::guard('web')->logout();
        $request->session()->invalidate();
        return redirect('/login');
    }
}
