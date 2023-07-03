<?php
namespace App\Traits;

use App\Models\Image;
use Illuminate\Database\Eloquent\Relations\MorphMany;

trait HasImage
{
    public function images(): MorphMany
    {
        return $this->morphMany(Image::class, 'element');
    }

    public function mainImage()
    {
        return $this->images()->whereJsonContains('extras->is_main', true);
    }
}

