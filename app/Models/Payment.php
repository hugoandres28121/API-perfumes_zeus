<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Payments extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $fillable= ['slug','payment_date','amount_paid','sales'];

    public function sale():BelongsTo
    {
        return $this->belongsTo(Sales::class);
    }
}
