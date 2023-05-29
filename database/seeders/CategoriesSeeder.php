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
            'thumbnail' => 'ogani/img/categories/cat-1.jpg'
        ]);
        category::create([
            'category'  => 'Minuman',
            'thumbnail' => 'ogani/img/categories/cat-2.jpg'
        ]);
        category::create([
            'category'  => 'Snack',
            'thumbnail' => 'ogani/img/categories/cat-3.jpg'
        ]);
        category::create([
            'category'  => 'Buah-buahan',
            'thumbnail' => 'ogani/img/categories/cat-4.jpg'
        ]);
    }
}
