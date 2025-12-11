<x-login-layout>

    <div class="profile-header-container">

        <div class="profile-header-wrapper">

            <!-- 左：アイコン -->
            <div class="profile-header-icon">
                <img src="{{ $user->images
    ? asset('storage/icons/' . $user->images)
    : asset('images/icon1.png') }}"
    alt="icon" class="profile-header-user-icon">

            </div>

            <!-- 右：ユーザー情報とフォローボタンを横並び -->
            <div class="profile-header-right">
            <!-- 右：ユーザー名 & 自己紹介 -->
            <div class="profile-header-info">

                <div class="profile-header-row">
                    <span class="profile-header-label">ユーザー名</span>
                    <span class="profile-header-value">{{ $user->username }}</span>
                </div>

                <div class="profile-header-row">
                    <span class="profile-header-label">自己紹介</span>
                    <span class="profile-header-value">
                        {{ $user->bio ?: '未登録です。' }}
                    </span>
                </div>
            </div>

            <!-- フォロー/フォロー解除ボタン -->
        @if(auth()->id() !== $user->id)
            @if(in_array($user->id, $followedUserIds))
                <form action="{{ route('unfollow', $user->id) }}" method="POST" class="follow-form">
                    @csrf
                    <button type="submit" class="btn-unfollow">フォロー解除</button>
                </form>
            @else
                <form action="{{ route('follow', $user->id) }}" method="POST" class="follow-form">
                    @csrf
                    <button type="submit" class="btn-follow">フォローする</button>
                </form>
            @endif
        @endif
    </div>

        </div>

        <!-- ▼▼ 投稿一覧 ▼▼ -->
@if(isset($posts))
    <div class="profile-posts">

        @forelse($posts as $post)
            <div class="profile-post-item">

                <!-- 左：投稿者アイコン -->
                <img src="{{ $post->user->images
            ? asset('storage/icons/' . $post->user->images)
            : asset('images/icon1.png') }}"
    alt="icon" class="post-user-icon">

                <!-- 右：ユーザー名 + 投稿文 -->
                <div class="profile-post-content">
                    <span class="post-username">{{ $post->user->username }}</span>
                    <p class="post-content">{{ $post->post }}</p>
                    <span class="profile-post-date">{{ $post->created_at->format('Y-m-d H:i') }}</span>
                </div>

            </div>
        @empty
            <p>投稿はありません。</p>
        @endforelse

    </div>
@endif



    </div>

</x-login-layout>
