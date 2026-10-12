<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CountySeeder extends Seeder
{
    public function run(): void
    {
        $counties = [
            ['name' => 'Bács-Kiskun', 'badge' => 'BK'],
            ['name' => 'Baranya', 'badge' => 'BA'],
            ['name' => 'Békés', 'badge' => 'BE'],
            ['name' => 'Borsod-Abaúj-Zemplén', 'badge' => 'BAZ'],
            ['name' => 'Budapest', 'badge' => 'BP'],
            ['name' => 'Csongrád-Csanád', 'badge' => 'CS'],
            ['name' => 'Fejér', 'badge' => 'FE'],
            ['name' => 'Győr-Moson-Sopron', 'badge' => 'GYMS'],
            ['name' => 'Hajdú-Bihar', 'badge' => 'HB'],
            ['name' => 'Heves', 'badge' => 'HE'],
            ['name' => 'Jász-Nagykun-Szolnok', 'badge' => 'JNSZ'],
            ['name' => 'Komárom-Esztergom', 'badge' => 'KE'],
            ['name' => 'Nógrád', 'badge' => 'NO'],
            ['name' => 'Pest', 'badge' => 'PE'],
            ['name' => 'Somogy', 'badge' => 'SO'],
            ['name' => 'Szabolcs-Szatmár-Bereg', 'badge' => 'SZB'],
            ['name' => 'Tolna', 'badge' => 'TO'],
            ['name' => 'Vas', 'badge' => 'VA'],
            ['name' => 'Veszprém', 'badge' => 'VE'],
            ['name' => 'Zala', 'badge' => 'ZA'],
        ];

        foreach ($counties as $county) {
            DB::table('counties')->updateOrInsert(
                ['name' => $county['name']],
                ['badge' => $county['badge']]
            );
        }
    }
}
