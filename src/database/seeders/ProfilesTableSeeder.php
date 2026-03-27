<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class ProfilesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('profiles')->insert([
            [
                'id' => 1,
                'user_id' => 1,
                'avatar_path' => null,
                'postal_code' => '100-0001',
                'address' => '東京都千代田区千代田',
                'building' => 'テストビル1F',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 2,
                'user_id' => 2,
                'avatar_path' => null,
                'postal_code' => '530-0001',
                'address' => '大阪府大阪市北区梅田',
                'building' => 'テストビル2F',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 3,
                'user_id' => 3,
                'avatar_path' => null,
                'postal_code' => '460-0001',
                'address' => '愛知県名古屋市中区錦',
                'building' => 'テストビル3F',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
