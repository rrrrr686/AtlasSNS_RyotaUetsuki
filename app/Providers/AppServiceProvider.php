<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
// ▼ ここを追加
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\View;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
{
    // ログイン中のユーザーに共通データを渡す
    View::composer('*', function ($view) {
        if (Auth::check()) {
            $user = Auth::user();
            $view->with([
                'followCount' => $user->followings()->count(), // ← followings() に変更
                'followerCount' => $user->followers()->count(),
            ]);
        }
    });
}
}
