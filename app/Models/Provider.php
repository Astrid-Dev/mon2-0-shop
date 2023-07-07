<?php

namespace App\Models;

use App\Enums\ProviderStatus;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;
use Illuminate\Testing\Fluent\Concerns\Has;

class Provider extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'code',
        'name',
        'phone1',
        'phone2',
        'whatsapp',
        'city',
        'address',
        'status',
        'description',
        'logo'
    ];

    protected $casts = [
        'status' => ProviderStatus::class
    ];

    protected $appends = [
        'logo_path'
    ];

    protected $withCount = [
        'reviews',
        'products'
    ];

    public function getLogoPathAttribute()
    {
        return (str_starts_with($this->logo, 'http')) ? $this->logo : ('/storage/'.$this->logo);
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function products(): HasMany
    {
        return $this->hasMany(Product::class);
    }

    public function reviews(): HasManyThrough
    {
        return $this->hasManyThrough(ProductReview::class, Product::class);
    }

    public function orders(): HasManyThrough
    {
        return $this->hasManyThrough(OrderRequest::class, Product::class);
    }

    public function questions(): HasManyThrough
    {
        return $this->hasManyThrough(ProductQuestion::class, Product::class);
    }

    public static function customQuery(): Builder
    {
        return self::query()
            ->withAvg('reviews as reviews_avg', 'rating');
    }
}
