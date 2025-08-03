<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Follow;
use App\Models\User;
use App\Models\Post;

class FollowsController extends Controller
{


    // フォローについて
    public function follow(Request $request)
    {
        $followerId = Auth::id();
        $userId = $request->input('user_id');// ←フォローしている人のID

        $follow = Follow::where('following_id',$followerId)
        ->where('followed_id',$userId)
        ->first();

        if($follow){
            $follow->delete();
            // フォロー解除

        }else{
            Follow::create([
                'following_id'=>$followerId,
                'followed_id'=>$userId,
            ]);
            // フォローする
        }
        $authUser=User::withCount(['follows','followers'])->find($followerId);
        return response()->json([
            'status'=>!$follow,
            'follow_count'=>$authUser->follows_count,
            'follower_count'=>$authUser->followers_count,
        ]);
    }


    // フォローリストのページの表示
    public function followList(){
        $user=Auth::user();
        $follows=$user->follows()->get();

        $posts=Post::whereIn('user_id',$follows->pluck('id'))->latest()->get();

        return view('follows.followList',compact('follows','posts'));
        // ↑follow,postsをフォローリストへ渡したいから2つ記述する
    }

public function followCounts(){
    $user=Auth::user();
    return response()->json([
        'followCount'=>$user->follows()->count(),
                'followerCount'=>$user->followers()->count(),
    ]);
}


    // フォロワーリストのページ
       public function followerList(){
        $user=Auth::user();
        $followers=$user->followers()->get();

        $posts=Post::whereIn('user_id',$followers->pluck('id'))->latest()->get();

        return view('follows.followerList',compact('followers','posts'));
    }

}
