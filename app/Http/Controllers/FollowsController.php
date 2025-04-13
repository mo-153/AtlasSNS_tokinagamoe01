<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Follow;

class FollowsController extends Controller
{

    public function followList(){
        return view('follows.followList');
    }
    　　// ↑フォローリストを表示

    public function followerList(){
        return view('follows.followerList');
        // フォローしている人を表示
    }



    // フォローについて
    public function follow(Request $request)
    {
        $followerId = Auth::id();
        $userId = $request->input('user_id');// ←フォローしている人のID

        $follow = Follow::where('following_id',$followerId)
        ->where('followed_Id',$userId)
        ->first();

        if($follow){
            $follow->delete();
            return response()->json(['status' =>false]);
            // フォロー解除

        }else{
            Follow::create([
                'following_id'=>$followerId,
                'followed_id'=>$userId,
            ]);
            return response()->json(['status'=>true]);
            // フォロー
        }
    }


    // フォロー解除について
    public function unfollow(Request $request)
    {
        $followerId = Auth::id();
        $userId = $request->input('user_id');

        $follow = Follow::where('following_id',$followerId)
        ->where('followed_id',$userId)
        ->first();

        if($follow){
            $follow->delete();
            return response()->json(['status'=>false]);
        }
    }
}
