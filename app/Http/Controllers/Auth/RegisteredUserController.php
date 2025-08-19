<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        // ↑storeメソッドはフォームから送信されたユーザー情報を受け取ってデータベースに保存する役割

        //    RedirectResponseはHTTPリダイレクトを表す


        // バリデーション
        // 新規登録のルール
        // 【UserName】
        // ・入力必須・2文字以上12文字以
        // 【MailAddress】
        // ・入力必須・5文字以上40文字以内・登録済みメールアドレス使用不可
        // ・メールアドレスの形式
        // 【Password】
        // ・入力必須・英数字のみ・8文字以上20文字以内
        // 【PasswordConfirm(パスワード確認用)】
        // ・入力必須・英数字のみ・8文字以上,20文字以内
        // ・Password入力欄と一致しているか


         $validatedData = $request->validate([
         'username'=>'required|min:2|max:12',
         'email'=> 'required|min:5|max:40|unique:users,email',
         'password'=>'required|string|min:8|max:20|confirmed',
         ],

         [
         'username.required' => 'User Nameは必須項目です。',
         'username.min' => 'User Nameは2文字以上で入力してください。',
         'username.max' => 'User Nameは12文字以内で入力してください。',

         'email.required' => 'Mail Addressは必須項目です。',
         'email.min' => 'Mail Addressは5文字以上で入力してください。',
         'email.max' => 'Mail Addressは40文字以内で入力してください。',
         'email.email' => 'Mail Addressの形式で入力してください。',
         'email.unique' => 'このMail Addressは既に使用されています。',

         'password.required' => 'Passwordは必須項目です。',
         'password.alpha_num' => 'Passwordは英数字のみで入力してください。',
         'password.min' => 'Passwordは8文字以上で入力してください。',
         'password.max' => 'Passwordは20文字以内で入力してください。',
         'password.confirmed' => 'Password Confirmが一致しません。',
    ]);
            // required:入力必須　min:最低〇文字　max:最大〇文字
            // required:users 重複しない

            // confirmed:確認用と一致していること


            // ☆ユーザー作成
            $user = User::create([
                // ↑新しいユーザーをデータベースに作成
                'username' => $validatedData['username'],
                // ↑ふぉーむから送信されたユーザー名を取得
                'email' => $validatedData['email'],
                // メールアドレスを取得
                'password' => Hash::make($validatedData['password']),
                // ↑パスワードを取得
                // ↑Hash::make()でハッシュ化(暗号化)して安全に保存する
            ]);





// ユーザー登録イベントのディスパッチ
event(new Registered($user));

// セッションにユーザー名を保存
// session：送ったデータを一時的二サーバー側に保存できる
session (['username'=>$user->username]);
            return redirect('added');
    }
        public function added(): View
        {
            return view('auth.added');
        }
    }
