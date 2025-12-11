<x-logout-layout>

    <link rel="stylesheet" href="{{ asset('css/register.css') }}">

    <div class="form-background">
        {!! Form::open(['url' => '/register']) !!}
        @csrf

        <h2>新規ユーザー登録</h2>

        {{-- ユーザー名 --}}
        <div class="form-group">
            {{ Form::label('ユーザー名') }}
            {{ Form::text('username', old('username'), ['class' => 'input']) }}

            @if ($errors->has('username'))
                <div class="error">{{ $errors->first('username') }}</div>
            @endif
        </div>

        {{-- メール --}}
        <div class="form-group">
            {{ Form::label('メールアドレス') }}
            {{ Form::email('email', old('email'), ['class' => 'input']) }}

            @if ($errors->has('email'))
                <div class="error">{{ $errors->first('email') }}</div>
            @endif
        </div>

        {{-- パスワード --}}
        <div class="form-group">
            {{ Form::label('パスワード') }}
            {{ Form::password('password', ['class' => 'input']) }}

            @if ($errors->has('password'))
                <div class="error">{{ $errors->first('password') }}</div>
            @endif
        </div>

        {{-- パスワード確認 --}}
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
