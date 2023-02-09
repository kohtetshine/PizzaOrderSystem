<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CategoryController;
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
Route::redirect('/', 'loginPage');

Route::get('loginPage', [AuthController::class, 'loginPage'])->name('auth#loginPage');

Route::get('registerPage', [AuthController::class, 'registerPage'])->name('auth#registerPage');

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified'
])->group(function () {
    Route::group(['prefix' => 'category'], function () {
        Route::get('list', [CategoryController::class, 'list'])->name('admin#categorylist');
    });
});

// Route::get('/',function(){
//     return view('login');
// })->name('loginPage');

// Route::get('register', function () {
//     return view('register');
// })->name('registerPage');


// login , register




