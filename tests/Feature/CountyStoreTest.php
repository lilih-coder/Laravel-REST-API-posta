<?php

namespace Tests\Feature;

use App\Models\County;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class CountyStoreTest extends TestCase
{
    use RefreshDatabase;

    public function test_authenticated_user_can_create_a_county(): void
    {
        $user = User::factory()->create();
        $token = $user->createToken('test')->plainTextToken;

        $this->withToken($token)
            ->postJson('/api/counties', [
                'name' => 'Pest',
                'badge' => 'PE',
            ])
            ->assertCreated()
            ->assertJsonPath('name', 'Pest')
            ->assertJsonPath('badge', 'PE');

        $this->assertDatabaseHas('counties', [
            'name' => 'Pest',
            'badge' => 'PE',
        ]);
    }

    public function test_badge_is_optional_when_creating_a_county(): void
    {
        $user = User::factory()->create();
        $token = $user->createToken('test')->plainTextToken;

        $this->withToken($token)
            ->postJson('/api/counties', ['name' => 'Nógrád'])
            ->assertCreated()
            ->assertJsonPath('name', 'Nógrád')
            ->assertJsonPath('badge', null);

        $this->assertDatabaseHas('counties', [
            'name' => 'Nógrád',
            'badge' => null,
        ]);
    }

    public function test_county_creation_requires_authentication(): void
    {
        $this->postJson('/api/counties', [
            'name' => 'Pest',
            'badge' => 'PE',
        ])->assertUnauthorized();

        $this->assertSame(0, County::count());
    }

    public function test_authenticated_user_can_partially_update_a_county(): void
    {
        $user = User::factory()->create();
        $token = $user->createToken('test')->plainTextToken;
        $county = County::create([
            'name' => 'Pest',
            'badge' => 'PE',
        ]);

        $this->withToken($token)
            ->patchJson("/api/counties/{$county->id}", ['badge' => 'PT'])
            ->assertOk()
            ->assertJsonPath('county.id', $county->id)
            ->assertJsonPath('county.name', 'Pest')
            ->assertJsonPath('county.badge', 'PT');

        $this->assertDatabaseHas('counties', [
            'id' => $county->id,
            'name' => 'Pest',
            'badge' => 'PT',
        ]);
    }
}
