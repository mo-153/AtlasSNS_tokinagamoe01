<x-login-layout>
  <!-- 自分のプロフィール編集 -->
     @if(Auth::id()===$user->id)
      <!-- ↑自分のidかどうか確認してプロフィール編集できるようにする -->
         <div class="my-profile-edit">
           <form action="{{ route('profiles.update')}}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="my-profile-icon">
              @if($user->image)
              <img src="{{asset('storage/' . $user->image)}}">
              @else
            <img src="{{ asset('images/icon' . (Auth::id() % 7 + 1) . '.png') }}">
            @endif
          </div>
          <!-- ↑アイコン画像を更新したらそれを表示
          　もしアイコン画像を更新していなければ初期でimagesの中の画像を表示 -->

          <div class="edit-form">
            <p id="profile-list">ユーザー名</p>
            <input type="text" name="username" class="profile-list-edit" value="{{ Auth::user()->username }}">
            @error('username')
            <div class="edit-error"><span>{{$message}}</span></div>
            @enderror

            <p id="profile-list">メールアドレス</p>
            <input type="email" name="email" class="profile-list-edit" value="{{ Auth::user()->email }}">
            @error('email')
            <div class="edit-error"><span>{{$message}}</span></div>
            @enderror

            <p id="profile-list">パスワード</p>
            <input type="password" name="password" class="profile-list-edit">
             @error('password')
             <div class="edit-error"><span>{{$message}}</span></div>
            @enderror

            <p id="profile-list">パスワード確認</p>
            <input type="password" name="password_confirmation" class="profile-list-edit">
            @error('password_confirmation')
            <div class="edit-error"><span>{{$message}}</span></div>
            @enderror

            <p id="profile-list">自己紹介</p>
          <textarea name="bio" maxlength="150" class="profile-bio-edit">{{ $user->bio }}</textarea>
          @error('bio')
          <div class="edit-error"><span>{{$message}}</span></div>
            @enderror

            <p id="profile-list">アイコン画像</p>
            <div class="icon-edit">
              <input type="file" name="image" class="profile-icon-edit" accept="jpg,png,bmp,gif,svg">
              @error('image')
              <div class="edit-error"><span>{{$message}}</span></div>
            @enderror

            </div>
          </div>
          <div class="profile-update-btn">
           <button type="submit" class=update-button>更新</button>
           </div>
         </form>
        </div>
          @endif
</x-login-layout>
