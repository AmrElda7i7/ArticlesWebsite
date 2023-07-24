<?php

use App\Http\Controllers\Admin\ArticleController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\RoleController;
use App\Http\Controllers\Admin\UserController;
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


Route::middleware(['auth' ,'IsAdmin'])->group(function () {
    Route::resource('roles', RoleController::class);
    Route::resource('users', UserController::class);
    Route::resource('categories', CategoryController::class);
    Route::resource('articles', ArticleController::class);
    Route::get('/admin', function () {
        return view('admin.index');
    });
    Route::get('waiting_articles' ,[ArticleController::class ,'waitingArticles']);
    Route::patch('accept_article/{id}' ,[ArticleController::class ,'acceptArticle']);
    Route::delete('reject_article/{id}' ,[ArticleController::class ,'rejectArticle']);
});