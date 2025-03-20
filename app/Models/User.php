<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Model;

use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'username',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];


        // フォローする
    public function follow(Int $User_id)
    {
        return $this -> follows()->attach($user_id);
    }
    // フォロー解除する
    public function unfollow(Int $User_id)
    {
        return $this -> follows()->detach($user_id);
    }

    // フォローしているか
    public function isFollowing(Int $User_id)
    {
        return (boolean) $this-> follows()->where('followed_id',$user_id)->first(['id']);
    }

    // フォローされているか
    public function isFollowed(Int $User_id)
    {
        return (boolean)$this -> follows()->where('following_id',$user_id)->first(['id']);
    }
}


    // リレーション設定
     class Follow extends Model
   {
     use HasFactory;
            public function following(){
            return $this -> belongToMany (followed::class)->withTimestamps();
            }
        }

        // belongToMany()
        // →多対多のリレーションシップを設定できる
        // withTimestamps()
        // →タイムスタンプ（）が自動的に保存する
        // →中間テーブルはタイムスタンプが自動されないから記載する
