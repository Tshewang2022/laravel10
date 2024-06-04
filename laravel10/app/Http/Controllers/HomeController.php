<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
    }
    public function index(){
        return view('home');
    }

    // function to check if it is admin, giving the admin dashboard
    public function adminHome(){
        return view('dashboard');
    }
}
