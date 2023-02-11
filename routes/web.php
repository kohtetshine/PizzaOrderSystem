<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CategoryController;
use Illuminate\Support\Facades\Route;
use Laravel\Jetstream\Rules\Role;

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

// login and register
Route::redirect('/', 'loginPage');
Route::get('loginPage', [AuthController::class, 'loginPage'])->name('auth#loginPage');
Route::get('registerPage', [AuthController::class, 'registerPage'])->name('auth#registerPage');


Route::middleware(['auth:sanctum',config('jetstream.auth_session'),'verified'])->group(function () {
    //dashboard

    Route::get('dashboard',[AuthController::class,'dashboard'])->name('dashboard');

    //admin

    //category
    Route::group(['prefix' => 'category','middleware'=>'admin_auth'], function () {
        //list
        Route::get('list', [CategoryController::class, 'list'])->name('admin#categorylist');

        //createpage
        Route::get('create/page',[CategoryController::class, 'createPage'])->name('admin#createPage');

        //do create work
        Route::post('create',[CategoryController::class,'create'])->name('admin#create');

        //do delete work
        Route::get('delete/{id}',[CategoryController::class,'delete'])->name('admin#delete');

        //editpage
        Route::get('edit/page/{id}',[CategoryController::class,'editPage'])->name('admin#editPage');

        //do update work
        Route::post('update/{id}', [CategoryController::class, 'update'])->name('admin#update');

    });

    //user
    //home

    Route::group(['prefix'=>'user', 'middleware' => 'user_auth'],function(){
        Route::get('home',function(){
            return view('user.home');
        })->name('user#home');
    });
});





