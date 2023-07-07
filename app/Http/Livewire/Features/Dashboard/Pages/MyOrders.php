<?php

namespace App\Http\Livewire\Features\Dashboard\Pages;

use App\Traits\HasAlert;
use App\Traits\HasToast;
use Exception;
use Livewire\Component;
use Livewire\WithPagination;

class MyOrders extends Component
{
    use WithPagination, HasAlert, HasToast;

    public $sortingValues = [
        'quantity-desc',
        'quantity-asc',
        'product_price-desc',
        'product_price-asc',
        'newest',
        'oldest'
    ];

    public $page = 1;
    public string $sorting = 'newest';

    protected $queryString = [
        'page' => ['except' => 1],
        'sorting' => ['except' => ''],
    ];

    public function handleSorting($target)
    {
        if (in_array($target, $this->sortingValues) && strval($this->sorting) !== strval($target)) {
            $this->sorting = $target;
        } else {
            $this->sorting = '';
        }
        $this->resetPage();
    }

    public function getOrderAndDirectionForSorting()
    {
        $result = null;
        try {
            $temp = explode('-', $this->sorting);
            $orderBy = $temp[0];
            $orderDirection = sizeof($temp) > 1 ? $temp[1] : null;
            if (in_array($orderBy, ['oldest', 'newest'])) {
                $result = [
                    'orderBy' => 'created_at',
                    'direction' => $orderBy === 'newest' ? 'desc' : 'asc'
                ];
            } elseif (in_array($orderBy, ['product_price', 'quantity']) && in_array($orderDirection, ['asc', 'desc'])) {
                $result = [
                    'orderBy' => $orderBy === 'product_price' ? 'products.price' : $orderBy,
                    'direction' => $orderDirection
                ];
            }
        } catch (Exception $e) {
            \Debugbar::log($e->getMessage());
        }

        return $result;
    }

    public function paginationView()
    {
        return 'livewire.shared.components.paginator';
    }

    public function render()
    {
        $sortingResult = $this->getOrderAndDirectionForSorting();
        $orders = auth()->user()->orders()
            ->with(['product'])
            ->when(($sortingResult), function ($query) use ($sortingResult) {
                $query->orderBy($sortingResult['orderBy'], $sortingResult['direction']);
            })
            ->paginate(15);

        return view('livewire.features.dashboard.pages.my-orders', [
            'orders' => $orders,
            'from' => $orders->firstItem(),
            'to' => $orders->lastItem(),
            'total' => $orders->total(),
        ])
            ->extends('livewire.layouts.app')
            ->layoutData(['title' => 'dashboard.my_orders.title']);
    }
}
