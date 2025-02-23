<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UsersController extends Controller
{
    //profileは自分で記述
    // ユーザーのプロフィールページにアクセスするためのメソッド
    view/users/profile.blade.phpにビューを返す
    public function profile(){
        return view ('users.profile');
    }

    // ユーザーを検索するページにアクセスするためのメソッド
    // view/users/search.blade.phpにビューを返す
    public function search(){
        return view('users.search');
    }

    // followも自分で記述
    // フォローページにアクセスするためのメソッド
    // views/follow.blade.phpにビューを返す
    public function follow(){
        return view('follow');
    }
}
