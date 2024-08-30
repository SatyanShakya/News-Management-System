<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\category;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        category::factory(10)->create();
    }
}
