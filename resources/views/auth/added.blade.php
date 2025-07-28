<x-logout-layout>
  <div id="clear">
    <div class = "box">
      <div class = "add_users">
        <p>{{ session('username') }}さん</p>
        <p>ようこそ！AtlasSNSへ！</p>
      </div>
      <div class = "add">
        <p>ユーザー登録が完了しました。</p>
        <p>早速ログインをしてみましょう。</p>
      </div>

        <p class="btn"><a href="login">ログイン画面へ</a></p>
    </div>
  </div>


</x-logout-layout>
