<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

class ProfileController extends Controller
{
    // プロフィール表示ページ
    public function profile()
    {
        return view('profiles.profile');
    }

    // プロフィール編集ページ
    public function edit()
    {
        $user = Auth::user();
        return view('profiles.profile', compact('user'));
    }

    // プロフィール更新処理
    public function update(Request $request)
{
    $user = Auth::user();

    // バリデーション
    $request->validate([
    'username' => 'required|string|min:2|max:12',
    'email' => [
        'required',
        'string',
        'email',
        'min:5',
        'max:40',
        Rule::unique('users', 'email')->ignore($user->id),
    ],
    'password' => [
        'required',
        'string',
        'min:8',
        'max:20',
        'regex:/^[a-zA-Z0-9]+$/',
        'confirmed',
    ],
    'bio' => 'nullable|string|max:150',
    'icon_image' => 'nullable|image|mimes:jpg,jpeg,png,bmp,gif,svg|max:2048',
], [
    // username
    'username.required' => 'ユーザー名は必須です。',
    'username.min' => 'ユーザー名は2文字以上で入力してください。',
    'username.max' => 'ユーザー名は12文字以内で入力してください。',

    // email
    'email.required' => 'メールアドレスは必須です。',
    'email.email' => '有効なメールアドレス形式で入力してください。',
    'email.min' => 'メールアドレスは5文字以上で入力してください。',
    'email.max' => 'メールアドレスは40文字以内で入力してください。',
    'email.unique' => 'このメールアドレスは既に使用されています。',

    // password
    'password.required' => 'パスワードは必須です。',
    'password.min' => 'パスワードは8文字以上で入力してください。',
    'password.max' => 'パスワードは20文字以内で入力してください。',
    'password.regex' => 'パスワードは半角英数字のみで入力してください。',
    'password.confirmed' => 'パスワード確認が一致しません。',

    // bio
    'bio.max' => '自己紹介文は150文字以内で入力してください。',

    // icon_image
    'icon_image.image' => '画像ファイルを選択してください。',
    'icon_image.mimes' => '画像は jpg、png、bmp、gif、svg のいずれかにしてください。',
]);


    // データ更新
    $user->username = $request->username;
    $user->email = $request->email;
    $user->bio = $request->bio;

    // パスワード更新（必須なのでそのまま代入）
    $user->password = Hash::make($request->password);

    // アイコン画像更新
    if ($request->hasFile('icon_image')) {
        $path = $request->file('icon_image')->store('icons', 'public');
        $user->icon_image = basename($path);
    }

    $user->save();

    return redirect('/top')->with('success', 'プロフィールを更新しました。');
}
}
