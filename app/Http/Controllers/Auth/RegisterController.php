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
        ]);

        DB::table('users')->insert([
            'username' => $request->username,
            'email'    => $request->email,
            'password' => Hash::make($request->password),
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
