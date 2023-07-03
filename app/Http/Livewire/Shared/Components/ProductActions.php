<?php

namespace App\Http\Livewire\Shared\Components;

use App\Models\Product;
use App\Traits\HasToast;
use Barryvdh\Debugbar\Facades\Debugbar;
use Livewire\Component;

class ProductActions extends Component
{
    use HasToast;

    public Product $product;
    public $type = 1;
    public $isBookmarked = false;

    public function mount()
    {
        $this->isBookmarked = sizeof($this->product->currentUserBookmark) > 0;
    }

    public function handleBookmark()
    {
        if (!auth()->check()) {
            $this->showWarningToast(__('helpers.should_be_logged_in'));
        } else {
            if ($this->product->currentUserBookmark()->exists()) {
                $this->product->currentUserBookmark()->delete();
                $this->isBookmarked = false;
            } else {
                $this->product->currentUserBookmark()
                    ->create(['user_id' => auth()->id()]);
                $this->isBookmarked = true;
            }
            $this->emitTo('shared.components.header-bookmarks-count', 'onBookmarksCountChanged');
        }
    }

    public function quickViewProduct()
    {
        $this->emit('onQuickViewProduct', $this->product);
    }

    public function render()
    {
        return view('livewire.shared.components.product-actions');
    }
}
