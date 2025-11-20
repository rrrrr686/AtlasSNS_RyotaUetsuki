<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use App\Models\Post; // 投稿モデル

class UsersController extends Controller
{
    // 検索ページ（初期表示）
    public function index()
    {
        // 自分以外を全件取得
        $users = User::where('id', '!=', Auth::id())->get();

        // 自分がフォローしているユーザーIDを取得
        $followedUserIds = Auth::user()->followings()->pluck('followed_id')->toArray();

        return view('users.search', compact('users', 'followedUserIds'));
    }

    // 検索処理
    public function search(Request $request)
    {
        $keyword = $request->input('keyword');

        $users = User::query()
            ->where('id', '!=', Auth::id())
            ->when($keyword, function ($query, $keyword) {
                $query->where('username', 'like', "%{$keyword}%");
            })
            ->get();

        // フォローしているID（検索時も必要）
        $followedUserIds = Auth::user()->followings()->pluck('followed_id')->toArray();

        return view('users.search', compact('users', 'keyword', 'followedUserIds'));
    }

    // フォローリスト
    public function followList()
{
    // ログインユーザー
    $user = Auth::user();

    // 自分がフォローしているユーザーを取得
    $followings = $user->followings()->get();

    // フォローしている人のID配列
    $followingIds = $followings->pluck('id')->toArray();

    // フォロー中ユーザーの投稿を取得（最新順）
    $posts = Post::whereIn('user_id', $followingIds)
                 ->with('user') // 投稿者情報もまとめて取得
                 ->orderBy('created_at', 'desc')
                 ->get();

    return view('users.follow_list', compact('followings', 'posts'));
}

// フォロワーリスト

public function followerList()
{
    $user = Auth::user();

    // 自分をフォローしているユーザー（フォロワー）
    $followers = $user->followers()->get();

    // フォロワーの ID を取得
    $followerIds = $followers->pluck('id')->toArray();

    // フォロワーの投稿を取得（最新順）
    $posts = Post::whereIn('user_id', $followerIds)
                 ->with('user')
                 ->orderBy('created_at', 'desc')
                 ->get();

    return view('users.follower_list', compact('followers', 'posts'));
}


public function show($id)
{
    // 相手ユーザーを取得
    $user = User::findOrFail($id);

    // 相手ユーザーの投稿を取得（新しい順）
    $posts = Post::where('user_id', $id)
                ->orderBy('created_at', 'desc')
                ->get();

    // 自分がフォローしているユーザーのID一覧を取得
    $followedUserIds = auth()->user()->followings()->pluck('users.id')->toArray();

    // Blade に渡す
    return view('profiles.show', compact('user', 'posts', 'followedUserIds'));
}

}
