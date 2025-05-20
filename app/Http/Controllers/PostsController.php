<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\Post;
use Illuminate\Http\RedirectResponse;

class PostsController extends Controller
{

    // フォローユーザのみの投稿を表示
    public function index(){
        $following_id = Auth::user()->follows()->pluck('followed_id');
        // ↑フォローしているユーザーのidを取得
        $user_id=$following_id->push(Auth::id());

        $posts = Post::with('user')->whereIn('user_id',$following_id)->latest()->get();
        // ↑フォローしているユーザーのidをもとに投稿内容を取得
        return view ('posts.index',compact('posts'));


        // すべてのユーザーの投稿を表示
        // $posts=Post::with('user')->get();
        // return view('posts.index',compact('posts'));
    }


    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        $validatedDate = $request->validate([
            'post'=>'required|min:1|max:150 ']);

            // バリデーション
            // 投稿をするときのルール
            // 【Post】
            // ・入力必須
            // ・1文字以上、150字以内


            // ↓新規投稿を保存する
            Post::create([
                'user_id'=>Auth::id(),
                'post'=>$validatedDate['post'],
            ]);

            return redirect()->route('posts.index');
        }
    }
