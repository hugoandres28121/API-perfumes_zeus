<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\CustomerResource;
use App\Http\Resources\FraganceDetailResource;

class SaleResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {

        return [
            'id_sale'=>$this->id,
            'sale_date'=>$this->sale_date,
            'customer'=>CustomerResource::make($this->customer)->name,
            'order_detail'=>FraganceDetailResource::collection($this->fragances),
            'total_amount'=>floatval($this->total_amount)
        ];
      }
}
