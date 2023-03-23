<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Sale;
use App\Models\Fragance;

class SaleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Sale::factory()
        ->count(15)
        ->create()
        ->each(function(Sale $sale){
            $fragance_id= rand(1,15);
            $fragance=Fragance::find($fragance_id);
            $quantity_fragance=rand(1,10);
            $price_fragance=$fragance->price;
            $total=$quantity_fragance*$price_fragance;
            $sale->fragances()->attach($fragance_id,   
                [
                    'quantity_fragrance'=>$quantity_fragance,
                    'amount'=>$total
                ]);
            
                $total_amount = $sale->fragances()->sum('amount');
                $amount_paid=rand($total_amount,$total_amount);
                $sale_status=null;
                if($amount_paid==0){
                    $sale_status= Sale::PENDING;
                }
                if($amount_paid>0&&$amount_paid<$total_amount){
                    $sale_status= Sale::PARTIALLYPAID;
                }
                if($amount_paid==$total_amount){
                    $sale_status= Sale::PAID;
                }
                
                $sale->update(
                    [
                        'total_amount' => $total_amount,
                        'amount_paid'=>$amount_paid,
                        'sale_status' => $sale_status,        
                    ]);


        });

        


    }

}
