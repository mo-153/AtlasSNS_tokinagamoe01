<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\User;
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
        $users = User::all();
        return view ('posts.index',compact('posts','users'));

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
            'post'=>'required|min:1|max:150 ']
        );

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


    // 投稿編集
    public function edit($id){
        $post=Post::findOrFail($id);

        if(Auth::id() !==$post->user_id){
            abort(403, 'Unauthorized action.');
        }

        return view('posts.edit',compact('post'));
    }


    // 投稿編集を更新
    public function update(Request $request,$id){
        $request->validate([
            'post'=>'required|string|max:150',
        ]);

        $post=Post::findOrFail($id);

        if(Auth::id() !==$post->user_id){
            // ↑(Auth::id())でログイン中のユーザー、($post->user_id)でその投稿を作ったユーザーが同じが確認している

            abort(403, 'Unauthorized action.');
        }
        // ↑セキュリティ対策・アクセス制限を確認
        // ↑他のユーザーが変更できないように

        $post->post=$request->input('post');
        $post->save();

        return redirect()->route('posts.index');
    }


    // 自分の投稿を削除する
    public function destroy($id){
        $post=Post::findOrFail($id);

        if(Auth::id()!==$post->user_id){
            abort('この投稿を削除します。よろしいでしょうか？');
        }
        $post->delete();
        return redirect()->route('posts.index');
    }
}
