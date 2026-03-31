<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class LoginTest extends TestCase
{
    use RefreshDatabase;

    public function test_メールアドレスが入力されていない場合()
    {
        $response = $this->post('/login', [
            'email' => '',
            'password' => 'password123',
        ]);

        $response->assertSessionHasErrors(['email']);

        $this->assertEquals(
            'メールアドレスを入力してください',
            session('errors')->first('email')
        );
    }

    public function test_パスワードが入力されていない場合()
    {
        $response = $this->post('/login', [
            'email' => 'test@example.com',
            'password' => '',
        ]);

        $response->assertSessionHasErrors(['password']);

        $this->assertEquals(
            'パスワードを入力してください',
            session('errors')->first('password')
        );
    }

    public function test_入力情報が間違っている場合()
    {
        User::factory()->create([
            'email' => 'test@example.com',
            'password' => Hash::make('correct-password'),
        ]);

        $response = $this->post('/login', [
            'email' => 'test@example.com',
            'password' => 'wrong-password',
        ]);

        $response->assertSessionHasErrors(['email']);

        $this->assertEquals(
            'ログイン情報が登録されていません',
            session('errors')->first('email')
        );
    }

    public function test_正しい情報が入力された場合()
    {
        $user = User::factory()->create([
            'email' => 'test@example.com',
            'password' => Hash::make('password123'),
            'is_profile_completed' => true,
        ]);

        $response = $this->post('/login', [
            'email' => 'test@example.com',
            'password' => 'password123',
        ]);

        $this->assertAuthenticatedAs($user);

        $response->assertRedirect(route('home'));
    }
}