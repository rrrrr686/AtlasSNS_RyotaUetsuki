<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB; //データベース操作のためのクラス
use Illuminate\Support\Facades\Hash; //パスワードを暗号化するためのクラス

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(): void
    {
        DB::table('users')->insert([
            'username' => 'AtlasTaro',              // ユーザー名
            'email' => 'taro@example.com',      // メールアドレス
            'password' => Hash::make('pass1234'), // パスワード暗号化
            'bio' => 'よろしくお願いします！',
            'icon_image' => 'icon1.png',
            'created_at' => now(),// 登録日時
            'updated_at' => now(),// 更新日時
        ]);
    }
}
