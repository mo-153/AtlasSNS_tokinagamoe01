<x-logout-layout >

  <!-- 適切なURLを入力してください -->
  {!! Form::open(['url'=>'login','method'=>'post']) !!}

<div class = "box">
    <p class = "title">AtlasSNSへようこそ</p>

<div class = "login">
  {{ Form::label('email') }}
  {{ Form::text('email',null,['class' => 'input']) }}
  {{ Form::label('password') }}
  {{ Form::password('password',['class' => 'input']) }}
</div>

{{ Form::submit('LOGIN',['class'=>'login-btn']) }}
<!-- <button class = "login-btn">LOGIN</button> -->
<p><a href="register" class = "new-users">新規ユーザーの方はこちら</a></p>
</div>

</div>
{!! Form::close() !!}

</x-logout-layout>
