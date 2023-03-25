<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\SaleResource;
use App\Models\Sale;

class SaleDetailResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {

            
        $missing_amount=floatval($this->total_amount-$this->amount_paid);
        return [
            'id_sale'=>$this->id,
            'sale_date'=>$this->sale_date,
            'order_detail'=>FraganceDetailResource::collection($this->fragances),
            'total_amount'=>floatval($this->total_amount),
            'status_sale'=>$this->sale_status=="2"?'Pago Parcial':'Pagada Totalmente',
            'mount_paid'=>floatval($this->amount_paid),
            'missing_amount'=>$this->when($this->amount_paid<$this->total_amount,$missing_amount),
        ];
    }
}
