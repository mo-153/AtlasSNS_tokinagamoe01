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
    public function search(Request $request)
{
    // 入力された検索キーワードを取得
    $keyword = $request->input('search');

    // 検索結果を取得 (例として、ユーザー名にキーワードを部分一致で検索)
    $users = User::where('username', 'LIKE', "%{$keyword}%")->get();

    $users->map(function ($user){
        $user->is_followed=Auth::user()->isFollowing($user->id);
        return $user;
    });

    $authUser = User::withCount(['follows', 'followers'])->find(Auth::id());

    // ビューに検索結果を渡す
    return view('users.search', [
        'date' => $users,
         'follows_count' => $authUser->follows_count,
        'follower_count' => $authUser->followers_count,
    ]);
}

     // フォローページにアクセスするためのメソッド
    // views/follow.blade.phpにビューを返す
    public function followPage(){
        return view('follow');
    }


    // フォロー
    public function follow(User $user)
    {
        $follower = auth()->user();
        // フォローしているか

        $is_following = $follower->isFollowing($user->id);
        if($is_following){
    // フォローしてなかったらフォローする
    $follower->follow($user->id);
    return b1ack();
      }
    }

    // フォロー解除
    public function unfollow(User $user)
    {
        $follower = auth()->user();
        // フォローしているか

        $is_following = $follower->isFollowing($user->id);
        if ($is_following) {
    // フォロー解除する
    $follower->unfollow($user->id);
    return back();
     }
    }




}
