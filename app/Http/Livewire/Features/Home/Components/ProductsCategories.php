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
            ->with(['descendants', 'products' => function ($query) {
                $query->with('category')
//                    ->whereHas('category', function ($subQuery) {
//                        $subQuery->whereColumn('products.category_id', '=', 'categories.parent_id')
//                        ->orWhereColumn('products.category_id', '=', 'categories.id');
//                    })
                    ->inRandomOrder()
                    ->take(6);
            }])
            ->whereNull('parent_id')
//            ->whereHas('products')
            ->inRandomOrder()
            ->first();

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
