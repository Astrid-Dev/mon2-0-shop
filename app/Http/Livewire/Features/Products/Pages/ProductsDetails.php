<?php

namespace App\Http\Livewire\Features\Products\Pages;

use App\Models\Product;
use App\Traits\HasToast;
use Barryvdh\Debugbar\Facades\Debugbar;
use Livewire\Component;
use Livewire\WithPagination;

class ProductsDetails extends Component
{
    use HasToast, WithPagination;

    public $breadcrumbsData = [
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

    public $productIdentifier = null;
    public $productRatings = [];

    public $product;
    public $relatedProducts = [];

    public $reviewsPage = 1;

    public $reviewsAverage = 0;
    public $reviewsCount = 0;

    public $newReview = [
        'rating' => null,
        'comment' => null
    ];

    protected $queryString = [
        'reviewsPage' => ['except' => 1, 'as' => 'reviewsPage']
    ];

    public function mount($productIdentifier)
    {
        $this->productIdentifier = $productIdentifier;
        $temp = explode('_', $productIdentifier);
        $productId = $temp[sizeof($temp)-1];
        $this->product = Product::customQuery()
            ->with(['colors', 'category', 'sizes', 'dimensions', 'siblings', 'images'])
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
                "r-5" => 0,
                "r-4" => 0,
                "r-3" => 0,
                "r-2" => 0,
                "r-1" => 0,
            ];

            foreach ($ratingsData as $ratingData) {
                $key = intval($ratingData->rating);
                if ($key >= 1 && $key <= 5) {
                    $this->productRatings["r-".$key] += $ratingData->count;
                }
            }

            $this->reviewsAverage = $this->product->reviews_avg;
            $this->reviewsCount = $this->product->reviews_count;

            $this->relatedProducts = Product::query()
                ->with(['category', 'provider'])
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

    public function handleBookmark()
    {
        if (!auth()->check()) {
            $this->showWarningToast(__('helpers.should_be_logged_in'));
        } else {
            if ($this->product->currentUserBookmark()->exists()) {
                $this->product->currentUserBookmark()->delete();
            } else {
                $this->product->currentUserBookmark()
                    ->create(['user_id' => auth()->id()]);
            }
            $this->emitTo('shared.components.header-bookmarks-count', 'onBookmarksCountChanged');
        }
    }

    public function handleSnapshot()
    {
        Debugbar::log($this->product->currentUserSnapshot()->exists());
        if (!auth()->check()) {
            $this->showWarningToast(__('helpers.should_be_logged_in'));
        } else {
            if ($this->product->currentUserSnapshot()->exists()) {
                $this->product->snapshots()->detach([auth()->id()]);
            } else {
                $this->product->snapshots()
                    ->attach([auth()->id()]);
            }
        }
    }

    public function setRating($rating)
    {
        $this->newReview['rating'] = $rating;
    }

    public function submitReview()
    {
        $this->validate([
            'newReview.rating' => 'required|integer|min:1|max:5',
            'newReview.comment' => 'required|string|min:3|max:255'
        ]);

        if (!auth()->check()) {
            $this->showWarningToast(__('helpers.should_be_logged_in'));
        } else {
            if ($this->product->currentUserReview()->exists()) {
                $this->showWarningToast(__('product_details.review_already_added'));
                return;
            }

            $this->product->reviews()->create([
                'user_id' => auth()->id(),
                'rating' => $this->newReview['rating'],
                'comment' => $this->newReview['comment']
            ]);
            $this->productRatings["r-".($this->newReview['rating'])] += 1;
            $this->reviewsCount += 1;
            $this->reviewsAverage = ($this->reviewsAverage * ($this->reviewsCount - 1) + $this->newReview['rating']) / $this->reviewsCount;
            $this->showSuccessToast(__('product_details.on_submit_review_success'));

            $this->newReview = [
                'rating' => 5,
                'comment' => ''
            ];
        }
    }

    public function render()
    {
        $userHasReviewed = $this->product->currentUserReview()->exists();
        $reviews = $this->product->reviews()
            ->with('user')
            ->latest()
            ->paginate(4, ['*'], 'reviewsPage');
        return view('livewire.features.products.pages.products-details', [
                'provider' => $this->product->provider,
                'userHasBookmarked' => $this->product->currentUserBookmark()->exists(),
                'userHasSnapshot' => $this->product->currentUserSnapshot()->exists(),
                'reviews' => $reviews,
            ])
            ->extends('livewire.layouts.app')
            ->layoutData(['title' => 'products.title']);
    }

    public function paginationView()
    {
        return 'livewire.shared.components.paginator';
    }
}
