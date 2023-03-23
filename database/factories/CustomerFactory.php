<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Customer>
 */
class CustomerFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {

        $name = $this->faker->unique()->name();
        $lastName = $this->faker->unique()->lastName();

        return [
            "slug"=>Str::slug($name),
            "name"=>$name,
            "lastName"=>$lastName,
            "address"=>$this->faker->address()
        ];
    }
}
