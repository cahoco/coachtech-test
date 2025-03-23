<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Category;
use App\Models\Contact;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     */
    public function run()
{
    $this->call(CategorySeeder::class);
    if (Category::count() > 0) {
        // Contact のダミーデータを作成
        Contact::factory(35)->create();
    }
}
}
