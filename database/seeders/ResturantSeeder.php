<?php

namespace Database\Seeders;

use App\Models\resturant;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ResturantSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        resturant::factory(10)->create();
    }
}
