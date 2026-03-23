<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ItemsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $testUser = DB::table('users')->where('email', 'test@example.com')->first();

        if (!$testUser) {
            $userId = DB::table('users')->insertGetId([
                'name' => 'テストユーザー',
                'email' => 'test@example.com',
                'email_verified_at' => now(),
                'password' => bcrypt('password'),
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        } else {
            $userId = $testUser->id;
        }

        $items = [
            [
                'image_path' => 'https://coachtech-matter.s3.ap-northeast-1.amazonaws.com/image/Armani+Mens+Clock.jpg',
                'name' => '腕時計',
                'brand_name' => 'Rolax',
                'price' => 15000,
                'description' => 'スタイリッシュなデザインのメンズ腕時計。日常使いに最適です。',
                'condition' => 3,
                'sold_flg' => 0,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'image_path' => 'https://coachtech-matter.s3.ap-northeast-1.amazonaws.com/image/HDD+Hard+Disk.jpg',
                'name' => 'HDD',
                'brand_name' => '西芝',
                'price' => 5000,
                'description' => '高速で信頼性の高いハードディスク。データ保存に最適です。',
                'condition' => 2,
                'sold_flg' => 0,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'image_path' => 'https://coachtech-matter.s3.ap-northeast-1.amazonaws.com/image/iLoveIMG+d.jpg',
                'name' => '玉ねぎ3束',
                'brand_name' => 'なし',
                'price' => 300,
                'description' => '新鮮な玉ねぎ3束のセット。料理に最適です。',
                'condition' => 1,
                'sold_flg' => 0,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'image_path' => 'https://coachtech-matter.s3.ap-northeast-1.amazonaws.com/image/Leather+Shoes+Product+Photo.jpg',
                'name' => '革靴',
                'brand_name' => null,
                'price' => 4000,
                'description' => 'クラシックなデザインの革靴。フォーマルシーンに。',
                'condition' => 0,
                'sold_flg' => 0,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'image_path' => 'https://coachtech-matter.s3.ap-northeast-1.amazonaws.com/image/Living+Room+Laptop.jpg',
                'name' => 'ノートPC',
                'brand_name' => null,
                'price' => 45000,
                'description' => '高性能なノートパソコン。仕事・プライベートに活躍。',
                'condition' => 3,
                'sold_flg' => 0,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'image_path' => 'https://coachtech-matter.s3.ap-northeast-1.amazonaws.com/image/Music+Mic+4632231.jpg',
                'name' => 'マイク',
                'brand_name' => 'なし',
                'price' => 8000,
                'description' => '高音質のレコーディング用マイク。配信・録音に最適。',
                'condition' => 2,
                'sold_flg' => 0,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'image_path' => 'https://coachtech-matter.s3.ap-northeast-1.amazonaws.com/image/Purse+fashion+pocket.jpg',
                'name' => 'ショルダーバッグ',
                'brand_name' => null,
                'price' => 3500,
                'description' => 'おしゃれなショルダーバッグ。日常使いにぴったり。',
                'condition' => 1,
                'sold_flg' => 0,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'image_path' => 'https://coachtech-matter.s3.ap-northeast-1.amazonaws.com/image/Tumbler+souvenir.jpg',
                'name' => 'タンブラー',
                'brand_name' => 'なし',
                'price' => 500,
                'description' => '使いやすいタンブラー。飲み物を持ち運びに便利。',
                'condition' => 0,
                'sold_flg' => 0,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'image_path' => 'https://coachtech-matter.s3.ap-northeast-1.amazonaws.com/image/Waitress+with+Coffee+Grinder.jpg',
                'name' => 'コーヒーミル',
                'brand_name' => 'Starbacks',
                'price' => 4000,
                'description' => '手動のコーヒーミル。自宅で本格コーヒーを。',
                'condition' => 3,
                'sold_flg' => 0,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'image_path' => 'https://coachtech-matter.s3.ap-northeast-1.amazonaws.com/image/%E5%A4%96%E5%87%BA%E3%83%A1%E3%82%A4%E3%82%AF%E3%82%A2%E3%83%83%E3%83%95%E3%82%9A%E3%82%BB%E3%83%83%E3%83%88.jpg',
                'name' => 'メイクセット',
                'brand_name' => null,
                'price' => 2500,
                'description' => '便利なメイクアップセット。お出かけに最適です。',
                'condition' => 2,
                'sold_flg' => 0,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ];

        foreach ($items as &$item) {
            $item['user_id'] = $userId;
        }

        DB::table('items')->insert($items);
    }
}
