<x-login-layout>
  <div class="main-container">
    <div class="left-content">

      <!-- 投稿フォーム -->
      <div class="post-area">
        <div class="post-user-icon">
          <img src="{{ Auth::user()->images
         ? asset('storage/icons/' . Auth::user()->images)
         : asset('images/icon1.png') }}"
     alt="ユーザーアイコン" class="icon-img">

        </div>

        <form action="{{ route('posts.store') }}" method="POST" class="post-form">
    @csrf
    <textarea name="post" class="post-text" placeholder="投稿内容を入力してください。" required>{{ old('post') }}</textarea>

    {{-- 投稿のバリデーションエラー表示 --}}
    @if ($errors->has('post'))
        <div class="error" style="color:red; font-size:14px; margin-top:5px;">
            {{ $errors->first('post') }}
        </div>
    @endif

    <button type="submit" class="post-btn">
        <img src="{{ asset('images/post.png') }}" alt="投稿" class="post-icon">
    </button>
</form>

      </div>

      <!-- 投稿一覧 -->
      <div class="posts-list">
        @foreach ($posts as $post)
          <div class="post-item profile-post-item">

            <!-- 左：アイコン -->
            <div class="post-user-icon-wrapper">
              <img src="{{ $post->user->images
         ? asset('storage/icons/' . $post->user->images)
         : asset('images/icon1.png') }}"
     alt="ユーザーアイコン" class="post-user-icon">

            </div>

            <!-- 右：ユーザー名＋投稿文＋日時 -->
            <div class="profile-post-content">
              <span class="post-username">{{ $post->user->username }}</span>
              <p class="post-content">{{ $post->post }}</p>
              <span class="profile-post-date">{{ $post->created_at->format('Y/m/d H:i') }}</span>

              @if ($post->user_id === Auth::id())
              <div class="post-actions">
                <!-- 編集ボタン -->
                <button class="edit-btn" data-post-id="{{ $post->id }}" data-post-content="{{ $post->post }}">
                  <img src="{{ asset('images/edit.png') }}" alt="編集" class="action-icon edit-icon">
                </button>

                <!-- 削除ボタン -->
                <form action="{{ route('posts.destroy', $post->id) }}" method="POST" class="delete-form">
                  @csrf
                  @method('DELETE')
                  <button type="submit" class="delete-btn"
                          onclick="return confirm('この投稿を削除します。よろしいでしょうか？');">
                    <img src="{{ asset('images/trash.png') }}" alt="削除" class="action-icon delete-icon">
                  </button>
                </form>
              </div>
              @endif

            </div>
          </div>
        @endforeach
      </div>

    </div>
  </div>

<!-- モーダル背景 -->
<div id="editModal" class="modal-overlay" style="display:none;">
    <!-- モーダル内容 -->
    <div class="modal-content">
        <form id="editForm" method="POST">
            @csrf
            @method('PUT')

            <textarea name="post" id="editPostText" class="edit-textarea"></textarea>

            <!-- 更新ボタン -->
            <button type="submit" class="edit-submit-btn">
                <img src="{{ asset('images/edit.png') }}" alt="編集" class="action-icon edit-icon">
            </button>
        </form>
    </div>
</div>



<script>
document.addEventListener('DOMContentLoaded', function () {
  const modal = document.getElementById('editModal');
  const editForm = document.getElementById('editForm');
  const editText = document.getElementById('editPostText');

  document.querySelectorAll('.edit-btn').forEach(btn => {
    btn.addEventListener('click', function (e) {
      e.preventDefault();

      const postId = this.dataset.postId;
      const postContent = this.dataset.postContent;

      editForm.action = `/posts/${postId}`;
      editText.value = postContent;

      modal.style.display = 'block';
    });
  });

  // 背景クリックで閉じる
  window.addEventListener('click', function (e) {
    if (e.target === modal) {
      modal.style.display = 'none';
    }
  });
});
</script>

</x-login-layout>
