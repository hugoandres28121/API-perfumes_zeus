<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Models\Customer;
use App\Models\Sale;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Sale>
 */
class SaleFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {

        return [
            'slug'=>Str::slug( $this->faker->name(5)),
            'sale_date'=>$this->faker->dateTimeBetween('-1 week', '+1 week'),
            'customer_id'=>Customer::all()->random()->id,
            'total_amount'=>0,
            'amount_paid'=>0,
            

            
            // 'total_amount'=>$total_amount,
            // 'amount_paid'=>$this->faker->randomFloat(2,0,$total_amount),
            // 'sale_status'=>function (array $attributes){
            //     if($attributes['amount_paid']==0){
            //         return Sale::PENDING;
            //     }
            //     if($attributes['amount_paid']==$attributes['total_amount']){
            //         return Sale::PAID;
            //     }
            //     if($attributes['amount_paid']>0&&$attributes['amount_paid']<$attributes['total_amount']){
            //         return Sale::PARTIALLYPAID;
            //     }
            // }



        ];
    }


}
