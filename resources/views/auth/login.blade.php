<x-logout-layout>

<!-- 新規登録ページと同じCSSを読み込む -->
  <link rel="stylesheet" href="{{ asset('css/register.css') }}">

  <!-- 適切なURLを入力してください -->
    <div class="login-container">
  {!! Form::open(['url' => '/login', 'method' => 'post']) !!}

  <h2 class="form-title">AtlasSNSへようこそ</h2>

  <div class="form-group">
      {{ Form::label('メールアドレス') }}
      {{ Form::email('email', null, ['class' => 'input', 'placeholder' => 'example@mail.com']) }}
    </div>

    <div class="form-group">
      {{ Form::label('パスワード') }}
      {{ Form::password('password', ['class' => 'input', 'placeholder' => '●●●●●●']) }}
    </div>

    <div class="form-submit">
      {{ Form::submit('ログイン', ['class' => 'submit-btn']) }}
    </div>

    <p><a href="{{ url('register') }}" class="form-login-link">新規ユーザーの方はこちら</a></p>

  {!! Form::close() !!}

</x-logout-layout>
