<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\User\ArticleController;
use App\Http\Controllers\User\CategoryController;
use App\Http\Controllers\User\CommentController;
use Illuminate\Support\Facades\Route;

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

Route::get('/', [ArticleController::class , 'index']);



Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::middleware('auth')->group( function () 
{
    Route::get('create_article', [ArticleController::class ,'create'])->name('create_article') ;
    Route::post('store_article', [ArticleController::class,'store'])->name('store_article') ;
    Route::post('add_comment/{id}', [CommentController::class,'addComment'])->name('add_comment') ;
}) ; 
Route::get('show_category/{id}' ,[CategoryController::class ,'show'])->name('show_category') ;
Route::get('show_article/{id}' ,[ArticleController::class ,'show'])->name('show_article') ;