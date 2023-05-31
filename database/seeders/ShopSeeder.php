<?php

namespace Database\Seeders;

use App\Models\shop;
use Illuminate\Database\Seeder;

class ShopSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        shop::create([
            'user_id'   => 2,
            'shop_name' => "Nikita Fried Chicken",
            'slug'      => "nikita-fried-chicken"
        ]);
        shop::create([
            'user_id'   => 3,
            'shop_name' => "Bubur Ayam Ceria",
            'slug'      => "bubur-ayam-ceria"
        ]);
        shop::create([
            'user_id'   => 4,
            'shop_name' => "Ayam Geprek Goldchick",
            'slug'      => "ayam-geprek-goldchick"
        ]);
    }
}
