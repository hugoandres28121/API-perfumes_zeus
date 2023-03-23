<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Customer extends Model
{
    use HasFactory;

    CONST CEDULA=1;
    CONST TARJETAIDENTIDAD=2;

    protected $fillable= ['name','lastName','address','type_document','number_document'];

    public function sales():HasMany
    {
        return $this->hasMany(Sales::class);
    }



}
