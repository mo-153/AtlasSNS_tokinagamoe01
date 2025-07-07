<x-login-layout>
  <!-- フォローリストの表示 -->
      <article class="follow-list">
       <h2 class=follow-list-title>フォローリスト</h2>
       <div class="follow-icons">
         @foreach($follows as $follow)
         <div class="follow-icon">
           <img src="{{ asset('images/icon' . ($follow->id % 7 + 1) . '.png') }}">
          </div>
          @endforeach
        </div>
      </article>

      <!-- フォローユーザーの投稿表示 -->
      <div class="follow-post-container">
        @foreach($posts as $post)
        <article class="follow-post">
          <div class="post-follow-icon">
            <a href="{{ route('profiles.profile', ['id' => $post->user->id]) }}">
              <img src="{{ asset('images/icon' . ($post->user->id % 7 + 1) . '.png') }}">
            </a>
          </div>
          <div class="follow-post-content">
            <p id="follow-username">{{ $post->user->username }}</p>
            <p id="follow-content">{{ $post->post }}</p>
              </div>
            </article>
            @endforeach
          </div>
        </x-login-layout>
