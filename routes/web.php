<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminsController;
use App\Http\Controllers\UserhomeController;

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

//Admin

Route::get('/', function () {
    return view('auth.login');
});

Route::get('add-user',[AdminsController::class, 'create']);

Route::post('save-user', [AdminsController::class,'storeUser']);

Route::get('userlists',[AdminsController::class, 'index']);

Route::post('get-user-data',[AdminsController::class, 'getUserData']);

Route::get('edit-user/{id}/edit',[AdminsController::class, 'edit']);

Route::get('fetch-user-data/{id}',[AdminsController::class, 'getUserDataById']);

Route::put('update-user/{id}', [AdminsController::class,'update']);

Route::delete('delete-user/{id}', [AdminsController::class,'destroy']);

//Users

Route::get('user_login',[UserhomeController::class, 'login']);

Route::post('login-user-req',[UserhomeController::class, 'userloginPost']);

Auth::routes();

//Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
