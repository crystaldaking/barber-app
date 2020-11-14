<?php

use Illuminate\Support\Facades\Route;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('auth.login');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('/ipad',function (){
    return view('ipad');
});

Route::namespace("App\Http\Controllers\Admin")->prefix("admin")->name("admin.")->middleware('can:manage-users')->group(function (){
    Route::resource("/users",UsersController::class,["except"=>["show","create","store"]]);
});

Route::namespace("App\Http\Controllers\Quene")->name("quene.")->group(function () {
    Route::resource("/quene", QueneController::class, ["except" => ["show","create","store"]]);
});

