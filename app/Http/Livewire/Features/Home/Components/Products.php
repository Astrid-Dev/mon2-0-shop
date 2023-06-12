<?php

namespace App\Http\Livewire\Features\Home\Components;

use App\Models\Product;
use Livewire\Component;

class Products extends Component
{
    public $newProducts;
    public $featuredProducts;
    public $topSellersProducts;

    public function mount()
    {
        $this->newProducts = Product::customQuery()
            ->with('category')
            ->latest()
            ->take(8)
            ->get();

        $this->featuredProducts = Product::customQuery()
            ->with('category')
            ->whereHas('colors')
            ->orWhereHas('sizes')
            ->orWhereHas('dimensions')
            ->orWhereHas('siblings')
            ->inRandomOrder()
            ->take(8)
            ->get();

        $this->topSellersProducts = Product::customQuery()
            ->with('category')
            ->orderBy('reviews_avg', 'desc')
            ->take(8)
            ->get();
    }

    public function render()
    {
        return view('livewire.features.home.components.products');
    }
}
