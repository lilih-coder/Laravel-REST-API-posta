<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class LoginApiTest extends TestCase
{
    use RefreshDatabase;

    public function test_user_can_log_in_with_valid_credentials(): void
    {
        $user = User::factory()->create([
            'email' => 'user@example.com',
            'password' => bcrypt('secret-password'),
        ]);

        $response = $this->postJson('/api/users/login', [
            'email' => $user->email,
            'password' => 'secret-password',
        ]);

        $response->assertOk()
            ->assertJsonPath('user.email', $user->email)
            ->assertJsonPath('token', fn ($token) => is_string($token) && $token !== '');
    }

    public function test_user_cannot_log_in_with_invalid_credentials(): void
    {
        User::factory()->create([
            'email' => 'user@example.com',
            'password' => bcrypt('secret-password'),
        ]);

        $this->postJson('/api/users/login', [
            'email' => 'user@example.com',
            'password' => 'wrong-password',
        ])->assertUnauthorized();
    }
}
