<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PurchasesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user3 = DB::table('users')->where('id', 3)->first();
        $item = DB::table('items')->where('user_id', 2)->where('sold_flg', 0)->first();

        if ($item) {       
            DB::table('purchases')->insert([
                'user_id' => $user3->id,
                'item_id' => $item->id,
                'payment_method' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            DB::table('items')->where('id', $item->id)->update(['sold_flg' => 1]);
        }
    }
}
