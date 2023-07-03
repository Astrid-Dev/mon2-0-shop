<?php

namespace App\Http\Livewire\Features\Dashboard\Pages;

use App\Traits\HasAlert;
use App\Traits\HasToast;
use Livewire\Component;
use Livewire\WithPagination;

class Products extends Component
{

    use WithPagination, HasAlert, HasToast;

    public $provider;
    private $products;

    public $page = 1;

    protected $queryString = [
        'page' => ['except' => 1]
    ];

    protected $listeners = [
        'onDeleteProduct'
    ];

    public function mount()
    {
        $this->provider = auth()->user()->provider()->first();
    }

    public function onDeleteProduct($data)
    {
        $productId = $data['productId'];
        $this->provider->products()
            ->where('id', $productId)
            ->delete();

        $this->showSuccessToast(__('dashboard.products.on_delete_success'));
    }

    public function shouldDeleteProduct($productId, $productName)
    {
        $this->askConfirmation(
            message: __('dashboard.products.delete_confirmation', ['productName' => $productName]),
            listener: [
                'onConfirm' => [
                    'callback' => 'onDeleteProduct',
                    'data' => [
                        'productId' => $productId,
                    ]
                ]
            ],
            buttons: [
                'confirm' => __('helpers.choices.yes_continue'),
                'deny' => __('helpers.choices.no')
            ]
        );
    }


    public function paginationView()
    {
        return 'livewire.shared.components.paginator';
    }

    public function render()
    {
        $this->products = $this->provider->products()
            ->Paginate();
        return view('livewire.features.dashboard.pages.products', [
            'products' => $this->products
        ])
            ->extends('livewire.layouts.app')
            ->layoutData(['title' => 'dashboard.products.title']);
    }
}
