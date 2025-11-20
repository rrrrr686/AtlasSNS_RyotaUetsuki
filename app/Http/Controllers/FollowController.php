<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class FollowController extends Controller
{
    /**
     * フォローする（store）
     * POST /follow/{user}
     */
    public function store($userId)
    {
        $me = Auth::user();

        // 自分自身にはフォローできない
        if ($me->id == $userId) {
            return back()->with('error', '自分はフォローできません。');
        }

        // 対象ユーザーが存在するか
        $target = User::find($userId);
        if (! $target) {
            return back()->with('error', 'ユーザーが見つかりません。');
        }

        // すでにフォローしていなければ attach（belongsToMany を使っている前提）
        if (! in_array($userId, $me->followings()->pluck('followed_id')->toArray())) {
            $me->followings()->attach($userId);
        }

        return back()->with('success', 'フォローしました。');
    }

    /**
     * フォロー解除（destroy）
     * POST /unfollow/{user}
     */
    public function destroy($userId)
    {
        $me = Auth::user();

        // 対象ユーザーが存在するか
        $target = User::find($userId);
        if (! $target) {
            return back()->with('error', 'ユーザーが見つかりません。');
        }

        // detach（存在しなくてもエラーにはならない）
        $me->followings()->detach($userId);

        return back()->with('success', 'フォローを解除しました。');
    }
}
