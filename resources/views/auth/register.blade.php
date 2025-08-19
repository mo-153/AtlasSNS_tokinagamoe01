<x-logout-layout>
    <!-- 適切なURLを入力してください -->
{!! Form::open(['url'=>'register', 'method'=>'post']) !!}
    <!-- form action:新規登録のデータを送信するためのもの -->
    {!! Form::open(['url' =>'register']) !!}
        @csrf
        {!! Form::open(['route' => 'register','method' => 'POST']) !!}


        <div class = "new-box">
            <p class = "user-registration">新規ユーザー登録</p>

            <div class = "login-form">
            {{ Form::label('user name') }}
            {{ Form::text('username',null,['class' => 'input']) }}
            @error('username')
            <div class="error"><span>{{$message}}</span></div>
            @enderror


            {{ Form::label('mail address') }}
            {{ Form::email('email',null,['class' => 'input']) }}
            @error('email')
            <div class="error"><span>{{$message}}</span></div>
            @enderror


             {{ Form::label('password') }}
             {{ Form::password('password',null,['class' => 'input','placeholder']) }}
            @error('password')
            <div class="error"><span>{{$message}}</span></div>
            @enderror


             {{ Form::label('password confirm') }}
             {{ Form::password('password_confirmation',null,['class' => 'input', 'placeholder' => '確認用パスワード']) }}
            @error('password_confirmation')
            <div class="error"><span>{{$message}}</span></div>
            @enderror


             <button class = "new-user-btn">REGISTER</button>
            </div>

                <p><a href="login" class = "back-page">ログイン画面へ戻る</a></p>
        </div>

            {!! Form::close() !!}
        </Form:open>


    </x-logout-layout>
