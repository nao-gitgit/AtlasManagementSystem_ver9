<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SubjectsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // 国語、数学、英語を追加
        $subjects = ['国語', '数学', '英語'];

        foreach ($subjects as $subject) {
            DB::table('subjects')->insert([
                'subject' => $subject,
                'created_at' => now(),
            ]);
        }
    }
}
