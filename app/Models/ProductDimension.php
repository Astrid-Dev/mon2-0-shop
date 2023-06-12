<?php

namespace App\Models;

use App\Enums\DimensionType;
use App\Enums\DimensionUnit;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ProductDimension extends Model
{
    use HasFactory;

    protected $fillable = [
        'product_id',
        'type',
        'value',
        'unit',
        'stock'
    ];

    protected $casts = [
        'type' => DimensionType::class,
        'unit' => DimensionUnit::class
    ];

    public function product(): BelongsTo
    {
        return $this->belongsTo(Product::class);
    }
}
