<?php

namespace Database\Seeders;

use App\Models\PengajuanModel;
use Illuminate\Database\Seeder;

class PengajuanTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $pengajuans = [
            [
                'pengajuan_code' => '34.24.00014',
                'pengajuan_date' => '2024-09-01',
                'status' => 'active',
                'company_name' => 'Test1',
                'office_inspection' => 'DENPASAR',
            ],
            [
                'pengajuan_code' => '23.24.00154',
                'pengajuan_date' => '2024-09-01',
                'status' => 'tunda',
                'company_name' => 'Test2',
                'office_inspection' => 'SURABAYA',
            ],
            [
                'pengajuan_code' => '15.24.00094',
                'pengajuan_date' => '2024-09-01',
                'status' => 'inactive',
                'company_name' => 'Test3',
                'office_inspection' => 'JAKARTA',
            ],
        ];
        foreach ($pengajuans as $key => $value) {
            $pengajuan = PengajuanModel::create($value);
        }
    }
}
