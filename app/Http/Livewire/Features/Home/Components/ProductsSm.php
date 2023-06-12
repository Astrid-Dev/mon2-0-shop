<?php

namespace App\Http\Livewire\Features\Home\Components;

use App\Enums\StockType;
use App\Models\Product;
use Livewire\Component;

class ProductsSm extends Component
{
    public $discountProducts;
    public $preOrderProducts;
    public $inStockProducts;

    public function mount()
    {
        $this->discountProducts = Product::customQuery()
            ->with('category')
            ->whereHas('promotion')
            ->inRandomOrder()
            ->take(3)
            ->get();

        $this->preOrderProducts = Product::customQuery()
            ->with('category')
            ->where('stock_type', StockType::PRE_ORDER)
            ->inRandomOrder()
            ->take(3)
            ->get();

        $this->inStockProducts = Product::customQuery()
            ->with('category')
            ->where('stock_type', StockType::IN_STOCK)
            ->take(3)
            ->get();
    }

    public function render()
    {
        return view('livewire.features.home.components.products-sm');
    }
}
