<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class UsersIndexTest extends TestCase
{
    use RefreshDatabase;

    public function test_authenticated_user_can_list_users(): void
    {
        $user = User::factory()->create();
        $token = $user->createToken('test')->plainTextToken;

        $response = $this->withToken($token)->getJson('/api/users');

        $response->assertOk()
            ->assertJsonCount(1)
            ->assertJsonMissingPath('0.password')
            ->assertJsonPath('0.id', $user->id);
    }

    public function test_users_index_requires_authentication(): void
    {
        $this->getJson('/api/users')->assertUnauthorized();
    }
}
