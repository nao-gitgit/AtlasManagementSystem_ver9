<?php
namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'over_name' => '山田',
            'under_name' => '太郎',
            'over_name_kana' => 'ヤマダ',
            'under_name_kana' => 'タロウ',
            'mail_address' => 'test@example.com',
            'sex' => 1,
            'birth_day' => '1990-01-01',
            'role' => 1,
            'password' => Hash::make('password'),
            'created_at' => now(),
            'updated_at' => now(),
            // deleted_atは初期値nullで省略可
        ]);
    }
}
