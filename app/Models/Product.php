<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'slug',
        'barcode',
        'stock',
        'price',
        'description',
        'image'
    ];

    public function orderDetails(): HasMany
    {
        return $this->hasMany(OrderDetails::class);
    }
}
