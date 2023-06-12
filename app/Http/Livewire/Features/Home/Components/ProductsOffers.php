<?php

namespace App\Http\Livewire\Features\Home\Components;

use App\Models\Product;
use Livewire\Component;

class ProductsOffers extends Component
{
    public $dealProducts;

    public function mount()
    {
        $this->dealProducts = Product::customQuery()
            ->with('category')
            ->whereHas('promotion')
            ->inRandomOrder()
            ->take(4)
            ->get();
    }

    public function render()
    {
        return view('livewire.features.home.components.products-offers');
    }
}
