<x-login-layout>
      <form action="{{ route('posts.index') }}" method = "get">
        @foreach($posts as $post)
        <p>名前:{{ $post->user->username }}</p>
        <p>投稿内容:{{ $post->post }}</p>
        @endforeach
      </form>
</x-login-layout>
