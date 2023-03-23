<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class FraganceResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id'=>$this->id,
            'slug'=>$this->slug,
            'name'=>$this->name,
            'bottle_contents_ml'=>$this->bottle_contents_ml,
            'unit_price'=>$this->price,
            'gender'=>$this->gender==1?'Femenino':'Masculino',
            'quantity_stock'=>$this->quantity_stock

        ];
    }
}
