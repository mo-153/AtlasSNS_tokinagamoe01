<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;
use App\Models\Follow;
use App\Models\User;
use App\Models\Post;

class ProfileController extends Controller
{
        public function show($id){
        $user=User::findOrFail($id);
        $loginUser=Auth::user();
        $user->is_followed=$loginUser ? $loginUser->isFollowing($user->id):false;
        // ↑三項演算子の記述方法。　条件?　A(真の場合の値):　B(偽の場合の値);　【意味】条件が真ならAで偽ならB

        $posts=Post::where('user_id', $user->id)
               ->orderBy('created_at','desc')
               ->get();
        // $user:プロフィールのユーザー情報、$posts:そのユーザーの投稿
        return view('profiles.profile',compact('user','posts'));
                  //  ↑ここはbladeのファイル名(profiles.profile)
    }



    // プロフィール編集ボタンで自分のプロフィールを編集する
         public function edit($id){
            $user=Auth::user();
            return view('profiles.edit',compact('user'));
            }



    // プロフィールの更新
    public function update(Request $request){
        $user = Auth::user();

   // バリデーション
     // 【UserName】
        // ・入力必須・2文字以上12文字以
     // 【MailAddress】
        // ・入力必須・5文字以上40文字以内・登録済みメールアドレス使用不可(自分のメールアドレスは除く)
        // ・メールアドレスの形式
     // 【Password】
        // ・入力必須・英数字のみ・8文字以上20文字以内
     // 【PasswordConfirm(パスワード確認用)】
        // ・入力必須・英数字のみ・8文字以上,20文字以内
        // ・Password入力欄と一致しているか
     // 【Bio】
        // ・150文字以内
     // 【icon-image】
        // ・画像（jpg/png/bmp/gif/svg）ファイル以外は不可



                $validatedData = $request->validate([
                'username'=>'required|min:2|max:12',
                'email'=> 'required|min:5|max:40|unique:users,email,'. $user->id,
                'password'=>'required|string|min:8|max:20|confirmed',
                'bio'=>'nullable|string|max:150',
                'image'=>'nullable|mimes:jpg,png,bmp,gif,svg'],

                ['username.required' => 'ユーザー名は必須項目です。',
                  'username.min' => 'ユーザー名は2文字以上で入力してください。',
                  'username.max' => 'ユーザー名は12文字以内で入力してください。',

                  'email.required' => 'メールアドレスは必須項目です。',
                  'email.min' => 'メールアドレスは5文字以上で入力してください。',
                  'email.max' => 'メールアドレスは40文字以内で入力してください。',
                  'email.email' => 'メールアドレスの形式で入力してください。',

                  'password.required' => 'パスワードは必須項目です。',
                  'password.alpha_num' => 'パスワードは英数字のみで入力してください。',
                  'password.min' => 'パスワードは8文字以上で入力してください。',
                  'password.max' => 'パスワードは20文字以内で入力してください。',
                  'password.confirmed' => 'パスワード確認用と一致しません。',

                  'bio.max'=>'自己紹介は150字以内で入力',

                  'image'=>'このアイコン画像は使用できません',
                   ]);



            // required:入力必須　min:最低〇文字　max:最大〇文字
            // required:users 重複しない
            // string:文字列になっていること
            // confirmed:確認用と一致していること
            // nullable:入力がなくてもOK
            // mimes:画像の拡張子を制限する




            // ユーザーの登録情報の保存更新
            $user->username=$validatedData['username'];
            $user->email=$validatedData['email'];
            $user->password=bcrypt($validatedData['password']);
            // ↑bcryptとは
            //  パスワードをそのまま保存すると危ないから暗号化(ハッシュ化)して保存するために必要
            $user->bio=$validatedData['bio'] ?? null;

            // アイコン画像が新しく更新された場合保存する
            if($request->hasFile('image')){
                // ↑アイコン画像が送られてきたか確認する
                $path=$request->file('image')->store('profile_images','public');
                // ↑アイコンをフォルダに保存する
                $user->image=$path;
                // ↑imageカラムに保存
            }
            $user->save();
            // ↑データベースに情報を保存

            return redirect('/top');
            // ↑TOPページへ飛ぶようにするs
         }
      }
