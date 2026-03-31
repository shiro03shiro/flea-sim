<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\User;
use App\Models\Category;
use App\Models\Item;
use Illuminate\Http\UploadedFile;

class ItemCreateTest extends TestCase
{
    use RefreshDatabase;

    public function test_商品出品画面にて必要な情報が保存できること()
    {
        $user = User::factory()->create();

        $category = Category::create([
            'name' => 'テストカテゴリ',
            'slug' => 'test-category'
        ]);

        $this->actingAs($user);

        $data = [
            'category_id' => [$category->id],
            'condition' => 1,
            'name' => 'テスト商品',
            'brand_name' => 'テストブランド',
            'description' => 'テスト説明です',
            'price' => 1000,
            'image_path' => UploadedFile::fake()->create('test.jpg'),
        ];

        $response = $this->post(route('items.store'), $data);

        $response->assertRedirect('/');

        $this->assertDatabaseHas('items', [
            'name' => 'テスト商品',
            'brand_name' => 'テストブランド',
            'price' => 1000,
        ]);

        $item = Item::first();

        $this->assertDatabaseHas('item_category', [
            'item_id' => $item->id,
            'category_id' => $category->id,
        ]);
    }
}
