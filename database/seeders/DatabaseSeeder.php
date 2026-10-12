<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call(CountySeeder::class);
        $this->call(CitySeeder::class);

        User::updateOrCreate([
            'email' => 'emilydriver42@gmail.com',
        ], [
            'name' => 'ED42',
            'password' => Hash::make('123'),
        ]);
    }
}
