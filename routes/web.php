<?php

use App\Http\Controllers\AboutController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\IndexController;
use App\Http\Controllers\IngredientController;
use App\Http\Controllers\RecipeController;
use App\Http\Controllers\SettingsController;
use App\Http\Controllers\UserController;
use App\Models\Ingredient;
use App\Models\Recipe;
use Illuminate\Routing\RouteGroup;
use Illuminate\Support\Facades\Route;
use Barryvdh\DomPDF\Facade\Pdf;

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
Route::post('/generate',[IndexController::class,'generate'])->name('index.generate');
Route::get('/pdf',[IndexController::class,'pdf'])->name('index.pdf');
Route::resource('/', IndexController::class);

// About
Route::view('/about','about.index')->name('about');

Route::middleware('auth')->group(function () {
    // Users
    Route::middleware('can:is_admin')->group(function(){
        Route::resource('/user', UserController::class);
    });

    // Ingredients
    Route::put('/ingredient/lock/{ingredient}',[IngredientController::class,'lock'])->name('ingredient.lock');
    Route::resource('/ingredient', IngredientController::class);

    // Recipes
    Route::put('/recipe/bookmark/{recipe}',[RecipeController::class,'bookmark'])->name('recipe.bookmark');
    Route::resource('/recipe',RecipeController::class);

    //Settings
    Route::resource('/settings',SettingsController::class);
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

