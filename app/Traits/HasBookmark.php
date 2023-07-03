<?php
namespace App\Traits;

use App\Models\Bookmark;
use App\Models\Image;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\MorphMany;

trait HasBookmark
{
    public function bookmarks(): MorphMany
    {
        return $this->morphMany(Bookmark::class, 'element');
    }

    public function currentUserBookmark()
    {
        return $this->bookmarks()
            ->where('user_id', auth()->id());
    }
}

