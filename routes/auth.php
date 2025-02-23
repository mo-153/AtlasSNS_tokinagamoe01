<?php

use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Auth\NewPasswordController;
use App\Http\Controllers\Auth\PasswordResetLinkController;
use App\Http\Controllers\Auth\RegisteredUserController;
use Illuminate\Support\Facades\Route;


Route::middleware('guest')->group(function () {

    // create:ユーザーにログインフォームや登録フォームを表示する役割
    // store:フォームから送信されたデータをサーバー側で処理してデータベースに保存、認証操作をする

    // ログイン画面表示
    Route::get('login', [AuthenticatedSessionController::class, 'create'])->name('login');
    // ログイン処理
    Route::post('login', [AuthenticatedSessionController::class, 'store']);

    // 新規登録画面表示
    Route::get('register', [RegisteredUserController::class, 'create'])->name('register');
    // 新規登録処理
    Route::post('register', [RegisteredUserController::class, 'store']);

    // 登録完了画面
    Route::get('added', [RegisteredUserController::class, 'added'])->name('added');
    });
