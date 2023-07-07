<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Spatie\Translatable\HasTranslations;

class Notification extends Model
{
    use HasFactory, HasTranslations;

    protected $fillable = [
        'user_id',
        'title',
        'message',
        'read_at',
        'link'
    ];

    protected $dates = [
        'created_at',
        'read_at'
    ];

    public $translatable = [
        'message',
        'title'
    ];

    protected function message(): Attribute
    {
        return new Attribute(
            get: fn ($value) => json_decode($value),
            set: fn ($value) => json_encode($value),
        );
    }

    protected function title(): Attribute
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
