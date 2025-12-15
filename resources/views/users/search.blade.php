<x-login-layout>

<div class="search-wrapper">
{{-- 検索フォーム --}}
<form action="{{ route('users.search') }}" method="GET" class="search-form">
    <input type="text" name="keyword" class="search-input" placeholder="ユーザー名" value="{{ request('keyword') }}">
    <button type="submit" class="search-btn">
        <img src="{{ asset('images/search.png') }}" alt="検索" />
    </button>

{{-- 検索ワードを表示 --}}
    @if(request('keyword'))
        <span class="search-keyword">検索ワード: {{ request('keyword') }}</span>
    @endif

</form>
</div>

{{-- 👤 ユーザー一覧表示 --}}
<div class="user-list search-results">
    @forelse ($users as $user)
        <div class="user-item">
            {{-- ユーザーアイコン --}}
            <img src="{{ asset(
    $user->images === 'icon1.png'
        ? 'images/icon1.png'
        : 'storage/icons/' . $user->images) }}"
     alt="ユーザーアイコン"
     class="user-icon">



            {{-- ユーザー名 --}}
            <span class="username">{{ $user->username }}</span>

            {{-- フォロー/フォロー解除ボタン --}}
            @if(in_array($user->id, $followedUserIds))
                {{-- フォロー解除 --}}
                <form action="{{ route('unfollow', $user->id) }}" method="POST" class="follow-form">
                    @csrf
                    <button type="submit" class="btn-unfollow">フォロー解除</button>
                </form>
            @else
                {{-- フォローする --}}
                <form action="{{ route('follow', $user->id) }}" method="POST" class="follow-form">
                    @csrf
                    <button type="submit" class="btn-follow">フォローする</button>
                </form>
            @endif
        </div>
    @empty
        <p>ユーザーが見つかりませんでした。</p>
    @endforelse
</div>

</x-login-layout>
