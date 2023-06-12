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
            ->whereDate('created_at', '>=', now()->subDays(7))
            ->inRandomOrder()
            ->take(5)
            ->get();
    }

    public function render()
    {
        return view('livewire.features.home.components.products-arrival');
    }
}
