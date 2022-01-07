<?php

use App\Http\Controllers\ChangePasswordController;
use App\Http\Controllers\CommentsController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PostsController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
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

Auth::routes([
    'login' => true,
    'logout' => true,
    'register' => false,
    'reset' => false,
    'confirm' => false,
    'verify' => false,
]);

Route::get('/', [HomeController::class, 'index'])->name('home');

Route::get('/post/{id}', [PostsController::class, 'show'])->name('post');
Route::get('/posts/index', [PostsController::class, 'index'])->name('posts');
Route::get('/posts/edit/{id}', [PostsController::class, 'edit'])->name('edit_post');

Route::get('/posts/delete/{id}', [PostsController::class, 'delete'])->name('delete_post');
Route::get('/posts/create', [PostsController::class, 'create'])->name('create_post');
Route::post('/posts/save', [PostsController::class, 'newPost'])->name('save_post');
Route::post('/posts/update', [PostsController::class, 'update'])->name('update_post');

Route::post('/post/{id}/create_comment', [CommentsController::class, 'save'])->name('create_comment');
Route::get('/reload_captcha', [CommentsController::class, 'reloadCaptcha'])->name('reload_captcha');
Route::get('/comments/delete/{id}', [CommentsController::class, 'delete'])->name('delete_comment');

Route::get('change_password',  [ChangePasswordController::class, 'index'])->name('change_password');
Route::post('change_password', [ChangePasswordController::class, 'changePassword'])->name('update_password');

Route::get('logout', function () {
    auth()->logout();
    Session()->flush();

    return Redirect::to('/');
})->name('logout');
