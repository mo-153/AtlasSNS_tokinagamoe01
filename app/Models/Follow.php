<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Follow extends Model
{
    use HasFactory;

    public function user(){
        // １対多の関係
        return $this ->belongsTo('App/User');
    }


    protected $fillable = [
        'following_id',
        'followed_id',
    ];

    // protected $fillableを記述することでfollowing_id,followed_idの登録ができるようになる




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




    // フォローする
    public function follow(User $date)
    {
        $this->following()->attach($date->id);
    }

    // フォロー解除
        public function unfollow(User $date)
    {
        $this->following()->detach($date->id);
    }

    // フォローしているか確認する
    public function isFollowing(User $date)
    {
        return $this->following()->where('following_id',$date->id)->exists();
    }
}
