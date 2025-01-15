<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class UserTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        $users = [
            [
                'first_name' => 'System',
                'last_name' => 'Admin',
                'phone_number' => '+12398190255',
                'email' => 'admin@example.com',
                'status' => 'active',
                'company_id'=>null,
                'user_type' => 'admin',
                'user_sign' => 1,
                'branch_office' => 1,
                'username' => 'systemadmin',
                'password' => bcrypt('password'),
                'email_verified_at' => now(),
            ],
            // [
            //     'first_name'=>,
            //     'last_name'=>,
            //     'company_id'=>,
            //     'phone_number'=>,
            //     'alt_number'=>,
            //     'email'=>,
            //     'status'=>,
            //     'user_role'=>,
            //     'user_sign'=>,
            //     'branch_office'=>,
            //     'username'=>,
            //     'password'=>,

            // ],
            // [
            //     'first_name'=>,
            //     'last_name'=>,
            //     'company_id'=>,
            //     'phone_number'=>,
            //     'alt_number'=>,
            //     'email'=>,
            //     'status'=>,
            //     'user_role'=>,
            //     'user_sign'=>,
            //     'branch_office'=>,
            //     'username'=>,
            //     'password'=>,

            // ]
        ];
        foreach ($users as $key => $value) {
            $user = User::create($value);
            $user->assignRole($value['user_type']);
        }
    }
}
