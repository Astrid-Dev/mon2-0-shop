<?php

namespace App\Models;

use App\Http\Livewire\Features\Products\Pages\Products;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;
use Spatie\Translatable\HasTranslations;
use Staudenmeir\LaravelAdjacencyList\Eloquent\HasRecursiveRelationships;

class Category extends Model
{
    use HasFactory, HasTranslations, HasRecursiveRelationships;

    protected $fillable = [
        'label',
        'parent_id',
        'icon',
        'illustration'
    ];

    public $translatable = [
        'label'
    ];

    protected function label(): Attribute
    {
        return new Attribute(
            get: fn (string $value) => json_decode($value),
            set: fn ($value) => json_encode($value),
        );
    }

    public function products(): HasMany
    {
        return $this->hasMany(Product::class);
    }

    public function deepProducts(): HasManyThrough
    {
        return $this->hasManyThrough(
            related: Products::class,
        );
    }

    public function providers(): HasManyThrough
    {
        return $this->hasManyThrough(Provider::class, Product::class);
    }

}
