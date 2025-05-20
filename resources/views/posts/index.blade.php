<x-login-layout>

<!-- 新規投稿フォーム -->
<div class="new-post-icon">
  <img src="{{ asset('images/icon' . (Auth::id() % 7 + 1) . '.png') }}">
</div>
  <form action="{{ route('posts.store') }}" method = "POST">
    @csrf
    <textarea name="post" class="new-post-form" placeholder="投稿内容を入力してください。"></textarea>
    <button id = "post-form-btn"><i class = "fas fa-post"></i>
      <img src="{{ asset('images/post.png') }}" class="post-btn">
    </button>
</form>


<!-- 自分＆フォローしている人の投稿を表示 -->
@if($posts->isNotEmpty())
@foreach($posts as $post)
<div class="post-icon-before">
  <!-- ↑投稿がまだないときは投稿の枠が表示されないようにするための記述 -->
  <img src="{{ asset('images/icon' . (Auth::id() % 7 + 1) . '.png') }}">
</div>
<!-- ↓フォロワーさんの投稿が表示されるフォームを作成 -->
<!-- ↓textareaではなく「article」を使用 -->
<article class="post-form-before">
    <p id = "post-username">{{ $post->user->username }}</p>
    <p id = "post-content">{{ $post->post }}</p>
    @endforeach
    @endif
  </article>
</x-login-layout>
