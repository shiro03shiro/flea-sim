<?php
namespace Database\Seeders;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategoriesTableSeeder extends Seeder
{
    public function run()
    {
        $data = [
            ['name' => 'ファッション', 'slug' => 'fashion', 'created_at' => now(), 'updated_at' => now()],
            ['name' => '家電', 'slug' => 'electronics', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'インテリア', 'slug' => 'interior', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'レディース', 'slug' => 'ladies', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'メンズ', 'slug' => 'mens', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'コスメ', 'slug' => 'cosme', 'created_at' => now(), 'updated_at' => now()],
            ['name' => '本', 'slug' => 'book', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'ゲーム', 'slug' => 'game', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'スポーツ', 'slug' => 'sports', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'キッチン', 'slug' => 'kitchen', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'ハンドメイド', 'slug' => 'handmade', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'アクセサリー', 'slug' => 'accessory', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'おもちゃ', 'slug' => 'toy', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'ベビー・キッズ', 'slug' => 'baby-kids', 'created_at' => now(), 'updated_at' => now()],
        ];

        DB::table('categories')->insert($data);
    }
}
