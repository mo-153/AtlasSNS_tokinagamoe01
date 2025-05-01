<x-login-layout>

<!-- 新規投稿フォーム -->
<div class="new-post-icon">
  <img src="{{ asset('images/icon' . (Auth::id() % 7 + 1) . '.png') }}">
</div>

  <form action="{{ route('posts.store') }}" method = "post">
    @csrf
    <textarea name="new-post-form" class="new-post-form" placeholder="投稿内容を入力してください。"></textarea>
    <button id = "post-form-btn"><i class = "fas fa-post"></i>
      <img src="{{ asset('images/post.png') }}" class="post-btn">

    </button>
</form>


<!-- 自分＆フォローしている人の投稿を表示 -->
<div class="post-icon-before">
  <img src="{{ asset('images/icon' . (Auth::id() % 7 + 1) . '.png') }}">
  </div>

  <article class="post-form-before">
    @foreach($posts as $post)
    <p>名前:{{ $post->user->username }}</p>
    <p>投稿内容:{{ $post->post }}</p>
    @endforeach
  </article>

  </x-login-layout>
