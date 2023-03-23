<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Builder;

class Fragance extends Model
{
    use HasFactory;

    const FEMENINO=1;
    const MASCULINO=2;

    public $timestamps = false;

    protected $casts = [
        'bottle_contents_ml' => 'decimal:2',
        'price'=>'decimal:2'
    ];

    protected $fillable = ['slug','name','bottle_contents_ml','price','gender','quantity_stock'];

    public function sales():BelongsToMany
    {
        return $this->belongsToMany(Fragance::class)
                                                    ->withPivot('quantity_fragrance', 'amount');
    }
    //Esto es un scope global, me permite crear una restriccion a mis consultas sobre este modelo en especifico, por ejemplo, en este caso
    //este global escope se llama available_fragrances, me permite saber traer solo los producto cuyo stock sea mayor a 0.

    // protected static function booted(): void
    // {
    //     static::addGlobalScope('available_fragrances', function (Builder $builder) {
    //         $builder->where('quantity_stock', '>', 0);
    //     });
    // }

}
