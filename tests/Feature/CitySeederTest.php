<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\DB;
use Tests\TestCase;

class CitySeederTest extends TestCase
{
    use RefreshDatabase;

    public function test_database_seeder_seeds_cities_with_their_counties(): void
    {
        $this->seed();

        $this->assertSame(50, DB::table('cities')->count());
        $this->assertDatabaseHas('cities', [
            'name' => 'Kecskemét',
            'zip_code' => '6000',
            'population' => null,
            'county_id' => DB::table('counties')->where('name', 'Bács-Kiskun')->value('id'),
        ]);
    }

    public function test_database_seeder_can_be_run_more_than_once(): void
    {
        $this->seed();
        $this->seed();

        $this->assertSame(50, DB::table('cities')->count());
    }
}
