<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'name'=>'Hugo Andres Marrugo Polo',
            'email'=>'hugomarrugopolo28@hotmail.com',
            'password'=>bcrypt('andres28121'),

        ]);

        User::factory()
        ->count(50)
        ->create();
    }
}
