<x-login-layout>
  <!-- プロフィールページの一番上、自己紹介部分 -->
<article class="profile-content">
  <div class="user-profile">
    <p>ユーザー名</p>
    <p id="users-name">{{ $user->username }}</p>
    <p>自己紹介</p>
    <p id="users-bio">{{ $user->bio}}</p>
  </div>
    <div class="user-profile-icon">
     @if($user->image)
      <img src="{{asset('storage/' . $user->image)}}">
        @else
         <img src="{{ asset('images/icon' . ($user->id % 7 + 1) . '.png') }}" class="img-icon">
     @endif
   </div>

  <div class="profile-follow-btn">
    <button type="button" class="btn follow-toggle {{ $user->is_followed ? 'btn-danger' : 'btn-primary' }}" data-user-id="{{ $user->id }}" data-follow="{{ $user->is_followed ? 'true' : 'false' }}">
  {{ $user->is_followed ? 'フォロー解除' : 'フォローする' }}
</button>
   </div>
</article>

<!-- 過去の投稿表示 -->
 @if(isset($posts) && $posts->isNotEmpty())
<div class="follow-user-post">
        @foreach($posts as $post)
        <article class="user-posts">
          <div class="users-icon">
            <a href="{{ route('profiles.profile', ['id' => $post->user->id]) }}">
          @if($post->user->image)
      <img src="{{asset('storage/' . $user->image)}}">
        @else
         <img src="{{ asset('images/icon' . ($post->user->id % 7 + 1) . '.png') }}">
         @endif

          </a>
          </div>
          <div class="users-post-content">
            <p id="follow-username">{{ $post->user->username }}</p>
            <p id="users-content">{{ $post->post }}</p>
          </div>
            <div class="posts-time">
            <p>{{ $post->created_at->format('Y-m-d h:i') }}</p>
            </div>
        </article>
        @endforeach
      </div>
      @endif
    </x-login-layout>
