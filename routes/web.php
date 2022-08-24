<?php

use App\Http\Controllers\AboutController;
use App\Http\Controllers\IngredientController;
use App\Http\Controllers\UserController;
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
    return view('index');
});

// About
Route::get('/about', function () {
    return view('about.index');
});

// Settings
Route::get('/settings', function () {
    return view('settings.index');
});

Route::middleware('auth')->group(function () {
    // Users
    Route::middleware('can:is_admin')->group(function(){
        Route::resource('/user', UserController::class);
    });

    // Ingredients
    // Route::middleware('can:is_admin')->group(function(){
    //     Route::resource('/ingredient', IngredientController::class);
    // });
    Route::resource('/ingredient', IngredientController::class);





});


Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
