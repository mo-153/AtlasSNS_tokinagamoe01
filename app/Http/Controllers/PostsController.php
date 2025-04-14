<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class PostsController extends Controller
{
    //
    public function index(){
        return view('posts.index');
    }

    public function show(){
        $following_id = Auth::user()->follows()->pluck('following_id');
        // ↑フォローしているユーザーのidを取得
        $posts = Post::with('user')->whereIn('user_id',$following_id)->get();
        // ↑フォローしているユーザーのidをもとに投稿内容を取得

        return view ('posts.index',compact('posts'));
    }
}
