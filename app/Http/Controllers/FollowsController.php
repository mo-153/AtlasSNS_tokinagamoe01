<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

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
            // フォロー解除
        }else{
            // フォロー
            Follow::create([
                'following_id'=>$followerId,
                'followed_id'=>$userId,
            ]);
        }
        return redirect('/search');
    }
}
