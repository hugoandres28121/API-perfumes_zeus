<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Models\Fragance;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class FraganceFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {

        $name=$this->faker->unique()->name(20);

        return [
            'name' => $name,
            'slug'=>Str::slug($name),
            'bottle_contents_ml'=>$this->faker->randomFloat(2,0,200),
            'price'=>$this->faker->randomFloat(2,0,10000),
            'gender'=>$this->faker->numberBetween(Fragance::FEMENINO,Fragance::MASCULINO),
            'quantity_stock'=>$this->faker->numberBetween(0,30)
        ];
    }
}
