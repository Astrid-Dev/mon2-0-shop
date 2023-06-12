<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ProductPromotion extends Model
{
    use HasFactory;

    protected $fillable = [
      'product_id',
      'start_date',
      'end_date',
      'discount_percentage',
    ];

    protected $dates = [
      'start_date',
      'end_date'
    ];

    public function product(): BelongsTo
    {
        return $this->belongsTo(Product::class);
    }
}
