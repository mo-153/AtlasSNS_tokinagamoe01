<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\Post;

class PostsController extends Controller
{

    // すべてのユーザーの投稿を表示
    public function index(){
        $posts=Post::all();
        return view('posts.index',compact('posts'));
    }


    // バリデーション
    // 投稿をするときのルール
    // 【Post】
    // ・入力必須
    // ・1文字以上、150字以内

        /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        $validatedDate = $request->validate(['post'=>'required|min:1|max:150 ']);

        return view('posts.store');
    }





// すべての投稿と各投稿者の名前の表示
    public function show(){
        $posts=Post::get();
        return view('posts.index',compact('posts'));
    }


    // フォローユーザのみの投稿を表示
    // public function show(){
    //     ↑show:表示という意味
    //     $following_id = Auth::user()->follows()->pluck('following_id');
    //     ↑フォローしているユーザーのidを取得
    //     $posts = Post::with('user')->whereIn('user_id',$following_id)->get();
    //     ↑フォローしているユーザーのidをもとに投稿内容を取得

    //     return view ('posts.index',compact('posts'));
    // }
}

// ↑フォローしているユーザーのみの情報を取得する
// public function show(){
// フォローしているユーザーのidを取得
//   $following_id = Auth::user()->follows()->pluck(' ① ');

// フォローしているユーザーのidを元に投稿内容を取得
//   $posts = Post::with('user')->whereIn(' ② ', $following_id)->get();

//   return view('yyyy', compact(‘posts’));
// }
