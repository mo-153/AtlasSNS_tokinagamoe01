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
    <div class="posts-container">
      @foreach($posts as $post)
        <article class="post-form-before">
          <div class="post-icon-before">
            <img src="{{ asset('images/icon' . ($post->user->id % 7 + 1) . '.png') }}">
          </div>
          <div class="post-content-container">
            <p id="post-username">{{ $post->user->username }}</p>
            <p id="post-content">{{ $post->post }}</p>
          </div>
        </article>
      @endforeach
    </div>
  @endif
</x-login-layout>
