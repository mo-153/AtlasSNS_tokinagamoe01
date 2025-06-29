<x-login-layout>
      <article class="follow-list">
       <h2 class=follow-list-title>フォローリスト</h2>
        @foreach($follows as $follow)
        <img src="{{ asset('images/icon' . ($follow->id % 7 + 1) . '.png') }}" class="follow-list-icon">
      </article>
      @endforeach
 </x-login-layout>
