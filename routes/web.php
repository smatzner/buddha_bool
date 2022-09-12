<?php

use App\Http\Controllers\AboutController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\IndexController;
use App\Http\Controllers\IngredientController;
use App\Http\Controllers\UserController;
use App\Models\Ingredient;
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

// Index
// Route::get('/', function () {
//     return view('index');
// });
Route::post('/generate',[IndexController::class,'generate'])->name('index.generate');
Route::resource('/', IndexController::class);

// About
Route::get('/about', function () {
    return view('about.index');
});

Route::middleware('auth')->group(function () {
    // Users
    Route::middleware('can:is_admin')->group(function(){
        Route::resource('/user', UserController::class);
    });

    // Ingredients
    Route::put('/ingredient/lock/{ingredient}',[IngredientController::class,'lock'])->name('ingredient.lock');
    Route::resource('/ingredient', IngredientController::class);
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

