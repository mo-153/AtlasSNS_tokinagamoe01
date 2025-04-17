<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use App\Models\Follow;


class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;


    // リレーション
    protected $fillable = [
        'username',
        'email',
        'password',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    // フォローする
    public function follow(Int $user_id)
    {
        return $this->follows()->attach($user_id);
    }

    // フォロー解除する
    public function unfollow(Int $user_id)
    {
        return $this->follows()->detach($user_id);
    }

    // フォローしているか
    public function isFollowing(Int $user_id)
    {
        return (boolean) $this->follows()->where('followed_id', $user_id)->exists();
    }

    // フォローされているか
    public function isFollowed(Int $user_id)
    {
        return (boolean) $this->follows()->where('following_id', $user_id)->exists();
    }

    public function posts()
    {
        return $this->hasMany(APP::class);
    }


    // belongsToManyを記述してUserモデルトFollowテーブルの紐づけ
    // フォローしているユーザーの情報を取得する
    public function follows(){
        return $this->belongsToMany(User::class,'follow_user','following_id','followed_id');
    }
}
