<?php

namespace App\Http\Livewire\Features\Home\Components;

use App\Models\Category;
use App\Models\Product;
use Livewire\Component;

class ProductsCategories extends Component
{
    public $randomCategory;
    public $someAds;

    public function mount()
    {
        $this->randomCategory = Category::query()
            ->with(['descendants'])
            ->whereNull('parent_id')
//            ->whereHas('products')
            ->inRandomOrder()
            ->first();

        $this->randomCategory->products = Product::query()
            ->with('category')
            ->whereHas('category', function ($query) {
                $query->where('parent_id', $this->randomCategory->id)
                ->orWhere('id', $this->randomCategory->id);
            })
            ->inRandomOrder()
            ->take(6)
            ->get();

        $this->someAds = Product::customQuery()
            ->whereHas('promotion')
            ->orderBy('price')
            ->inRandomOrder()
            ->take(2)
            ->get();
    }

    public function render()
    {
        return view('livewire.features.home.components.products-categories');
    }
}
