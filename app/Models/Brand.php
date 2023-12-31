<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;

class Brand extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'logo'
    ];

    public function products(): HasMany
    {
        return $this->hasMany(Product::class);
    }

    public function providers(): HasManyThrough
    {
        return $this->hasManyThrough(Provider::class, Product::class);
    }
}
