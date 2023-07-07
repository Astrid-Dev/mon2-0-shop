<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class OrderRequest extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'product_id',
        'customer_name',
        'customer_phone',
        'quantity',
        'description',
    ];

    protected $dates = [
        'created_at'
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function product(): BelongsTo
    {
        return $this->belongsTo(Product::class);
    }
}
