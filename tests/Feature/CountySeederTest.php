<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\DB;
use Tests\TestCase;

class CountySeederTest extends TestCase
{
    use RefreshDatabase;

    public function test_database_seeder_seeds_counties(): void
    {
        $this->seed();

        $this->assertSame(20, DB::table('counties')->count());
        $this->assertDatabaseHas('counties', [
            'name' => 'Bács-Kiskun',
            'badge' => 'BK',
        ]);
    }
}
