<?php

namespace App\Http\Livewire\Features\Products\Pages;

use App\Models\Brand;
use App\Models\Category;
use App\Models\Product;
use Barryvdh\Debugbar\Facades\Debugbar;
use Exception;
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

    public $search = '';
    public $page = 1;
    public $brands = '';
    public $siblings = '';
    public $colors = '';
    public $status = '';
    public $categories = '';
    public $sorting = 'default';
    public $asset = '';
    public $min_price = 0;
    public $max_price = 0;
    public $printedPriceInterval = '';



    protected $queryString = [
        'search' => ['except' => ''],
        'page' => ['except' => 1],
        'brands' => ['except' => ''],
        'siblings' => ['except' => ''],
        'colors' => ['except' => ''],
        'status' => ['except' => ''],
        'categories' => ['except' => ''],
        'min_price' => ['except' => 0],
        'max_price' => ['except' => 0],
        'sorting' => ['except' => 'default'],
        'asset' => ['except' => ''],
    ];

    public $childrenCategories1 = [];
    public $popularBrands = [];
    public $topRatedProducts = [];
    private $products = [];

    private $sortingValues = [
        'default',
        'price-desc',
        'price-asc',
        'reviews-desc',
        'reviews-asc',
        'newest',
        'oldest'
    ];

    public function mount()
    {
        $this->childrenCategories1 = Category::query()
            ->withCount('products')
            ->whereNotNull('parent_id')
            ->orWhereDoesntHave('descendants')
            ->orderBy('id')
            ->get();

        $this->popularBrands = Brand::query()
            ->withCount('products')
            ->orderBy('products_count', 'desc')
            ->get();

        $this->topRatedProducts = Product::customQuery()
            ->with('category')
            ->orderBy('reviews_avg', 'desc')
            ->take(4)
            ->get();

        if ($this->asset !== 'discount') {
            $this->asset = '';
        }
    }

    public function handleStatus(string $target)
    {
        $temp = explode(',', $this->status);
        $temp = array_filter($temp, function ($item) {
           return $item !== '';
        });
        if (in_array($target, $temp)) {
            $temp = array_filter($temp, function ($stockType) use ($target) {
               return $stockType !== $target;
            });
        } else {
            $temp[] = $target;
        }

        $this->status = implode(',', $temp);
        $this->resetPage();
    }

    public function handleSiblings(string $target)
    {
        $temp = explode(',', $this->siblings);
        $temp = array_filter($temp, function ($item) {
           return $item !== '';
        });
        if (in_array($target, $temp)) {
            $temp = array_filter($temp, function ($sibling) use ($target) {
               return $sibling !== $target;
            });
        } else {
            $temp[] = $target;
        }

        $this->siblings = implode(',', $temp);
        $this->resetPage();
    }

    public function handleCategories($target, $parentId)
    {
        $temp = explode(',', $this->categories);
        $temp = array_filter($temp, function ($item) {
           return intval($item) !== 0;
        });
        if (in_array($target, $temp)) {
            $temp = array_filter($temp, function ($category) use ($target) {
               return intval($category) !== intval($target);
            });
        } else {
            if ($parentId && in_array($parentId, $temp)) {
                $categoryBrothers = array_filter($this->childrenCategories1->toArray(), function ($child) use ($parentId, $target, $temp) {
                    return intval($child['parent_id']) === intval($parentId) && intval($child['id']) !== intval($target) && !in_array($child['id'], $temp);
                });

                $temp = array_merge(
                    array_filter($temp, function ($category) use ($parentId) {
                        return intval($category) !== intval($parentId);
                    }),
                    array_map(fn ($brother) => $brother['id'], $categoryBrothers)
                );
            } else {
                $temp[] = $target;
            }
        }

        $temp = array_map(function ($item) {
            return intval($item);
        }, $temp);
        $this->categories = implode(',', $temp);
        $this->resetPage();
    }

    public function handleColors(string $target)
    {
        $temp = explode(',', $this->colors);
        $temp = array_filter($temp, function ($item) {
           return $item !== '';
        });
        if (in_array($target, $temp)) {
            $temp = array_filter($temp, function ($color) use ($target) {
               return $color !== $target;
            });
        } else {
            $temp[] = $target;
        }

        $this->colors = implode(',', $temp);
        $this->resetPage();
    }

    public function handleBrands($target)
    {
        $temp = explode(',', $this->brands);
        $temp = array_filter($temp, function ($item) {
           return intval($item) !== 0;
        });
        if (in_array($target, $temp)) {
            $temp = array_filter($temp, function ($brand) use ($target) {
               return intval($brand) !== intval($target);
            });
        } else {
            $temp[] = $target;
        }

        $temp = array_map(function ($item) {
            return intval($item);
        }, $temp);
        $this->brands = implode(',', $temp);
        $this->resetPage();
    }

    public function isConcernedByCategoryFilter(int $categoryId, int | null $parentId = null)
    {
        $temp = explode(',', $this->categories);
        return (in_array($categoryId, $temp) || (($parentId !== null) && in_array($parentId, $temp)));
    }

    public function handlePrice($minPrice, $maxPrice)
    {
        Debugbar::log($maxPrice);
        Debugbar::log($minPrice);
        $this->resetPage();
    }

    public function handleSorting($target)
    {
        Debugbar::log($target);
        if (in_array($target, $this->sortingValues) && strval($this->sorting) !== strval($target)) {
            $this->sorting = $target;
        } else {
            $this->sorting = '';
        }
        $this->resetPage();
    }

    public function handleDiscount()
    {
        $this->asset = $this->asset === 'discount' ? '' : 'discount';
        $this->resetPage();
    }

    public function getOrderAndDirectionForSorting()
    {
        $result = null;
        try {
            $temp = explode('-', $this->sorting);
            $orderBy = $temp[0];
            $orderDirection = $temp[1];
            if (in_array($orderBy, ['oldest', 'latest'])) {
                $result = [
                    'orderBy' => 'created_at',
                    'direction' => $orderBy === 'latest' ? 'desc' : 'asc'
                ];
            } elseif (in_array($orderBy, ['reviews', 'reviews']) && in_array($orderDirection, ['asc', 'desc'])) {
                $result = [
                    'orderBy' => 'reviews_avg',
                    'direction' => $orderDirection
                ];
            } elseif (in_array($orderBy, ['price']) && in_array($orderDirection, ['asc', 'desc'])) {
                $result = [
                    'orderBy' => $orderBy,
                    'direction' => $orderDirection
                ];
            }
        } catch (Exception $e){}

        return $result;
    }

    public function render()
    {
        $sortingResult = $this->getOrderAndDirectionForSorting();
        $this->products = Product::customQuery()
            ->when(($this->search && $this->search !== ''), function ($query) {
                $query->where('name', 'LIKE', '%'.$this->search.'%');
            })
            ->when(($this->brands && $this->brands !== ''), function ($query) {
                $query->whereIn('brand_id', explode(',', $this->brands));
            })
            ->when(($this->status && $this->status !== ''), function ($query) {
                $query->whereIn('stock_type', explode(',', $this->status));
            })
            ->when(($this->siblings && $this->siblings !== ''), function ($query) {
                $query->whereHas('siblings', function ($subQuery) {
                    $subQuery->whereIn('sibling', explode(',', $this->siblings));
                });
            })
            ->when(($this->asset === 'discount'), function ($query) {
                $query->whereHas('promotion');
            })
            ->when(($this->categories && $this->categories !== ''), function ($query) {
                $query->whereHas('category', function ($subQuery) {
                    $subQuery->whereIn('categories.id', explode(',', $this->categories))
                        ->orWhereIn('categories.parent_id', explode(',', $this->categories));
                });
            })
            ->when(($this->colors && $this->colors !== ''), function ($query) {
                $query->whereHas('colors', function ($subQuery) {
                    $subQuery->whereIn('product_colors.value', explode(',', $this->colors));
                });
            })
            ->when(($sortingResult), function ($query) use ($sortingResult) {
                $query->orderBy($sortingResult['orderBy'], $sortingResult['direction']);
            })
            ->paginate(15);

        return view('livewire.features.products.pages.products', [
                'breadcrumbsData' => $this->breadcrumbsData,
                'childrenCategories' => $this->childrenCategories1,
                'products' => $this->products,
                'from' => $this->products->firstItem(),
                'to' => $this->products->lastItem(),
                'total' => $this->products->total(),
                'sortingValues' => $this->sortingValues,
            ])
            ->extends('livewire.layouts.app')
            ->layoutData(['title' => 'products.title']);
    }

    public function paginationView()
    {
        return 'livewire.shared.components.paginator';
    }
}
