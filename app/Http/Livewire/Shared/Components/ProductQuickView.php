<?php

namespace App\Http\Livewire\Shared\Components;

use App\Models\Product;
use Livewire\Component;

class ProductQuickView extends Component
{
    public Product $product;

    protected $listeners = ['postAdded' => 'incrementPostCount'];

    public function incrementPostCount()
    {
        \Debugbar::error('onQuickViewProduct');
    }

    public function onQuickViewProduct()
    {
//        $this->product = $product;
        \Debugbar::error('onQuickViewProduct');
    }

    public function render()
    {
        return view('livewire.shared.components.product-quick-view');
    }
}
