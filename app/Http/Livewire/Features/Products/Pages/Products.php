<?php

namespace App\Http\Livewire\Features\Products\Pages;

use App\Models\Brand;
use App\Models\Category;
use App\Models\Product;
use Livewire\Component;
use Livewire\WithPagination;

class Products extends Component
{
    use WithPagination;

    protected $paginationTheme = 'bootstrap';

    private $breadcrumbsData = [
        'page_title' => 'products.title',
        'breadcrumbs' => [
            [
                'link' => '',
                'label' => 'categories.breadcrumbs.home'
            ],
            [
                'label' => 'products.title'
            ]
        ]
    ];

    private $categories = [];
    private $popularBrands = [];
    private $topRatedProducts = [];
    private $products = [];


    public function mount()
    {
        $this->categories = Category::query()
            ->withCount('products')
            ->whereNotNull('parent_id')
            ->orWhereDoesntHave('descendants')
            ->orderBy('id')
            ->get();

        $this->popularBrands = Brand::query()
            ->withCount('products')
            ->orderBy('products_count')
            ->take(8)
            ->get();

        $this->topRatedProducts = Product::customQuery()
            ->with('category')
            ->orderBy('reviews_avg', 'desc')
            ->take(4)
            ->get();

        $this->products = Product::customQuery()
            ->paginate(12);
    }

    public function render()
    {
        return view('livewire.features.products.pages.products', [
                'breadcrumbsData' => $this->breadcrumbsData,
                'categories' => $this->categories,
                'popularBrands' => $this->popularBrands,
                'topRatedProducts' => $this->topRatedProducts,
                'products' => $this->products,
            ])
            ->extends('livewire.layouts.app')
            ->layoutData(['title' => 'products.title']);
    }
}
