<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Spatie\Translatable\HasTranslations;

class ProductColor extends Model
{
    use HasFactory, HasTranslations;

    protected $fillable = [
        'product_id',
        'value',
        'name',
        'stock'
    ];

    public $translatable = [
        'name'
    ];

    protected function name(): Attribute
    {
        return new Attribute(
            get: fn($value) => $value ? json_decode($value) : null,
            set: fn($value) => json_encode($value)
        );
    }

    public function product(): BelongsTo
    {
        return $this->belongsTo(Product::class);
    }
}
