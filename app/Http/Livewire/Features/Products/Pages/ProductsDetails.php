<?php

namespace App\Http\Livewire\Features\Products\Pages;

use App\Models\Product;
use Livewire\Component;

class ProductsDetails extends Component
{
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

    private $productIdentifier = null;

    public $product;

    public function mount($productIdentifier)
    {
        $this->productIdentifier = $productIdentifier;
        $temp = explode('_', $productIdentifier);
        $productId = $temp[sizeof($temp)-1];
        $this->product = Product::customQuery()
            ->with(['colors', 'category', 'sizes', 'dimensions'])
            ->find($productId);
    }

    public function render()
    {
        return view('livewire.features.products.pages.products-details', [
                'breadcrumbsData' => $this->breadcrumbsData,
                'productIdentifier' => $this->productIdentifier
            ])
            ->extends('livewire.layouts.app')
            ->layoutData(['title' => 'products.title']);
    }
}
