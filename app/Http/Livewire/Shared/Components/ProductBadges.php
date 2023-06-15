<?php

namespace App\Http\Livewire\Shared\Components;

use App\Models\Product;
use Livewire\Component;

class ProductBadges extends Component
{
    private $product;

    public function mount($product)
    {
        $this->product = $product;
    }

    public function render()
    {
        return view('livewire.shared.components.product-badges', [
            'product' => $this->product
        ]);
    }
}
