<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\Pivot;

class ProductSize extends Model
{
    use HasFactory;

    protected $fillable = [
        'product_id',
        'value',
        'stock'
    ];

    public function product(): BelongsTo
    {
        return $this->belongsTo(Product::class);
    }
}
