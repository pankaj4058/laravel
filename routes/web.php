<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\PostController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\FileUploadController;


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

// Route::get('/', function () {
//     return view('home');
// });

Route::get('/', [PostController::class, 'index']);
Auth::routes();

Route::get('/home', [PostController::class, 'index']);

// check for logged in user
Route::get('/fileupload', [FileUploadController::class, 'index']);
Route::post('/fileuploaded', [FileUploadController::class, 'stored']);
Route::get('/fileuploaded/delete/{id}', [FileUploadController::class, 'destroy']);
Route::get('/getimages', [FileUploadController::class, 'getimage']);
Route::get('new-post'  , [PostController::class, 'create']);
Route::post('/new-post'  , [PostController::class, 'store']);
Route::get('/{slug}', [PostController::class, 'show']);
Route::post('/comment/add', [CommentController::class, 'store']);
Route::get('/user{id}/posts', [UserController::class, 'user_posts']);
Route::get('/user/{id}', [UserController::class, 'profile']);
Route::get('/my-drafts/{id}', [UserController::class, 'user_posts_draft']);
Route::get('/my-all-posts/{id}', [UserController::class, 'user_posts_all']);
Route::get('/edit/{slug}', [PostController::class, 'edit']);
Route::post('/update', [PostController::class, 'update']);
Route::get('/delete/{id}', [PostController::class, 'destroy']);
Route::get('/delete/{id}/{author_id}', [PostController::class, 'imgdelete']);



// posts view only for auth users
// Route::middleware(['auth'])->group(function () {

// });



// Auth::routes();

// Route::get('/home', [HomeController::class, 'index']));

