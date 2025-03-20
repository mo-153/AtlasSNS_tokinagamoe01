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



    // フォロー
    public function follow(User $user)
    {
        $follower = auth()->user();
        // フォローしているか

        $is_following = $follower->isFollowing($user->id);
        if(!$is_following){
　　　　// フォローしてなかったらフォローする
            $follower->follow($user->id);
            return back();
        }
    }

    // フォロー解除
    public function unfollow(User $user)
    {
        $follower = auth()->user();
        // フォローしているか

        $is_following = $follower->isFollowing($user->id);
        if($is_following){
        // フォローしてなかったらフォローする
            $follower->unfollow($user->id);
            return back();
        }
    }

}
