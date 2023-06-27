<?php

namespace Database\Seeders;

use App\Models\blog;
use Illuminate\Database\Seeder;

class BlogSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $blogs = [
            [
                'title'         => 'First Blog',
                'slug'          => 'first-blog',
                'image_url'     => 'img/blog/blog-1.jpg',
                'info'          => 'This is the first blog post.',
                'description'   => 'This is the first blog post.',
            ],
            [
                'title'         => 'Second Blog',
                'slug'          => 'second-blog',
                'image_url'     => 'img/blog/blog-2.jpg',
                'info'          => 'This is the first blog post.',
                'description'   => 'This is the second blog post.',
            ],
            [
                'title'         => 'Third Blog',
                'slug'          => 'third-blog',
                'image_url'     => 'img/blog/blog-3.jpg',
                'info'          => 'This is the first blog post.',
                'description'   => 'This is the second blog post.',
            ],
        ];

        foreach ($blogs as $blog) {
            blog::create($blog);
        }
    }
}
