<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Follow;

class FollowsController extends Controller
{
    //
    public function followList(){
        return view('follows.followList');
    }
    public function followerList(){
        return view('follows.followerList');
    }



    // フォローについて
    public function follow(Request $request)
    {
        $followerId = Auth::id();
        $userId = $request->input('user_id');

        $follow = Follow::where('following_id',$followerId)
        ->where('followed_Id',$userId)
        ->first();

        if($follow){
            $follow->delete();
            return response()->json(['status' =>false]);
            // フォロー解除

        }else{
            // フォロー
            Follow::create([
                'following_id'=>$followerId,
                'followed_id'=>$userId,
            ]);
            return response()->json(['status'=>true]);
        }
    }


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
