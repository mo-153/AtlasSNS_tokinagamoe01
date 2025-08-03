<x-login-layout>
  <!-- 自分のプロフィール編集 -->
     @if(Auth::id()===$user->id)
      <!-- ↑自分のidかどうか確認してプロフィール編集できるようにする -->
         <div class="my-profile-edit">
           <form action="{{ route('profiles.update')}}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="my-profile-icon">
            <img src="{{ asset('images/icon' . (Auth::id() % 7 + 1) . '.png') }}">
          </div>

          <div class="edit-form">
            <p id="profile-list">ユーザー名</p>
            <input type="text" name="username" class="profile-list-edit" value="{{ Auth::user()->username }}">
            <p id="profile-list">メールアドレス</p>
            <input type="email" name="email" class="profile-list-edit" value="{{ Auth::user()->email }}">
            <p id="profile-list">パスワード</p>
            <input type="password" name="password" class="profile-list-edit">
            <p id="profile-list">パスワード確認</p>
            <input type="password" name="password_confirmation" class="profile-list-edit">
            <p id="profile-list">自己紹介</p>
          <textarea name="bio" maxlength="150" class="profile-bio-edit">{{ $user->bio }}</textarea>
            <p id="profile-list">アイコン画像</p>
            <div class="icon-edit">
              <input type="file" name="image" class="profile-icon-edit" accept="jpg,png,bmp,gif,svg">
            </div>
          </div>
          <div class="profile-update-btn">
           <button type="submit" class=update-button>更新</button>
           </div>
         </form>
        </div>
          @endif
</x-login-layout>
