<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\Amenities;
use Illuminate\Support\Str;

class AmenitiesSeeder extends Seeder
{
    /**
     * Run the database seeders.
     */
    public function run(): void
    {

        Amenities::factory()->count(10000)->create();
    }
}
