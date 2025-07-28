<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\User;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    protected $fillable=['user_id','post'];
    // ↑[]内にはテーブルのカラム名と一致するものを記述する

    public function user(){
        // １対多の関係
        return $this->belongsTo(User::class, 'user_id');
    }

}
