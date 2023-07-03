<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\MorphTo;

class Bookmark extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'element_type',
        'element_id',
        'extras'
    ];

    protected function extras(): Attribute
    {
        return new Attribute(
            get: fn ($value) => $value ? json_decode($value) : $value,
            set: fn ($value) => json_encode($value),
        );
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function element(): MorphTo
    {
        return $this->morphTo();
    }
}
