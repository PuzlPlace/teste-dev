<?php

namespace Database\Seeders;

use App\Models\Author;
use App\Models\Category;
use App\Models\Library;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        User::factory(10)->create();
        Category::factory(4)->create();
        Author::factory(20)->create();
        Library::factory(20)->create();
    }
}
