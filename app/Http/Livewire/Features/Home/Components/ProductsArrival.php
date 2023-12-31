<?php

namespace App\Http\Livewire\Features\Home\Components;

use App\Models\Product;
use Livewire\Component;

class ProductsArrival extends Component
{
    public $newProducts;

    public function mount()
    {
        $this->newProducts = Product::customQuery()
            ->with('category')
            ->latest()
            ->take(5)
            ->get();
    }

    public function render()
    {
        return view('livewire.features.home.components.products-arrival');
    }
}
