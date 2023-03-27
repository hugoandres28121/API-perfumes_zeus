<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class PaymentResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        $amount_missing = ($this->sale->total_amount-$this->sale->amount_paid)-$this->amount_paid;
        return [
            "sale_id"=>$this->sale->id,
            "payment_id" => $this->id,
            "payment_date"=>$this->payment_date,
            "user_id" => $this->sale->user->id,
            "customer" => $this->sale->user->name,
            "total_amount" => floatval($this->sale->total_amount),
            "total_paid" => floatval($this->sale->amount_paid+$this->amount_paid),
            "amount_paid"=>$this->amount_paid,
            "amount_missing"=>$amount_missing

        ];
    }
}
