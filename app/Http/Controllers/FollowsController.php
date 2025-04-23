<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Follow;
use App\Models\User;

class FollowsController extends Controller
{



// フォロー数カウント
public function FollowCount(){
    $follows = Follow::where('user_id',$followerId)->get();
    return
}
// フォローワー数カウント
public function FollowerCount(){

}


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
            return response()->json(['status' =>false]);
            // フォロー解除

        }else{
            Follow::create([
                'following_id'=>$followerId,
                'followed_id'=>$userId,
            ]);
            return response()->json(['status'=>true]);
            // フォローする
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
