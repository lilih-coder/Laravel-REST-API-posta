<?php

namespace Tests\Feature;

use App\Models\City;
use App\Models\County;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class CityApiTest extends TestCase
{
    use RefreshDatabase;

    public function test_cities_can_be_listed_and_managed_by_an_authenticated_user(): void
    {
        $user = User::factory()->create();
        $token = $user->createToken('test')->plainTextToken;
        $county = County::create([
            'name' => 'Pest',
            'badge' => 'PE',
        ]);
        $headers = ['Authorization' => 'Bearer '.$token];

        $this->postJson('/api/cities', [
            'name' => 'Budapest',
            'zip_code' => '1051',
            'population' => 1700000,
            'county_id' => $county->id,
        ], $headers)
            ->assertOk()
            ->assertJsonPath('city.name', 'Budapest')
            ->assertJsonPath('city.county_id', $county->id);

        $city = City::firstOrFail();

        $this->getJson('/api/cities')
            ->assertOk()
            ->assertJsonPath('cities.0.id', $city->id)
            ->assertJsonPath('cities.0.name', 'Budapest');

        $this->patchJson("/api/cities/{$city->id}", [
            'name' => 'Budapest',
            'zip_code' => '1052',
            'population' => 1700000,
            'county_id' => $county->id,
        ], $headers)
            ->assertOk()
            ->assertJsonPath('city.zip_code', '1052');

        $this->deleteJson("/api/cities/{$city->id}", [], $headers)
            ->assertOk()
            ->assertJsonPath('id', (string) $city->id);

        $this->assertDatabaseMissing('cities', ['id' => $city->id]);
    }

    public function test_city_creation_requires_authentication(): void
    {
        $county = County::create([
            'name' => 'Pest',
            'badge' => 'PE',
        ]);

        $this->postJson('/api/cities', [
            'name' => 'Budapest',
            'county_id' => $county->id,
        ])->assertUnauthorized();

        $this->assertSame(0, City::count());
    }
}
