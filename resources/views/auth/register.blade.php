<x-logout-layout>

<!-- CSS 読み込み -->
    <link rel="stylesheet" href="{{ asset('css/register.css') }}">

    <div class="form-background">
        {!! Form::open(['url' => '/register']) !!}
        @csrf   <!-- これを追加 -->

        <h2>新規ユーザー登録</h2>

        <div class="form-group">
            {{ Form::label('ユーザー名') }}
            {{ Form::text('username', null, ['class' => 'input']) }}
        </div>

        <div class="form-group">
            {{ Form::label('メールアドレス') }}
            {{ Form::email('email', null, ['class' => 'input']) }}
        </div>

        <div class="form-group">
            {{ Form::label('パスワード') }}
            {{ Form::password('password', ['class' => 'input']) }}
        </div>

        <div class="form-group">
            {{ Form::label('パスワード確認') }}
            {{ Form::password('password_confirmation', ['class' => 'input']) }}
        </div>

        <div class="form-actions">
    {{ Form::submit('新規登録', ['class' => 'submit-btn']) }}
    <a href="{{ url('login') }}" class="form-login-link">ログイン画面へ戻る</a>
</div>

        {!! Form::close() !!}
    </div>
</x-logout-layout>
