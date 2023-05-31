<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $admin = User::create([
            'name' => 'uadmin',
            'email' => 'admin@gmail.com',
            'password' => bcrypt('12345678')
        ]);

        $admin->assignRole('admin');

        $merchants = [
            [
                'name' => 'nikitafried',
                'email' => 'nikitafried@gmail.com',
                'password' => bcrypt('12345678')
            ],
            [
                'name' => 'buburayam',
                'email' => 'buburceria@gmail.com',
                'password' => bcrypt('12345678')
            ],
            [
                'name' => 'goldchick',
                'email' => 'goldchick@gmail.com',
                'password' => bcrypt('12345678')
            ],
        ];

        foreach ($merchants as $userData) {
            $merchant = User::create($userData);
            $merchant->assignRole('merchant');
        }
    }
}
