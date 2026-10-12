<?php

namespace Database\Seeders;

use App\Models\City;
use App\Models\County;
use Illuminate\Database\Seeder;
use RuntimeException;

class CitySeeder extends Seeder
{
    public function run(): void
    {
        $countyIds = County::query()->pluck('id', 'name');

        $cities = [
            ['name' => 'Kecskemét', 'zip_code' => '6000', 'county' => 'Bács-Kiskun'],
            ['name' => 'Baja', 'zip_code' => '6500', 'county' => 'Bács-Kiskun'],
            ['name' => 'Kiskunfélegyháza', 'zip_code' => '6100', 'county' => 'Bács-Kiskun'],
            ['name' => 'Pécs', 'zip_code' => '7621', 'county' => 'Baranya'],
            ['name' => 'Komló', 'zip_code' => '7300', 'county' => 'Baranya'],
            ['name' => 'Mohács', 'zip_code' => '7700', 'county' => 'Baranya'],
            ['name' => 'Békéscsaba', 'zip_code' => '5600', 'county' => 'Békés'],
            ['name' => 'Gyula', 'zip_code' => '5700', 'county' => 'Békés'],
            ['name' => 'Orosháza', 'zip_code' => '5900', 'county' => 'Békés'],
            ['name' => 'Miskolc', 'zip_code' => '3525', 'county' => 'Borsod-Abaúj-Zemplén'],
            ['name' => 'Ózd', 'zip_code' => '3600', 'county' => 'Borsod-Abaúj-Zemplén'],
            ['name' => 'Kazincbarcika', 'zip_code' => '3700', 'county' => 'Borsod-Abaúj-Zemplén'],
            ['name' => 'Budapest', 'zip_code' => '1051', 'county' => 'Budapest'],
            ['name' => 'Szeged', 'zip_code' => '6720', 'county' => 'Csongrád-Csanád'],
            ['name' => 'Hódmezővásárhely', 'zip_code' => '6800', 'county' => 'Csongrád-Csanád'],
            ['name' => 'Makó', 'zip_code' => '6900', 'county' => 'Csongrád-Csanád'],
            ['name' => 'Székesfehérvár', 'zip_code' => '8000', 'county' => 'Fejér'],
            ['name' => 'Dunaújváros', 'zip_code' => '2400', 'county' => 'Fejér'],
            ['name' => 'Győr', 'zip_code' => '9021', 'county' => 'Győr-Moson-Sopron'],
            ['name' => 'Sopron', 'zip_code' => '9400', 'county' => 'Győr-Moson-Sopron'],
            ['name' => 'Mosonmagyaróvár', 'zip_code' => '9200', 'county' => 'Győr-Moson-Sopron'],
            ['name' => 'Debrecen', 'zip_code' => '4024', 'county' => 'Hajdú-Bihar'],
            ['name' => 'Hajdúszoboszló', 'zip_code' => '4200', 'county' => 'Hajdú-Bihar'],
            ['name' => 'Berettyóújfalu', 'zip_code' => '4100', 'county' => 'Hajdú-Bihar'],
            ['name' => 'Eger', 'zip_code' => '3300', 'county' => 'Heves'],
            ['name' => 'Gyöngyös', 'zip_code' => '3200', 'county' => 'Heves'],
            ['name' => 'Szolnok', 'zip_code' => '5000', 'county' => 'Jász-Nagykun-Szolnok'],
            ['name' => 'Jászberény', 'zip_code' => '5100', 'county' => 'Jász-Nagykun-Szolnok'],
            ['name' => 'Tatabánya', 'zip_code' => '2800', 'county' => 'Komárom-Esztergom'],
            ['name' => 'Esztergom', 'zip_code' => '2500', 'county' => 'Komárom-Esztergom'],
            ['name' => 'Salgótarján', 'zip_code' => '3100', 'county' => 'Nógrád'],
            ['name' => 'Balassagyarmat', 'zip_code' => '2660', 'county' => 'Nógrád'],
            ['name' => 'Érd', 'zip_code' => '2030', 'county' => 'Pest'],
            ['name' => 'Szentendre', 'zip_code' => '2000', 'county' => 'Pest'],
            ['name' => 'Vác', 'zip_code' => '2600', 'county' => 'Pest'],
            ['name' => 'Cegléd', 'zip_code' => '2700', 'county' => 'Pest'],
            ['name' => 'Gödöllő', 'zip_code' => '2100', 'county' => 'Pest'],
            ['name' => 'Kaposvár', 'zip_code' => '7400', 'county' => 'Somogy'],
            ['name' => 'Siófok', 'zip_code' => '8600', 'county' => 'Somogy'],
            ['name' => 'Nyíregyháza', 'zip_code' => '4400', 'county' => 'Szabolcs-Szatmár-Bereg'],
            ['name' => 'Mátészalka', 'zip_code' => '4700', 'county' => 'Szabolcs-Szatmár-Bereg'],
            ['name' => 'Szekszárd', 'zip_code' => '7100', 'county' => 'Tolna'],
            ['name' => 'Paks', 'zip_code' => '7030', 'county' => 'Tolna'],
            ['name' => 'Szombathely', 'zip_code' => '9700', 'county' => 'Vas'],
            ['name' => 'Kőszeg', 'zip_code' => '9730', 'county' => 'Vas'],
            ['name' => 'Veszprém', 'zip_code' => '8200', 'county' => 'Veszprém'],
            ['name' => 'Pápa', 'zip_code' => '8500', 'county' => 'Veszprém'],
            ['name' => 'Balatonfüred', 'zip_code' => '8230', 'county' => 'Veszprém'],
            ['name' => 'Zalaegerszeg', 'zip_code' => '8900', 'county' => 'Zala'],
            ['name' => 'Nagykanizsa', 'zip_code' => '8800', 'county' => 'Zala'],
        ];

        foreach ($cities as $city) {
            $countyId = $countyIds->get($city['county']);
            if ($countyId === null) {
                throw new RuntimeException(
                    "Cannot seed city {$city['name']}: county {$city['county']} does not exist. Run CountySeeder first."
                );
            }

            City::updateOrCreate(
                ['name' => $city['name']],
                [
                    'zip_code' => $city['zip_code'],
                    'population' => null,
                    'county_id' => $countyId,
                ]
            );
        }
    }
}
