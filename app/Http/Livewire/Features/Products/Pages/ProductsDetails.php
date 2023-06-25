<?php

namespace App\Http\Livewire\Features\Products\Pages;

use App\Models\Product;
use Barryvdh\Debugbar\Facades\Debugbar;
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
    private $productRatings = [];

    public $product;
    private $relatedProducts = [];

    public function mount($productIdentifier)
    {
        $this->productIdentifier = $productIdentifier;
        $temp = explode('_', $productIdentifier);
        $productId = $temp[sizeof($temp)-1];
        $this->product = Product::customQuery()
            ->with(['colors', 'category', 'sizes', 'dimensions', 'siblings'])
            ->find($productId);
        array_pop($temp);
        $incomeProductName = implode('', $temp);

        if ($this->product && str_replace(' ', '-', $this->product->name) !== $incomeProductName) {
            redirect()->to($this->product->details_page_link);
        }

        if ($this->product) {

            $ratingsData = $this->product->reviews()->select('rating', \DB::raw('count(id) as count'))
                ->groupBy('rating')
                ->get();

            $this->productRatings = [
                "5" => 0,
                "4" => 0,
                "3" => 0,
                "2" => 0,
                "1" => 0,
            ];

            foreach ($ratingsData as $ratingData) {
                $key = intval($ratingData->rating);
                if ($key >= 1 && $key <= 5) {
                    $this->productRatings[strval($key)] += $ratingData->count;
                }
            }

            \Debugbar::log($ratingsData->toArray());
            Debugbar::log($this->productRatings);

            $this->relatedProducts = Product::query()
                ->with(['category'])
                ->where('id', '!=', $this->product->id)
                ->where('category_id', $this->product->category_id)
                ->orWhere('category_id', $this->product->category->parent_id)
                ->orWhere(function ($query) {
                    foreach ($this->product->tags as $i => $tag) {
                        if ($i == 0) {
                            $query->where('tags', 'LIKE', '%' . $tag . '%');
                        } else {
                            $query->orWhere('tags', 'LIKE', '%' . $tag . '%');
                        }
                    }
                })
                ->when((sizeof($this->product->siblings) > 0), function ($query) {
                    $query->orWhereHas('siblings', function ($subQuery) {
                        $subQuery->whereIn('product_siblings.sibling', array_map(fn($item) => $item['sibling'], $this->product->siblings->toArray()));
                    });
                })
                ->inRandomOrder()
                ->take(8)
                ->get();
        }
    }

    public function render()
    {
        return view('livewire.features.products.pages.products-details', [
                'breadcrumbsData' => $this->breadcrumbsData,
                'productIdentifier' => $this->productIdentifier,
                'relatedProducts' => $this->relatedProducts,
                'productRatings' => $this->productRatings
            ])
            ->extends('livewire.layouts.app')
            ->layoutData(['title' => 'products.title']);
    }
}
