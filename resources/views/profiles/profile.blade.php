<x-login-layout>
    <div id="container">

        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        <div class="profile-wrapper">

            <form action="{{ route('profile.update') }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('POST')

                <!-- 左アイコン -->
                <div class="profile-left">
    <img src="{{ $user->images
    ? asset('storage/icons/' . $user->images)
    : asset('images/icon1.png') }}"
    alt="icon" class="user-icon">
</div>

                <!-- 右フォーム -->
                <div class="profile-right">
                    <!-- ユーザー名 -->
                    <div class="form-group form-inline">
                        <label for="username">ユーザー名</label>
                        <input type="text" name="username" id="username"
                               value="{{ old('username', $user->username) }}">
                        @error('username')
                            <p class="error">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- メールアドレス -->
                    <div class="form-group form-inline">
                        <label for="email">メールアドレス</label>
                        <input type="email" name="email" id="email"
                               value="{{ old('email', $user->email) }}">
                        @error('email')
                            <p class="error">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- パスワード -->
                    <div class="form-group form-inline">
                        <label for="password">パスワード</label>
                        <input type="password" name="password" id="password">
                        @error('password')
                            <p class="error">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- パスワード確認 -->
                    <div class="form-group form-inline">
                        <label for="password_confirmation">パスワード確認</label>
                        <input type="password" name="password_confirmation" id="password_confirmation">
                    </div>

                    <!-- 自己紹介 -->
                    <div class="form-group form-inline">
                        <label for="bio">自己紹介</label>
                        <textarea name="bio" id="bio">{{ old('bio', $user->bio) }}</textarea>
                        @error('bio')
                            <p class="error">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- アイコンアップロード -->
<div class="form-group form-inline">
    <label class="file-text-label">アイコン画像</label>

    <!-- ファイル選択ラベル -->
    <label for="icon_image" class="icon-label">
        ファイルを選択
    </label>

    <input type="file" name="images" id="icon_image" class="icon-input">

    @error('images')
        <p class="error">{{ $message }}</p>
    @enderror
</div>




                    <!-- 更新ボタン -->
                    <div class="form-group">
                        <button type="submit" class="btn-save">更新</button>
                    </div>
                </div>

            </form>
        </div>
    </div>
</x-login-layout>
