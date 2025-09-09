<x-login-layout>
  <!-- 自分のプロフィール編集 -->
     @if(Auth::id()===$user->id)
      <!-- ↑自分のidかどうか確認してプロフィール編集できるようにする -->
         <div class="my-profile-edit">
           <form action="{{ route('profiles.update')}}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="my-profile-icon">
              @if( Auth::user()->icon_image && Auth::user()->icon_image !== 'icon1.png')
               <img src="{{asset('storage/' . $user->icon_image)}}">
              @else
              <img src="{{ asset('images/icon1.png') }}">
            @endif
          </div>

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
              <input type="file" name="icon_image" class="profile-icon-edit" accept="jpg,png,bmp,gif,svg">
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
