<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use Illuminate\Support\Facades\Auth;

class PostsController extends Controller
{
    /**
     * トップページ（投稿一覧）
     */
    public function index()
    {
        $user = Auth::user();

        // 投稿一覧を新しい順で取得（ユーザー情報も取得）
        $posts = Post::with('user')->latest()->get();

        return view('posts.index', compact('user', 'posts'));
    }

    /**
     * 投稿処理
     */
    public function store(Request $request)
    {
        // ✅ バリデーション（カラム名 post に合わせる）
        $validated = $request->validate([
            'post' => 'required|string|min:1|max:150',
        ], [
            'post.required' => '投稿内容を入力してください。',
            'post.min' => '投稿内容は1文字以上で入力してください。',
            'post.max' => '投稿内容は150文字以内で入力してください。',
        ]);

        // ✅ 保存処理
        Post::create([
            'user_id' => Auth::id(),
            'post' => $validated['post'],
        ]);

        // ✅ 投稿後リダイレクト
        return redirect()->route('top')->with('success', '投稿が完了しました！');
    }

    public function update(Request $request, $id)
{
    $post = Post::findOrFail($id);

    // 自分の投稿か確認
    if ($post->user_id !== auth()->id()) {
        abort(403);
    }

    $request->validate([
        'post' => 'required|string|max:500',
    ]);

    $post->post = $request->post;
    $post->save();

    return redirect()->back()->with('success', '投稿を更新しました');
}

    public function destroy($id)
{
    // 該当投稿を取得
    $post = Post::findOrFail($id);

    // 自分の投稿以外は削除不可
    if ($post->user_id !== Auth::id()) {
        abort(403, '他のユーザーの投稿は削除できません。');
    }

    // 削除実行
    $post->delete();

    // トップにリダイレクト
    return redirect()->route('top')->with('success', '投稿を削除しました。');
}

}
