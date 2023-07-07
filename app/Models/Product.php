<?php

namespace App\Models;

use App\Enums\StockType;
use App\Traits\HasBookmark;
use App\Traits\HasImage;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use stdClass;

class Product extends Model
{
    use HasFactory, HasImage, HasBookmark;

    protected $fillable = [
        'code',
        'name',
        'description',
        'details',
        'tags',
        'price',
        'stock_type',
        'brand_id',
        'category_id',
        'provider_id'
    ];

    protected $casts = [
        'stock_type' => StockType::class,
    ];

    protected $with = [
        'promotion',
        'currentUserBookmark',
        'mainImage'
    ];

    protected $withCount = [
        'reviews'
    ];

    protected $appends = [
        'is_in_promotion',
        'new_price',
        'formatted_price',
        'details_page_link',
        'main_image_path'
    ];

    public function getIsInPromotionAttribute(): bool
    {
        return !!$this->promotion;
    }

    public function getHasOrderFeaturesAttribute(): bool
    {
        return in_array($this->category_id, [12, 13, 16, 18, 19, 21]);
    }

    public function getNewPriceAttribute(): float
    {
        $discountPercentage = $this->promotion?->discount_percentage;
        return floor($discountPercentage ? ($this->price - ($this->price * $discountPercentage / 100)) : $this->price);
    }

    public function getFormattedPriceAttribute(): \stdClass
    {
        $formattedPrice = new stdClass();
        $formattedPrice->old = number_format(num: $this->price, thousands_separator: ' ');
        $formattedPrice->new = number_format(num: $this->new_price, thousands_separator: ' ');

        return $formattedPrice;
    }

    public function getDetailsPageLinkAttribute()
    {
        return \LaravelLocalization::localizeUrl(route('products.details', ['productIdentifier' => (str_replace(' ', '-', $this->name).'_'.$this->id)]));
    }

    public function getMainImagePathAttribute()
    {
        return sizeof($this->mainImage) > 0 ? ('/storage/'.$this->mainImage[0]->path) : '/images/no-image.png';
    }

//    public function getReviewsAvgAttribute(): float | null
//    {
//        return $this->reviews()->avg('rating');
//    }

    protected function details(): Attribute
    {
        return new Attribute(
            get: fn (string $value) => explode('|', $value),
            set: fn ($value) => implode('|', $value),
        );
    }

    protected function tags(): Attribute
    {
        return new Attribute(
            get: fn (string $value) => explode('|', $value),
            set: fn ($value) => implode('|', $value),
        );
    }

    public function provider(): BelongsTo
    {
        return $this->belongsTo(Provider::class);
    }

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    public function brand(): BelongsTo
    {
        return $this->belongsTo(Brand::class);
    }

    public function colors(): HasMany
    {
        return $this->hasMany(ProductColor::class);
    }

    public function dimensions(): HasMany
    {
        return $this->hasMany(ProductDimension::class);
    }

    public function promotion(): HasOne
    {
        return $this->hasOne(ProductPromotion::class)
            ->where('end_date', '>', now()->format('Y-m-d H:i:s'));
    }

    public function reviews(): HasMany
    {
        return $this->hasMany(ProductReview::class);
    }

    public function sizes(): HasMany
    {
        return $this->hasMany(ProductSize::class);
    }

    public function siblings(): HasMany
    {
        return $this->hasMany(ProductSibling::class);
    }

    public function orders(): HasMany
    {
        return $this->hasMany(OrderRequest::class);
    }

    public function currentUserReview()
    {
        return $this->reviews()
            ->where('user_id', auth()->id());
    }

    public static function customQuery(): Builder
    {
        return self::query()
            ->withAvg('reviews as reviews_avg', 'rating');
    }

    public function snapshots(): BelongsToMany
    {
        return $this->belongsToMany(User::class, 'product_stock_type_snapshots')
            ->withTimestamps();
    }

    public function currentUserSnapshot(): HasOne
    {
        return $this->hasOne(ProductStockTypeSnapshot::class)
            ->where('user_id', auth()->id());
    }
}
