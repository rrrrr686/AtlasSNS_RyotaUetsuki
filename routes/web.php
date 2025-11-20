<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UsersController;
use App\Http\Controllers\PostsController;
use App\Http\Controllers\FollowController;
use Illuminate\Support\Facades\Route;


// 認証ルート（login, registerなど）
require __DIR__ . '/auth.php';

Route::middleware(['auth'])->group(function () {

    // トップページ（投稿一覧）
    Route::get('top', [PostsController::class, 'index'])->name('top');
    Route::post('top', [PostsController::class, 'store'])->name('posts.store');

    // 投稿更新・削除
    Route::put('/posts/{id}', [PostsController::class, 'update'])->name('posts.update');
    Route::delete('/posts/{id}', [PostsController::class, 'destroy'])->name('posts.destroy');

    // プロフィール関連
    Route::get('/profile', [ProfileController::class, 'profile'])->name('profile.edit');
    Route::get('/profile/edit', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::post('/profile/edit', [ProfileController::class, 'update'])->name('profile.update');

    // ユーザー検索
    Route::get('search', [UsersController::class, 'index'])->name('search');
    Route::get('/users/search', [UsersController::class, 'search'])->name('users.search');

    // フォロー／フォロワー操作
    Route::post('/follow/{user}', [FollowController::class, 'store'])->name('follow');
    Route::post('/unfollow/{user}', [FollowController::class, 'destroy'])->name('unfollow');

    // フォローリスト・フォロワーリスト
    Route::get('/follow-list', [UsersController::class, 'followList'])->name('follow.list');
    Route::get('/followers', [UsersController::class, 'followerList'])->name('users.followers');

    // ユーザープロフィール
    Route::get('/users/{id}/profile', [UsersController::class, 'show'])->name('users.profile');
    Route::get('/users/{id}', [UsersController::class, 'show'])->name('users.show');

});

// 新規登録・ログイン関連（誰でもアクセス可能）
Route::get('/register', [App\Http\Controllers\Auth\RegisterController::class, 'showRegistrationForm'])->name('register');
Route::post('/register', [App\Http\Controllers\Auth\RegisterController::class, 'register']);
Route::get('/register/added', [App\Http\Controllers\Auth\RegisterController::class, 'added'])->name('register.added');

Route::get('/login', [App\Http\Controllers\Auth\LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [App\Http\Controllers\Auth\LoginController::class, 'login']);
Route::post('/logout', [App\Http\Controllers\Auth\LoginController::class, 'logout'])->name('logout');
