<?php

namespace App\Traits;
use App\Models\Sale;

trait updateStateSale{
    public function updateState($amount_paid,$sale_amount)
    {
        $sale_status=Sale::PENDING;

        if ($amount_paid == $sale_amount) {
             $sale_status= Sale::PAID;
        }
        if ($amount_paid > 0 && $amount_paid <=$sale_amount) {
             $sale_status= Sale::PARTIALLYPAID;   
        }
        
        return $sale_status;
    }
}