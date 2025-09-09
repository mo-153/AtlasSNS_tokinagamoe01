<x-login-layout>
  <head>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!-- ↑セキュリティ対策 -->
  </head>

  <div class = "search">
    <form action="{{ route('search') }}" method = "get">
      <input type="text" name = "search" placeholder = "ユーザー名">
      <button id = "search-form"><i class = "fas fa-search"></i>
      <img src="{{ asset('images/search.png') }}" class="search-btn">
    </button>
      @if(isset($keyword))
      <p id="search-word">検索ワード：{{$keyword}}</p>
      @endif
    </form>
  </div>




@if(isset($users) && $users->isNotEmpty())
<div class= "search-content">
@foreach($users as $user)
@if ($user->id !== Auth::id())
          <div class="user-icon">
              @if( $user->icon_image && $user->icon_image !== 'icon1.png')
             <img src="{{asset('storage/' . $user->icon_image)}}">
              @else
              <img src="{{ asset('images/icon1.png') }}">
            <!-- <img src="{{ asset('images/icon' . ($user->id % 7 + 1) . '.png') }}"> -->
            @endif

            </div>
            <div class="search_username">{{ $user->username }}</div>
            <div class="follow-btn">
              <!-- フォロー・フォロー解除ボタン -->
            <button type="button" class="btn follow-toggle {{ $user->is_followed ? 'btn-danger' : 'btn-primary' }}" data-user-id="{{ $user->id }}" data-follow="{{ $user->is_followed ? 'true' : 'false' }}">
              {{ $user->is_followed ? 'フォロー解除' : 'フォローする' }}
            </button>
        </div>
        @endif
        @endforeach
      </div>
@endif
</x-login-layout>
<!-- ↑ページ全体の見た目を統一するために必要 -->
