<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;
use App\Models\Follow;
use App\Models\User;
use App\Models\Post;

class ProfileController extends Controller
{
        public function show($id){
        $user=User::findOrFail($id);
        $loginUser=Auth::user();
        $user->is_followed=$loginUser ? $loginUser->isFollowing($user->id):false;
        // ↑三項演算子の記述方法。　条件?　A(真の場合の値):　B(偽の場合の値);　【意味】条件が真ならAで偽ならB

        $posts=Post::where('user_id', $user->id)
               ->orderBy('created_at','desc')
               ->get();
        // $user:プロフィールのユーザー情報、$posts:そのユーザーの投稿
        return view('profiles.profile',compact('user','posts'));
                  //  ↑ここはbladeのファイル名(profiles.profile)
    }



    // プロフィール編集ボタンで自分のプロフィールを編集する
    public function edit($id) {
        $user = Auth::user();
        return view('profiles.profile', compact('user'));
    }


    // プロフィールの更新
    public function update(){
        $user = Auth::user();
        return view('profiles.profile',compact('user'));
    }
}
