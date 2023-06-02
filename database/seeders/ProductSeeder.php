<?php

namespace Database\Seeders;

use App\Models\product;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $categories = [1, 2, 3, 4];
        $shops = [1, 2, 3];

        for ($i = 0; $i < 50; $i++) {
            $categoryId = $categories[array_rand($categories)];
            $shopId = $shops[array_rand($shops)];
            $productName = "Product " . ($i + 1);
            $slug = "product-" . ($i + 1);

            product::create([
                'category_id'   => $categoryId,
                'shop_id'       => $shopId,
                'product_name'  => $productName,
                'image_url'     => "ogani/img/product/product-details-$categoryId.jpg",
                'slug'          => $slug,
                'description'   => "Description of $productName",
                'price'         => rand(10000, 250000),
                'stock'         => 100
            ]);
        }
    }
}
