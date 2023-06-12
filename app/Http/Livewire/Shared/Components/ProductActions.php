<?php

namespace App\Http\Livewire\Shared\Components;

use App\Models\Product;
use Livewire\Component;

class ProductActions extends Component
{
    public Product $product;
    public $type = 1;

    public function quickViewProduct()
    {
        \Debugbar::log($this->product);
        $this->emit('onQuickViewProduct', $this->product);
    }

    public function render()
    {
        return view('livewire.shared.components.product-actions');
    }
}
