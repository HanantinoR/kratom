<?php

namespace Database\Seeders;

use App\Models\PPBEModel;
use Illuminate\Database\Seeder;

class PPBETableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $ppbes = [
            [
                'code' => '34.24.00014',
                'date' => '2024-09-01',
                'status' => 'active',
                'company_name' => 'Test1',
                'office_inspection' => 'DENPASAR',
            ],
            [
                'code' => '23.24.00154',
                'date' => '2024-09-01',
                'status' => 'tunda',
                'company_name' => 'Test2',
                'office_inspection' => 'SURABAYA',
            ],
            [
                'code' => '15.24.00094',
                'date' => '2024-09-01',
                'status' => 'inactive',
                'company_name' => 'Test3',
                'office_inspection' => 'JAKARTA',
            ],
        ];
        foreach ($ppbes as $key => $value) {
            $PPBE = PPBEModel::create($value);
        }
    }
}
