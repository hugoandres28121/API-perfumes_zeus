<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Payment extends Model
{
    use HasFactory;

    public $timestamps = false;
    protected $table = 'payments';

    protected $fillable= ['payment_date','amount_paid','sale_id'];

    public function sale():BelongsTo
    {
        return $this->belongsTo(Sale::class);
    }
}
