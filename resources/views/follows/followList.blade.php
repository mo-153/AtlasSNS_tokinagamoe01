<x-login-layout>
  <!-- フォローリストの表示 -->
      <article class="follow-list">
       <h2 class=follow-list-title>フォローリスト</h2>
       <div class="follow-icons">
         @foreach($follows as $follow)
         <div class="follow-icon">
           @if(!empty($follow->icon_image))
          <img src="{{ asset('storage/' . $follow->icon_image)}}">
          @else
          <img src="{{ asset('images/icon1.png') }}">
          <!-- <img src="{{ asset('images/icon' . ($follow->id % 7 + 1) . '.png') }}"> -->
          @endif
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
             @if(!empty($post->user->icon_image))
              <img src="{{asset('storage/' . $post->user->icon_image)}}">
              @else
              <img src="{{ asset('images/icon1.png') }}">
            <!-- <img src="{{ asset('images/icon' . ($post->user->id % 7 + 1) . '.png') }}"> -->
            @endif
            </a>
          </div>
          <div class="follow-post-content">
            <p id="follow-username">{{ $post->user->username }}</p>
            <p id="follow-content">{{ $post->post }}</p>
              </div>
              <div class="follow-post-time">
              <p>{{ $post->created_at->format('Y-m-d h:i') }}</p>
            </div>
            </article>
            @endforeach
          </div>
        </x-login-layout>
