<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CommentsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user3 = DB::table('users')->where('id', 3)->first();
        $items = DB::table('items')->where('user_id', 2)->take(2)->pluck('id')->toArray();

        $comments = [
            'とても良い商品ですね！',
            '状態が良さそうです。',
        ];

        foreach ($items as $index => $itemId) {
            DB::table('comments')->insert([
                'user_id' => $user3->id,
                'item_id' => $itemId,
                'content' => $comments[$index],
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
