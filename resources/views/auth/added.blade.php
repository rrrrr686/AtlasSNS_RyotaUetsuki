<x-logout-layout>

<!-- register.cssを流用 -->
<link rel="stylesheet" href="{{ asset('css/register.css') }}">

<div class="added-background">
    <p class="bold-white">{{ session('username') }} さん</p>
    <p class="bold-white">ようこそ！AtlasSNSへ</p>

    <p class="light-white">ユーザー登録が完了いたしました。</p>
    <p class="light-white">早速ログインをしてみましょう！</p>


    <a href="{{ url('login') }}" class="submit-btn">ログイン画面へ</a>

</div>
</x-logout-layout>
