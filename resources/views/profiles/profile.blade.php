<x-login-layout>
  <!-- プロフィールページの一番上、自己紹介部分 -->
<article class="profile-content">
  <div class="user-profile">
  <p>ユーザー名 {{ $user->username }}</p>
  <p>自己紹介</p>
  <div class="user-profile-icon">
    <img src="{{ asset('images/icon' . ($user->id % 7 + 1) . '.png') }}">
  </div>
  <div class="follow-btn">
<button type="button" class="btn follow-toggle {{ $user->is_followed ? 'btn-danger' : 'btn-primary' }}" data-user-id="{{ $user->id }}" data-follow="{{ $user->is_followed ? 'true' : 'false' }}">
  {{ $user->is_followed ? 'フォロー解除' : 'フォローする' }}
</button>
   </div>


</div>
</article>

<!-- 過去の投稿表示 -->
<div class="follow-user-post">
        @foreach($posts as $post)
        <article class="user-posts">
          <div class="users-icon">
            <a href="{{ route('profiles.profile', ['id' => $post->user->id]) }}">
              <img src="{{ asset('images/icon' . ($post->user->id % 7 + 1) . '.png') }}">
            </a>
          </div>
          <div class="users-post-content">
            <p id="follow-username">{{ $post->user->username }}</p>
            <p id="follow-content">{{ $post->post }}</p>
              </div>
            </article>
            @endforeach
          </div>
</x-login-layout>
