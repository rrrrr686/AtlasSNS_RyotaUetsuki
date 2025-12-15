

<header class="header-blue">
    <div class="header-inner">
        <!-- 左側：ロゴ -->
        <div class="logo">
            <a href="{{ route('top') }}">
                <img src="{{ asset('images/atlas.png') }}" alt="AtlasSNSロゴ">
            </a>
        </div>

            <!-- 右側：ユーザー情報と矢印アイコン -->
            <div class="user-info">
            <div class="accordion-header" id="menu-toggle">
                <p>{{ Auth::user()->username }} さん</p>
                <span class="arrow">❮</span>
                <img
    src="{{ asset(
        Auth::user()->images === 'icon1.png'
            ? 'images/icon1.png'
            : 'storage/icons/' . Auth::user()->images
    ) }}"
    alt="ユーザーアイコン"
    class="user-icon"
>



            <!-- ドロップダウンメニュー -->
            <ul class="accordion-content" id="dropdown-menu">
                <li><a href="{{ route('top') }}">HOME</a></li>
                <li><a href="{{ route('profile.edit') }}">プロフィール編集</a></li>
                <li>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="logout-btn">ログアウト</button>
                    </form>
                </li>
            </ul>
        </div>
    </div>
</header>

<script>
document.addEventListener('DOMContentLoaded', () => {
    const toggle = document.getElementById('menu-toggle');      // 名前＋矢印＋アイコン
    const dropdown = document.getElementById('dropdown-menu');  // ドロップダウン
    const arrow = toggle.querySelector('.arrow');               // ▼の部分

    // ▼ クリックで開閉
    toggle.addEventListener('click', (event) => {
        dropdown.classList.toggle('active');   // メニュー開閉
        arrow.classList.toggle('rotate');      // 矢印回転
        event.stopPropagation();               // 外側への伝播防止
    });

    // ▼ 外をクリックしたら閉じる
    document.addEventListener('click', (event) => {
        if (!toggle.contains(event.target) && !dropdown.contains(event.target)) {
            dropdown.classList.remove('active');
            arrow.classList.remove('rotate');  // 回転解除
        }
    });
});
</script>
