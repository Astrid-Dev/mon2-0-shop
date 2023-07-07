<?php

namespace App\Models;

use App\Enums\ImageType;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphTo;

class Image extends Model
{
    use HasFactory;

    protected $fillable = [
        'element_type',
        'element_id',
        'path',
        'name',
        'image_type',
        'extras'
    ];

    protected $casts = [
        'image_type' => ImageType::class
    ];

    protected $appends = [
        'url'
    ];

    public function getUrlAttribute(): string
    {
        return asset('/storage/' . $this->path);
    }

    protected function extras(): Attribute
    {
        return new Attribute(
            get: fn($value) => json_decode($value),
            set: fn($value) => json_encode($value)
        );
    }

    public function element(): MorphTo
    {
        return $this->morphTo();
    }
}
