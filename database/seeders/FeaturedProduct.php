<?php

namespace Database\Seeders;

use App\Models\featured_product;
use Illuminate\Database\Seeder;

class FeaturedProduct extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        featured_product::create([
            'product_id' => 1
        ]);
        featured_product::create([
            'product_id' => 3
        ]);
        featured_product::create([
            'product_id' => 9
        ]);
        featured_product::create([
            'product_id' => 12
        ]);
        featured_product::create([
            'product_id' => 8
        ]);
        featured_product::create([
            'product_id' => 4
        ]);
        featured_product::create([
            'product_id' => 45
        ]);
        featured_product::create([
            'product_id' => 18
        ]);
    }
}
