<x-login-layout>
  <div class="main-container">
    <div class="left-content">

      <!-- 投稿フォーム -->
      <div class="post-area">
        <div class="post-user-icon">
          <img src="{{ Auth::user()->icon_image
                       ? asset('storage/icons/' . Auth::user()->icon_image)
                       : asset('storage/icons/icon1.png') }}"
               alt="ユーザーアイコン" class="icon-img">
        </div>

        <form action="{{ route('posts.store') }}" method="POST" class="post-form">
          @csrf
          <textarea name="post" class="post-text" placeholder="投稿内容を入力してください。" required></textarea>
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
              <img src="{{ $post->user->icon_image
                           ? asset('storage/icons/' . $post->user->icon_image)
                           : asset('storage/icons/icon1.png') }}"
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

  <!-- 編集モーダル -->
  <div id="editModal" class="modal" style="display:none;">
    <div class="modal-content">
      <span id="closeModal" class="close">&times;</span>

      <form id="editForm" method="POST">
        @csrf
        @method('PUT')
        <textarea name="post" id="editPostText" required></textarea>
        <button type="submit">更新</button>
      </form>
    </div>
  </div>

  <script>
    document.addEventListener('DOMContentLoaded', function () {
      const modal = document.getElementById('editModal');
      const closeBtn = document.getElementById('closeModal');
      const editForm = document.getElementById('editForm');
      const editText = document.getElementById('editPostText');

      document.querySelectorAll('.edit-btn').forEach(btn => {
        btn.addEventListener('click', function () {
          const postId = this.dataset.postId;
          const postContent = this.dataset.postContent;

          editForm.action = `/posts/${postId}`;
          editText.value = postContent;
          modal.style.display = 'block';
        });
      });

      closeBtn.addEventListener('click', () => modal.style.display = 'none');
      window.addEventListener('click', (e) => {
        if (e.target === modal) modal.style.display = 'none';
      });
    });
  </script>

</x-login-layout>
