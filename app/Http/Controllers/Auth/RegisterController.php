<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

class RegisterController extends Controller
{
    public function showRegistrationForm()
    {
        return view('auth.register'); // resources/views/auth/register.blade.php
    }

    public function register(Request $request)
    {
        $request->validate([
    'username' => 'required|string|min:2|max:12',
    'email'    => 'required|email|min:5|max:40|unique:users,email',
    'password' => ['required','string','regex:/^[A-Za-z0-9]+$/','min:8','max:20','confirmed'],
],
[
    'username.required' => 'ユーザー名は必須です。',
    'username.min'      => 'ユーザー名は2文字以上で入力してください。',
    'username.max'      => 'ユーザー名は12文字以内で入力してください。',

    'email.required' => 'メールアドレスは必須です。',
    'email.email'    => 'メールアドレスの形式が正しくありません。',
    'email.min'      => 'メールアドレスは5文字以上で入力してください。',
    'email.max'      => 'メールアドレスは40文字以内で入力してください。',
    'email.unique'   => 'このメールアドレスはすでに登録されています。',

    'password.required'  => 'パスワードは必須です。',
    'password.regex'     => 'パスワードは半角英数字のみ利用できます。',
    'password.min'       => 'パスワードは8文字以上で入力してください。',
    'password.max'       => 'パスワードは20文字以内で入力してください。',
    'password.confirmed' => '確認用パスワードが一致しません。',
]);

 // ユーザーをDBに保存
    DB::table('users')->insert([
        'username' => $request->username,
        'email'    => $request->email,
        'password' => Hash::make($request->password), // 必ずハッシュ化
        'created_at' => now(),
        'updated_at' => now(),
    ]);


        // 登録完了ページへリダイレクト、ユーザー名を渡す
    return redirect()->route('register.added')->with('username', $request->username);
}

public function added()
{
    return view('auth.added');
}


}
