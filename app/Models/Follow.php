<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Follow extends Model
{
    use HasFactory;


    // リレーション設定
    public function followed(){
        return $this -> belongsToMany(followed::class)-> withTimestamps();

        // belongToMany()
        // →多対多のリレーションシップを設定できる
        // withTimestamps()
        // →タイムスタンプ（）が自動的に保存する
        // →中間テーブルはタイムスタンプが自動されないから記載する

        }
}
