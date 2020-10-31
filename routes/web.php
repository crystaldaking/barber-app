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
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::namespace("App\Http\Controllers\Admin")->prefix("admin")->name("admin.")->middleware('can:manage-users')->group(function (){
    Route::resource("/users",UsersController::class,["except"=>["show","create","store"]]);
});

Route::get('/quene', [\App\Http\Controllers\Quene\QueneController::class,'index']);
