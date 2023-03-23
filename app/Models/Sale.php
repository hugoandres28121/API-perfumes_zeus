<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Sale extends Model
{
    use HasFactory;

    const PENDING= 1;
    const PARTIALLYPAID=2;
    const PAID=3;

    public $timestamps = false;

    protected $casts = [
        'total_amount' => 'decimal:2',
        'amount_paid'=>'decimal:2'
    ];

    
    protected $fillable = ['slug','sale_date','customer_id','sale_status','total_amount','amount_paid'];

    public function customer():BelongsTo
    {
        return $this->belongsTo(Customer::class);
    }

    public function payments():HasMany
    {
        return $this->hasMany(Payment::class);
    }

    public function fragances():BelongsToMany
    {
        return $this->belongsToMany(Fragance::class,'sale_fragance')->withTimestamps()
                                                                    ->withPivot('quantity_fragrance', 'amount');
    }

}