<x-login-layout>
  <head>
    <meta name="csrf-token" content="{{ csrf_token() }}">
  </head>

  <div class = "search">
    <form action="{{ route('search') }}" method = "get">
      <input type="text" name = "search" placeholder = "ユーザー名">
      <button id = "search-form"><i class = "fas fa-search"></i>
      <img src="{{ asset('images/search.png') }}" class="search-btn">
    </button>
    </form>
  </div>

@if(isset($date) && $date->isNotEmpty())
    @foreach($date as $user)
        @if ($user->id !== Auth::id())
        <div class="user-icon">
          <img src="{{ asset('images/icon' . ($user->id % 7 + 1) . '.png') }}">
        </div>
        <div class="search_username">{{ $user->username }}</div>

        <!-- フォロー・フォロー解除ボタン -->
        <div class="follow-btn">

        <button type="button" class="btn btn-primary follow-toggle" data-user-id="{{ $user->id }}" data-follow="{{ $user->is_followed ? 'true' : 'false' }}">
          {{ $user->is_followed ? 'フォロー解除' : 'フォローする' }}
        </button>
        </div>
          @endif
    @endforeach
@endif
</x-login-layout>
