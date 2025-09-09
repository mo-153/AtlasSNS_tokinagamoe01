<x-login-layout>
  <!-- フォロワーリストの表示 -->
      <article class="follower-list">
       <h2 class=follower-list-title>フォロワーリスト</h2>
       <div class="follower-icons">
         @foreach($followers as $follower)
         <div class="follower-icon">
          @if( $follower->icon_image && $follower->icon_image !== 'icon1.png')
          <!-- ↑「$follower->icon_image」でフォロワーのアイコンがあるか、「&&」でかつ、「$follower->icon_image !== 'icon1.png'」でフォロワーのアイコン画像が「icon1.png」でないか -->
           <img src="{{ asset('storage/' . $follower->icon_image)}}">
          @else
          <img src="{{ asset('images/icon1.png') }}">
           @endif
           </div>
          @endforeach
        </div>
      </article>

      <!-- フォロワーユーザーの投稿表示 -->
      <div class="follower-post-container">
        @foreach($posts as $post)
        <article class="follower-post">
          <div class="post-follower-icon">
            <a href="{{ route('profiles.profile', ['id' => $post->user->id]) }}">
              @if( $post->user->icon_image && $post->user->icon_image !== 'icon1.png')
              <img src="{{asset('storage/' . $post->user->icon_image)}}">
              @else
              <img src="{{ asset('images/icon1.png') }}">

            <!-- <img src="{{ asset('images/icon' . ($post->user->id % 7 + 1) . '.png') }}"> -->
            @endif

            </a>
          </div>
          <div class="follower-post-content">
            <p id="follower-username">{{ $post->user->username }}</p>
            <p id="follower-content">{{ $post->post }}</p>
              </div>
              <div class="follower-post-time">
            <p>{{ $post->created_at->format('Y-m-d h:i') }}</p>
          </div>
            </article>
            @endforeach
          </div>
        </x-login-layout>
