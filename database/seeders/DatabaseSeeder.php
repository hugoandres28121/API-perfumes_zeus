<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Customer;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            PermisionSeeder::class,
            UserSeeder::class,
            CustomerSeeder::class,
            FraganceSeeder::class,
            SaleSeeder::class,

        ]);
    }
}
