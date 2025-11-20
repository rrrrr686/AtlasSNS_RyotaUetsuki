<x-login-layout>

<div class="follow-list-wrapper">
    <div class="follow-list-header">
        <h2>フォローリスト</h2>
        <div class="followings-icons">
    @forelse($followings as $following)
        <div class="following-item">
            <a href="{{ route('users.profile', $following->id) }}">
                <img src="{{ $following->icon_image
                                     ? asset('storage/icons/' . $following->icon_image)
                                     : asset('storage/icons/icon1.png') }}"
                             alt="ユーザーアイコン" class="user-icon">
            </a>
        </div>
            @empty
                <p>まだフォローしているユーザーはいません。</p>
            @endforelse
        </div>
    </div>

    <hr>

    {{-- フォロー中ユーザーの投稿一覧 --}}
    <div class="followings-posts">
        @forelse($posts as $post)
            <div class="post-item">
        <div class="post-header">
            <a href="{{ route('users.profile', $post->user->id) }}">
                <img src="{{ $post->user->icon_image
                                     ? asset('storage/icons/' . $post->user->icon_image)
                                     : asset('storage/icons/icon1.png') }}"
                             alt="ユーザーアイコン" class="user-icon">
            </a>
            <span class="username">{{ $post->user->username }}</span>
        </div>
        <div class="post-content">
            {{ $post->post }}
        </div>
        <div class="post-date">
            {{ $post->created_at->format('Y/m/d H:i') }}
        </div>
    </div>
        @empty
            <p>まだ投稿はありません。</p>
        @endforelse
    </div>
</div>

</x-login-layout>
