<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class LikesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user3 = DB::table('users')->where('id', 3)->first();
        $items = DB::table('items')->where('user_id', 2)->take(3)->pluck('id')->toArray();

        foreach ($items as $itemId) {
            DB::table('likes')->insert([
                'user_id' => $user3->id,
                'item_id' => $itemId,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
