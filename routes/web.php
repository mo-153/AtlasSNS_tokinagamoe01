<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UsersController;
use App\Http\Controllers\PostsController;
use App\Http\Controllers\FollowsController;

use App\Http\Controllers\Auth\AuthenticatedSessionController;

use App\Http\Controllers\Auth\RegisteredUserController;

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

require __DIR__ . '/auth.php';


// ログアウト中のページ
Route::middleware('guest')->group(function() {
    Route::get('/login', [AuthenticatedSessionController::class,'create'])->name('login');
    Route::post('/login', [AuthenticatedSessionController::class,'store']);

    Route::get('register', [RegisteredUserController::class, 'create'])->name('register');
    Route::post('register', [RegisteredUserController::class, 'store']);
});


// middleware
Route::middleware('auth')->group(function() {
    // トップページ
    // ↓投稿の一覧が表示される
    // 個別の投稿ページ
    Route::get('/top', [PostsController::class,'index'])->name('posts.index');

    // ↓新しい投稿が保存される
    Route::post('/top', [PostsController::class, 'store'])->name('posts.store');


    // ↓指定されたユーザーの投稿ページにアクセスして特定のユーザーの投稿が表示される
    Route::get('/top/{username}',[PostsController::class,'show'])->name('posts.show');




    // ↓プロフィールページにアクセス
    Route::get('/profile', [ProfileController::class,'profile'])->name('profile');

    // ↓ユーザー検索ページ
    Route::get('/search', [UsersController::class,'search'])->name('search');

    // ↓フォローページ
    Route::get('/follow-list', [PostsController::class,'index'])->name('follow.list');

    // ↓フォロワーページ
    Route::get('/follower-list', [PostsController::class,'index'])->name('follower.list');



    //フォローする
    Route::post('/follow',[FollowsController::class,'follow'])->name('follow');

    Route::get('/follow-counts',[FollowsController::class,'followCounts']);

    // 4/25記述！！！多分違う
    // Route::post('/top',[FollowsController::class,'follows'])->name('followCounts');

    // Route::post('/top',[FollowsController::class,'followers'])->name('followerCounts');


    // 投稿を削除する
    // Route::get('/posts/{id}delete',[PostsController::class,'posts.delete']);

    // 投稿を編集する
    // Route::get('/posts/{id}update',[PostsController::class,'update'])->name('posts.edit');
    // Route::post('/posts/{id}update',[PostsController::class,'update'])->name('posts.update');
});
     // ↓ログアウト後にログインページにリダイレクトされる
     Route::post('/logout', [AuthenticatedSessionController::class, 'destroy'])->name('logout');
