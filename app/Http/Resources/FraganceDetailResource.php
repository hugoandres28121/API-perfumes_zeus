<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class FraganceDetailResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
   
            'name_frangance'=>$this->name,
            'bottle_contents_ml'=> floatval($this->bottle_contents_ml),
            'unit_price'=>floatval($this->price),
            'gender_fragance'=>$this->gender==1?'Femenino':'Masculino',
            'quantity_fragrances'=>$this->pivot->quantity_fragrance,
            'subtotal_fragrance'=>floatval($this->pivot->amount)
        ];
    }
}