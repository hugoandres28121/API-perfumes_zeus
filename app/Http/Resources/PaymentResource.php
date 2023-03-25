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
            "payment_date"=>$this->payment_date,
            "payment_id" => $this->id,
            "user_id" => $this->sale->user->id,
            "user_name" => $this->sale->user->name,
            "amount_paid"=>$this->amount_paid,
            "amount_missing"=>$amount_missing

        ];
    }
}
