@extends('layouts.login')
@section('content')
<div class = "search">
  <form action="{{ route('search') }}" method = "get">
    <input type="text" name = "search" placeholder = "ユーザー名">
    <button id = "search-btn"><i class = "fas fa-search"></i></button>
  </form>
</div>

@if(isset($date) && $date->isNotEmpty())
    @foreach($date as $user)
        @if ($user->id !== Auth::id())
        <div class="search_username">{{ $user->username }}</div>
        @endif

        <!-- フォロー・フォロー解除ボタン -->
         <div class="follow-btn">
           <form action="{{ route($user->is_followed ? 'unfollow' : 'follow') }}" method="post" >
             @csrf
             <input type="hidden" name="user_id" value="{{ $user->id }}">
             <button type="submit" class="btn btn-primary" >
                {{ $user->is_followed ? 'フォロー解除' : 'フォローする' }}
              </button>
            </form>
          </div>
    @endforeach
@endif
