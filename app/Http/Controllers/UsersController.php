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
    public function search(Request $request){
        // 入力された検索ワードを取得
        $keyword = $request->input('search');

        // 検索結果を取得（例：ユーザー名にキーワードを部分一致で検索）
        $users=User::where('username','LIKE',"%{$keyword}%")->get();

        $users->map(function ($user){
            $user->is_followed=Auth::user()->isFollowing($user->id);
            return $user;
        });
        return view('users.search', compact('users','keyword'));
    }



    // followも自分で記述
    // フォローページにアクセスするためのメソッド
    // views/follow.blade.phpにビューを返す
    public function followPage(){
             return view('follow');
        }

        // フォロー
        public function follow(User $user){
            $follower=auth()->user();
            // フォローしているか

            $is_following=$follower->isFollowing($user->id);
            if($is_following){
                // フォローしてなかったらフォローする
                $follower->follow($user->id);
                return back();
            }
        }

        // フォロー解除
        public function unfollow(User $user){
            $follower=auth()->user();
            // フォローしているか
            $is_following=$follower->isFollowing($user->id);
            if(is_following){
                // フォロー解除
                $follower->unfollow($user->id);
                return back();
            }

        }

    }
