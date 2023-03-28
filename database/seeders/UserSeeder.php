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
            'number_document'=>1051449969,
            'is_admin'=>true,

        ])->assignRole('super-Admin');


        User::create([
            'name'=>'Aldair Marrugo Polo',
            'email'=>'alda@hotmail.com',
            'password'=>bcrypt('andres28121'),
            'number_document'=>1051449968,
            'is_admin'=>true,

        ])->assignRole('admin');

        User::factory()
        ->count(50)
        ->create()
        ->each(function(User $user){
            $user->assignRole('customer');
        });

        // $users=User::all();
        // foreach($users as $user){
        //     if($user->is_admin==false){
        //         $user->assignRole('customer');
        //     }
        // }
    }

}
