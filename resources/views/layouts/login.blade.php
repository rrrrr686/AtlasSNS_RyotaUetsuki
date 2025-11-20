<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8">
  <!--IEブラウザ対策-->
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="description" content="ページの内容を表す文章" />
  <title></title>
  <link rel="stylesheet" href="{{ asset('css/reset.css') }}">
  <link rel="stylesheet" href="{{ asset('css/app.css') }}">
  <link rel="stylesheet" href="{{ asset('css/style.css') }}">
  <link rel="stylesheet" href="{{ asset('css/header.css') }}"> <!-- ✅ ヘッダー専用CSS追加 -->
  <!--スマホ,タブレット対応-->
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <!--サイトのアイコン指定-->
  <link rel="icon" href="画像URL" sizes="16x16" type="image/png" />
  <link rel="icon" href="画像URL" sizes="32x32" type="image/png" />
  <link rel="icon" href="画像URL" sizes="48x48" type="image/png" />
  <link rel="icon" href="画像URL" sizes="62x62" type="image/png" />
  <!--iphoneのアプリアイコン指定-->
  <link rel="apple-touch-icon-precomposed" href="画像のURL" />
  <!--OGPタグ/twitterカード-->
</head>

<body>
  <header>
    @include('layouts.navigation')
  </header>

  <!-- Page Content -->
  <div id="row">
    <div id="container">
      {{ $slot }}
    </div>

    <div id="side-bar">
      <div id="confirm">
        <p>{{ Auth::user()->username }} さんの</p>

        <!-- フォロー情報 -->
        <div class="follow-info">
          <div class="follow-count">
            <p>フォロー数</p>
            <span>{{ $followCount ?? 0 }} 人</span>
          </div>
          <p class="btn follow-btn">
            <a href="{{ route('follow.list') }}">フォローリスト</a>
          </p>
        </div>

        <!-- フォロワー情報 -->
        <div class="follow-info">
          <div class="follow-count">
            <p>フォロワー数</p>
            <span>{{ $followerCount ?? 0 }} 人</span>
          </div>
          <p class="btn follow-btn">
            <a href="{{ route('users.followers') }}">フォロワーリスト</a>
          </p>
        </div>

        <!-- ユーザー検索ボタン -->
        <div class="search-area">
          <p class="btn search-btn"><a href="{{ route('search') }}">ユーザー検索</a></p>
        </div>
      </div>
    </div>
  </div>

  <footer>
  </footer>

  <script src="{{ asset('js/app.js') }}"></script>
  <script src="JavaScriptファイルのURL"></script>
  <script src="JavaScriptファイルのURL"></script>
</body>

</html>
