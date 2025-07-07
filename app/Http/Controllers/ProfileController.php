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
        $posts=Post::where('user_id', $user->id)
               ->orderBy('created_at','desc')
               ->get();
        // $user:プロフィールのユーザー情報、$posts:そのユーザーの投稿
        return view('profiles.profile',compact('user','posts'));
    }


    // プロフィール編集ボタンで自分のプロフィールを編集する
    public function edit($id) {
        $user = Auth::user();
        return view('profiles.edit', compact('user'));
    }

}
