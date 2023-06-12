<?php

namespace App\Models;

use App\Enums\SiblingType;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ProductSibling extends Model
{
    use HasFactory;

    protected $fillable = [
        'product_id',
        'sibling',
        'stock'
    ];

    protected $casts = [
        'sibling' => SiblingType::class,
    ];

    public function product(): BelongsTo
    {
        return $this->belongsTo(Product::class);
    }
}
