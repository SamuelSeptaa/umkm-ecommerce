<?php

namespace Database\Seeders;

use App\Models\courier;
use Illuminate\Database\Seeder;

class CourierSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        courier::create([
            'code' => 'gojek',
            'courier_name'  => 'Gojek'
        ]);

        courier::create([
            'code' => 'grab',
            'courier_name'  => 'Grab'
        ]);
    }
}
