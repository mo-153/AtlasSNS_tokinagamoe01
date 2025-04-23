<!DOCTYPE html>
<html>

  <head>
    <meta charset="utf-8">
    <!--IEブラウザ対策-->
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="description" content="ページの内容を表す文章" />
    <title></title>
    <link rel="stylesheet" href="{{ asset('css/reset.css') }} ">
  <link rel="stylesheet" href="{{ asset('css/app.css') }}">
  <link rel="stylesheet" href="{{ asset('css/style.css') }} ">
  <!--スマホ,タブレット対応-->
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="csrf-token" content="{{ csrf_token() }}">


  <!-- Scripts -->
  <!--サイトのアイコン指定-->
  <link rel="icon" href="画像URL" sizes="16x16" type="image/png" />
  <link rel="icon" href="画像URL" sizes="32x32" type="image/png" />
  <link rel="icon" href="画像URL" sizes="48x48" type="image/png" />
  <link rel="icon" href="画像URL" sizes="62x62" type="image/png" />
  <!--iphoneのアプリアイコン指定-->
  <link rel="apple-touch-icon-precomposed" href="画像のURL" />
  <!--OGPタグ/twitterカード-->
</head>


<body>
  <header>
    @include('layouts.navigation')
    <div class = "accordion-menu">
      <div class = "accordion">
        <div class = "accordion-item">
          <p>{{ Auth::user()->username }}さん</p>
           <div class="icon">
          <img src="{{ asset('images/icon' . (Auth::id() % 7 + 1) . '.png') }}">
        </div>
      </div>
    <div class ="accordion-header">
      <span class = "allow"></span>
      <div class = "accordion-content">
        <ul>
          <li><a href="top">HOME</a></li>
          <li><a href="profile" class = "profile">プロフィール編集</a></li>
          <li>
            <a href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">ログアウト</a>
            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
               @csrf
            </form>
          </li>
        </ul>
          </div>
        </div>
      </div>
    </div>
  </form>
</header>


<!-- Page Content -->
<div id="row">
  <div id="container">
      @yield('content')
      {{$slot}}
  </div>
  <div id="side-bar">
      <div id="confirm">
        <!-- ユーザー名が表示されるように下記を記述 -->
        <p>{{Auth::user()->username}}さんの</p>
        <div>
          <p>フォロー数</p>
          <p>{{ Auth::user()->follows()->get()->count() }}名</p>
          <!-- ↑ログイン中のユーザーでフォローしている数をカウントして表示 -->
        </div>
        <p class="btn"><a href="follow-list">フォローリスト</a></p>
        <div>
          <p>フォロワー数</p>
          <p>{{ Auth::user()->followers()->get()->count() }}名</p>
          <!-- ↑ログイン中のユーザーでフォローされている数をカウントして表示 -->
        </div>
        <p class="btn"><a href="follower-list">フォロワーリスト</a></p>
      </div>
      <p class="btn"><a href="search">ユーザー検索</a></p>
    </div>
  <footer>
  </footer>
  <script src="{{ asset('js/app.js') }}"></script>
</div>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="{{ asset('js/script.js') }}"></script>
</body>
</html>
