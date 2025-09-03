<x-login-layout>

<!-- 新規投稿フォーム -->
<div class="new-post-icon">
  @if(Auth::user()->icon_image) <!-- ←icon_imageはカラム名 -->
  <img src="{{asset('storage/' . Auth::user()->icon_image)}}">
    @else
    <img src="{{ asset('images/icon1.png') }}">
    <!-- <img src="{{ asset('images/icon' . (Auth::id() % 7 + 1) . '.    png') }}"> -->
   @endif
 </div>
  <form action="{{ route('posts.store') }}" method = "POST">
    @csrf
    <textarea name="post" class="new-post-form" placeholder="投稿内容を入力してください。"></textarea>
    <button id = "post-form-btn"><i class = "fas fa-post"></i>
      <img src="{{ asset('images/post.png') }}" class="post-btn">
    </button>
</form>


<!-- 自分＆フォローしている人の投稿を表示 -->
  @if($posts->isNotEmpty())
    <div class="posts-container">
      @foreach($posts as $post)
        <article class="post-form-before">
          <div class="post-icon-before">
              @if($post->user->icon_image)
              <img src="{{asset('storage/' . $post->user->icon_image)}}">
              @else
             <img src="{{ asset('images/icon1.png') }}">
            <!-- <img src="{{ asset('images/icon' . ($post->user->id % 7 + 1) . '.png') }}"> -->
            @endif
          </div>
          <div class="post-content-container">
            <p id="post-username">{{ $post->user->username }}</p>
            <p id="post-content">{{ $post->post }}</p>
          <div class="post-time">
            <p>{{ $post->created_at->format('Y-m-d h:i') }}</p>
          </div>


            <!-- 自分の投稿の編集 -->
             @if(Auth::id() === $post->user_id)
             <!-- ↑Auth::id()でログインユーザーのユーザーIDを取得
              ===で同じユーザーかどうか確認
              $post->user_idで投稿者のID
               ↑投稿者のIDが自分と同じか確認して編集ボタンを表示 -->
             <div class="content">
               <div class="js-modal-open" post="{{ $post->post }}" post_id="{{ $post->id }}">
                 <!-- ↑routeで{id}を記述していてidを送るから{}内の記述がいる -->
                 <!-- ↑編集のモーダルを表示させるため -->
                 <button class = "post-edit">
                   <img src="{{ asset('images/edit.png') }}" class = "edit-btn">
                  </button>
                </div>

              <!-- 投稿の削除ボタン -->
              <div class="destroy-content">
                <form action="{{ route('posts.destroy',['id'=>$post->id])}}" method="POST" onsubmit="return confirm('この投稿を削除します。よろしいでしょうか？');">
                  @csrf
                  @method('DELETE')
                  <button class = "post-destroy-btn">
                  <img src="{{ asset('images/trash.png') }}" class = "destroy-btn">
                 </button>
                </form>
            </div>
            @endif
          </div>
        </article>
      @endforeach
    </div>

    <!-- 編集のモーダルの中身 -->
    <div class="modal js-modal {{ $errors->has('post') ? 'is-active' : '' }}">
      <div class = "modal_bg js-modal-close"></div>
      <div class ="modal_content">
        <form action="{{ route('posts.update',['id'=>$post->post]) }}" class="modal-form" method="POST">
          @csrf
          @method('PUT')
          <textarea name="post" class="modal_post"></textarea>
           <input type="hidden" class="modal_id" name="id" value="{{ $post->id }}">
           <!-- ↑routeで{id}を記述していてidを送るから{}内の記述がいる -->
            <button type="submit" class = "post-more-edit">
            <img src="{{ asset('images/edit.png') }}" class = "edit-more-btn">
          </button>


           @error('post')
           <div class="post-error"><span>{{ $message }}</span>
          </div>
          @enderror
          <!-- <input type="submit" value="更新">
          {{ csrf_field() }} -->
          </form>
        </div>
      </div>
      @endif
    </x-login-layout>
