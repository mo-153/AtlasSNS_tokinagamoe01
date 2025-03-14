<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UsersController;
use App\Http\Controllers\PostsController;
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
    Route::get('/top', [PostsController::class,'index'])->name('posts.index');
    // ↓新しい投稿が保存される
    Route::post('/top', [PostsController::class, 'store'])->name('posts.store');

    // 個別の投稿ページ
    // ↓指定されたユーザーの投稿ページにアクセスして特定のユーザーの投稿が表示される
    Route::get('/top/{username}',[PostsController::class,'show'])->name('posts.show');

    // ↓プロフィールページにアクセス
    Route::get('/profile', [ProfileController::class,'profile'])->name('profile');

    // ↓ユーザー検索ページ
    Route::get('/search', [UsersController::class,'index'])->name('index');

    // ↓フォローページ
    Route::get('/follow-list', [PostsController::class,'index'])->name('follow.list');

    // ↓フォロワーページ
    Route::get('/follower-list', [PostsController::class,'index'])->name('follower.list');
});
     // ↓ログアウト後にログインページにリダイレクトされる
    Route::post('logout',[AuthenticatedController::class,'destroy']);->name('login');
