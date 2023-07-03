<?php

namespace App\Models;

use App\Enums\JerseyType;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class CustomProductRequest extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'customer_name',
        'customer_phone',
        'quantity',
        'description',
        'jersey_type',
        'jersey_sample',
        'include_flocking',
        'data',
        'flocking_items',
    ];

    protected $casts = [
        'jersey_type' => JerseyType::class,
        'include_flocking' => 'boolean',
    ];

    protected function data(): Attribute
    {
        return new Attribute(
            get: fn ($value) => json_decode($value),
            set: fn ($value) => json_encode($value),
        );
    }

    protected function flockingItems(): Attribute
    {
        return new Attribute(
            get: fn ($value) => json_decode($value),
            set: fn ($value) => json_encode($value),
        );
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
