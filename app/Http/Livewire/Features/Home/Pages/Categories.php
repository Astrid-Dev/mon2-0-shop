<?php

namespace App\Http\Livewire\Features\Home\Pages;

use App\Models\Category;
use App\Models\Product;
use Barryvdh\Debugbar\Facades\Debugbar;
use Livewire\Component;

class Categories extends Component
{
    public $someAds = [];
    public $categories;

    private $currentCategoriesPage = 0;
    public $totalCategories = 0;
    public $loadedCategoriesPercentage = 0;

    private $breadcrumbsData = [
        'page_title' => 'categories.title',
        'breadcrumbs' => [
            [
                'link' => '',
                'label' => 'categories.breadcrumbs.home'
            ],
            [
                'label' => 'categories.title'
            ]
        ]
    ];

    public function mount()
    {
        $this->someAds = Product::customQuery()
            ->with('category')
            ->whereHas('promotion')
            ->inRandomOrder()
            ->take(2)
            ->get();

        $this->retrieveCategoriesNextPage();
    }

    public function retrieveCategoriesNextPage()
    {
        $page = $this->currentCategoriesPage + 1;
        $this->currentCategoriesPage = $page;

        $currentCategoriesLength = sizeof($this->categories ?? []);
        if (($page && $page < 1) || ($currentCategoriesLength > $this->totalCategories)) {
            return;
        }

        $query = Category::query()
            ->withCount('products')
            ->whereNotNull('parent_id')
            ->orWhereDoesntHave('descendants')
            ->orderBy('id')
            ->paginate(perPage: 12, page: $page);
        $this->currentCategoriesPage = $query->currentPage();
        $prevCategories = array_map(function ($category) {
            $temp = new Category($category);
            $temp->products_count = $category['products_count'];
            return $temp;
        }, $this->categories?->toArray() ?? []);
        $this->totalCategories = $query->total();
        $this->categories = collect($prevCategories)->merge($query->items());
        $this->loadedCategoriesPercentage = ceil(sizeof($this->categories) * 100 / $this->totalCategories);
    }

    public function render()
    {
        return view('livewire.features.home.pages.categories', [
                'breadcrumbsData' => $this->breadcrumbsData
            ])
            ->extends('livewire.layouts.app')
            ->layoutData(['title' => 'categories.title']);
    }
}
