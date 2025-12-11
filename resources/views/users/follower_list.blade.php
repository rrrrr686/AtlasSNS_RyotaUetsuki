<x-login-layout>

<div class="follow-list-wrapper">
    <div class="follow-list-header">
        <h2>フォロワーリスト</h2>
        <div class="followings-icons">
            @forelse($followers as $follower)
                <div class="following-item">
                    <a href="{{ route('users.profile', $follower->id) }}">
                        <img src="{{ $follower->images
             ? asset('storage/icons/' . $follower->images)
             : asset('images/icon1.png') }}"
     alt="icon" class="user-icon">
                    </a>
                </div>
            @empty
                <p>まだフォローされているユーザーはいません。</p>
            @endforelse
        </div>
    </div>

    <hr>

    {{-- フォロワー（自分をフォローしているユーザー）の投稿一覧 --}}
    <div class="followings-posts">
        @forelse($posts as $post)
            <div class="post-item">
                <div class="post-header">
                    <a href="{{ route('users.profile', $post->user->id) }}">
                        <img src="{{ $post->user->images
             ? asset('storage/icons/' . $post->user->images)
             : asset('images/icon1.png') }}"
     alt="icon" class="user-icon">
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
