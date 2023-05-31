<?php

namespace Database\Seeders;

use App\Models\category;
use Illuminate\Database\Seeder;

class CategoriesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        category::create([
            'category'  => 'Makanan',
            'slug'  => 'makanan',
            'thumbnail' => 'ogani/img/categories/cat-1.jpg'
        ]);
        category::create([
            'category'  => 'Minuman',
            'slug'      => 'minuman',
            'thumbnail' => 'ogani/img/categories/cat-2.jpg'
        ]);
        category::create([
            'category'  => 'Snack',
            'slug'      => 'snack',
            'thumbnail' => 'ogani/img/categories/cat-3.jpg'
        ]);
        category::create([
            'category'  => 'Buah-buahan',
            'slug'      => 'buah-buahan',
            'thumbnail' => 'ogani/img/categories/cat-4.jpg'
        ]);
    }
}
