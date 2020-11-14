<?php

use Illuminate\Support\Facades\Route;
use Spatie\Valuestore\Valuestore;
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

Route::get("/quene/{id}/{completed}",[\App\Http\Controllers\Quene\QueneController::class,'status'])->name('status');

Route::get("/global/{status}", function ($status){
    $settings = Valuestore::make(storage_path('app/settings.json'));
    if ($status == 1){
        $settings->put('app_active', 'active');
    }

    if ($status == 0){
        $settings->put('app_active', 'stop');
    }

    return redirect()->route('quene.quene.index');
})->name('global');
