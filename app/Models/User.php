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
        'following_id',
        'followed_id',
    ];
    // protected $fillableを記述することでusername, email,password,following_id,followed_idの登録ができるようになる

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
        return $this->follows()->where('followed_id', $user_id)->exists();
    }

    // フォローされているか
    public function isFollowedBy(Int $user_id)
    {
        return $this->follows()->where('user_id', $user_id)->exists();
    }

    public function posts()
    {
        return $this->hasMany(APP::class);
    }


    // belongsToManyを記述してUserモデルトFollowテーブルの紐づけ
    // フォローしているユーザーの情報を取得する
    public function follows(){
        return $this->belongsToMany(User::class,'follows','following_id','followed_id');
    }

    // フォローされているユーザーの情報を取得する
    public function followers(){
        return $this->belongsToMany(User::class,'follows','followed_id','following_id');
    }









    // ↓元々Follow.phpに記述していた内容
        public function user(){
        // １対多の関係
        return $this ->belongsTo('App/User');
    }

    // リレーション設定
    // このユーザーがフォローしている人
    public function following()
    {
        // 多対多の関係
        return $this->belongsToMany(
            User::class, // 関連するモデル
            'follows',   // 中間テーブル
            'following_id',
            'followed_id'
        )->withTimestamps();
    }

    // このユーザーをフォローしている人
    public function followed()
    {
        // 多対多の関係
        return $this->belongsToMany(
            User::class, // 関連するモデル
            'follows',   // 中間テーブル
            'followed_id',
            'following_id'
            )->withTimestamps();
        }

        // belongToMany()
        // →多対多のリレーションシップを設定できる
        // withTimestamps()
        // →タイムスタンプ（）が自動的に保存する
        // →中間テーブルはタイムスタンプが自動されないから記載する



        // 多対多：リレーションについて
        //  return $this->belongsToMany{
        // '1','2','3','4'};

        // 1には関係するモデルの場所を記載
        // 例）move.phpなど多対多の菅家のモデルの名前を記入
        // ディレクトリの場所を間違えないように注意

        // ２中間テーブルの名前を記載
        // 例）actor_moves

        // 3中間テーブルにある自分のIDが入るカラムを記入
        // 例）actor_id

        // ４中間テーブルの相手モデルに関係してるカラムを記入
        // 例）move_id






}
