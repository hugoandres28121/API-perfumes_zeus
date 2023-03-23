<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Customer extends Model
{
    use HasFactory;

    protected $fillable= ['slug','name','lastName','address'];

    public function sales():HasMany
    {
        return $this->hasMany(Sales::class);
    }



}
