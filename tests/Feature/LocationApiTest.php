<?php

namespace Tests\Feature;

use App\Models\County;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class LocationApiTest extends TestCase
{
    use RefreshDatabase;

    public function test_counties_can_be_listed_and_managed(): void
    {
        $user = User::factory()->create();
        $token = $user->createToken('test')->plainTextToken;

        $create = $this->withToken($token)->postJson('/api/counties', [
            'name' => 'Budapest',
            'badge' => 'BP',
        ]);

        $create->assertCreated()
            ->assertJsonPath('name', 'Budapest')
            ->assertJsonPath('badge', 'BP');

        $county = County::first();

        $this->getJson('/api/counties')
            ->assertOk()
            ->assertJsonFragment(['name' => 'Budapest']);

        $this->withToken($token)->patchJson('/api/counties', [
            'id' => $county->id,
            'badge' => 'BUD',
        ])->assertOk()->assertJsonPath('badge', 'BUD');

        $this->withToken($token)->deleteJson('/api/counties', ['id' => $county->id])
            ->assertOk()
            ->assertJsonPath('id', $county->id);
    }
}
