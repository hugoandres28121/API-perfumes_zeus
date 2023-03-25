<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Customer extends Model
{
    use HasFactory;

    
    protected $fillable= ['address','mobile_number','user_id'];

    public function sales():HasMany
    {
        return $this->hasMany(Sales::class);
    }

    public  function user():BelongsTo
    {
        return $this->belongsTo(User::class);
    }



}
