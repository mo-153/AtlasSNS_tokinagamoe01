<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class UsersController extends Controller
{
    // ユーザーのプロフィールページにアクセスするためのメソッド
    // view/users/profile.blade.phpにビューを返す
    public function profile(){
        return view ('profile.show');
    }

    // ユーザーを検索するページにアクセスするためのメソッド
    // view/users/search.blade.phpにビューを返す
    public function search(){
        return view('users.search');
    }

    // followも自分で記述
    // フォローページにアクセスするためのメソッド
    // views/follow.blade.phpにビューを返す
    public function followPage(){
        return view('follow');
    }
}
