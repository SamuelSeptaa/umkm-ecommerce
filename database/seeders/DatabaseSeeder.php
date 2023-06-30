<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // $this->call([
        //     RoleSeeder::class,
        //     UserSeeder::class,
        //     ShopSeeder::class,
        //     CategoriesSeeder::class,
        //     ProductSeeder::class,
        //     FeaturedProduct::class,
        //     BlogSeeder::class,
        //     CourierSeeder::class,
        // ]);

        $path = base_path() . '/database/seeders/data.sql';
        $sql = file_get_contents($path);
        DB::unprepared($sql);
    }
}
