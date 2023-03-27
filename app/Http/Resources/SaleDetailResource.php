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

    public function status($status){
        $sale_status='Pago Pendiente';
            if($status==2){
                $sale_status='Pago Parcial';
            }
            if($status==3){
                $sale_status='Pagada Totalmente';
            }
        return $sale_status;
    }

    public function toArray(Request $request): array
    {

            
        $missing_amount=floatval($this->total_amount-$this->amount_paid);
        
        
        return [
            'id_sale'=>$this->id,
            'sale_date'=>$this->sale_date,
            'customer'=>$this->user->name,
            'order_detail'=>FraganceDetailResource::collection($this->fragances),
            'total_amount'=>floatval($this->total_amount),
            'status_sale'=>$this->status($this->sale_status),
            'mount_paid'=>floatval($this->amount_paid),
            'missing_amount'=>$this->when($this->amount_paid<$this->total_amount,$missing_amount),
        ];
    }
}
