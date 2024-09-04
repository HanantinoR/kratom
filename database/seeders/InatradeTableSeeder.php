<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Inatrade;

class InatradeTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $inatrade = [
            [
                'ls_number' => '34.24.00014',
                'ppbe_number' => '333.10231.23112',
                'ls_publish_date' => '2022-11-16',
                'ppbe_publish_date' => '2024-09-01',
                'status' => 'active',
                'company_name' => 'Breakdance'
            ],
            [
                'ls_number' => '813.54.3221',
                'ppbe_number' => '91.2512.553',
                'ls_publish_date' => '2022-04-17',
                'ppbe_publish_date' => '2023-06-12',
                'status' => 'active',
                'company_name' => 'Dancebreak'
            ], [
                'ls_number' => '9123.23.1412',
                'ppbe_number' => '8121.312.42',
                'ls_publish_date' => '2023-12-30',
                'ppbe_publish_date' => '2024-08-11',
                'status' => 'active',
                'company_name' => 'Bruh'
            ],
        ];
        foreach ($inatrade as $key => $value) {
            $ina = Inatrade::create($value);
        }
    }
}
