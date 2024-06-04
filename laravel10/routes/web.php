<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\HomeController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::controller(AuthController::class)->group(function(){
    // for the register
    Route::get('register', 'register')->name('register');
    // routes for creating the register
    Route::post('register', 'registerSave')->name('register.save');


    // routes for the login
    Route::get('login', 'login')->name('login');
    //routes fetching the data from the database
    Route::post('login', 'loginAction')->name('login.action');

    //routes for the logout
    Route::get('logout', 'logout')->middleware('auth')->name('logout');

});


// Routes for the home
Route::get('/home', [HomeController::class, 'index'])->name('home');


// routes for the normal user




// routes for the admin user

